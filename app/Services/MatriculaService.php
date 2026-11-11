<?php

namespace App\Services;

use App\Mail\BienvenidaAlumno;
use App\Models\Alumno;
use App\Models\Apoderado;
use App\Models\Ciclo;
use App\Models\ConversacionChatbot;
use App\Models\Entorno;
use App\Models\Matricula;
use App\Models\NivelEducativo;
use App\Models\Pago;
use App\Models\Seccion;
use App\Models\Sede;
use App\Models\TipoCiclo;
use App\Models\Turno;
use App\Models\Universidade;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

/**
 * Núcleo del proceso de matrícula. Lo comparten el formulario web,
 * el chatbot y el panel de administración.
 */
class MatriculaService
{
    /** Descuento por pago al contado de la matrícula. */
    public const DESCUENTO_CONTADO = 0.05;

    /** Horas que tiene el alumno para pagar antes de que expire el código. */
    public const HORAS_PARA_PAGAR = 24;

    /** Motivo del último fallo de enviarBienvenida() (para mostrarlo en el panel). */
    public ?string $ultimoErrorCorreo = null;

    /** Grados por nivel educativo (niveles_educativos.nombre). */
    private const GRADOS = ['primaria' => 6, 'secundaria' => 5];

    // ======================================================
    // CATÁLOGOS (opciones de cada paso)
    // Cada uno devuelve una colección de ['id' => ..., 'nombre' => ...]
    // ======================================================

    public function sedes(): Collection
    {
        return Sede::where('activo', 1)->orderBy('nombre')->get()
            ->map(fn ($s) => ['id' => $s->id, 'nombre' => $s->nombre, 'detalle' => $s->direccion]);
    }

    public function entornos(): Collection
    {
        return Entorno::where('activo', 1)->orderBy('nombre')->get()
            ->map(fn ($e) => ['id' => $e->id, 'nombre' => $e->nombre]);
    }

    public function universidades(): Collection
    {
        return Universidade::orderBy('nombre')->get()
            ->map(fn ($u) => ['id' => $u->id_universidad, 'nombre' => $u->nombre, 'alias' => $u->slug]);
    }

    public function tiposCiclo(): Collection
    {
        return TipoCiclo::orderBy('id_tipo_ciclo')->get()
            ->map(fn ($t) => ['id' => $t->id_tipo_ciclo, 'nombre' => ucfirst($t->nombre), 'detalle' => $t->duracion_meses ? "{$t->duracion_meses} meses" : null]);
    }

    public function turnos(): Collection
    {
        return Turno::orderBy('id_turno')->get()
            ->map(fn ($t) => ['id' => $t->id_turno, 'nombre' => ucfirst($t->nombre), 'detalle' => $t->hora_texto]);
    }

    public function niveles(): Collection
    {
        return NivelEducativo::orderBy('orden')->get()
            ->map(fn ($n) => ['id' => $n->id, 'nombre' => ucfirst($n->nombre)]);
    }

    public function grados($nivelId): Collection
    {
        $nivel = NivelEducativo::find($nivelId);
        $cantidad = $nivel ? (self::GRADOS[strtolower($nivel->nombre)] ?? 0) : 0;

        return collect(range(1, max($cantidad, 1)))->take($cantidad)
            ->map(fn ($i) => ['id' => "{$i}° Grado", 'nombre' => "{$i}° Grado"]);
    }

    public function secciones(): Collection
    {
        return Seccion::orderBy('seccion')->get()
            ->map(fn ($s) => ['id' => $s->seccion, 'nombre' => "Sección {$s->seccion}"]);
    }

    /**
     * Ciclos activos y vigentes con su monto de matrícula.
     * Filtros: modalidad (colegio|academia), id_sede, id_entorno, id_universidad, id_tipo_ciclo, id_turno, id_nivel.
     */
    public function ciclos(array $filtros): Collection
    {
        $query = Ciclo::where('activo', 1)->where('fecha_fin', '>=', today());

        if (($filtros['modalidad'] ?? null) === 'academia') {
            $query->where('id_modalidad', 2);
        } elseif (($filtros['modalidad'] ?? null) === 'colegio') {
            $query->where('id_modalidad', 1);
        }

        foreach (['id_sede', 'id_entorno', 'id_universidad', 'id_tipo_ciclo', 'id_turno', 'id_nivel'] as $f) {
            if (!empty($filtros[$f])) {
                $query->where($f, $filtros[$f]);
            }
        }

        return $query->orderBy('fecha_inicio')->get()
            ->map(function (Ciclo $ciclo) {
                $monto = $this->calcularMonto($ciclo);
                return $monto ? [
                    'id' => $ciclo->id_ciclo,
                    'codigo' => $ciclo->codigo,
                    'nombre' => $ciclo->nombre,
                    'fecha_inicio' => $ciclo->fecha_inicio->format('d/m/Y'),
                    'fecha_fin' => $ciclo->fecha_fin->format('d/m/Y'),
                    'importe' => $monto['importe'],
                    'descuento' => $monto['descuento'],
                    'monto' => $monto['total'], 
                    'fecha_vencimiento' => $monto['fecha_vencimiento'],
                ] : null;
            })
            ->filter()
            ->values();
    }

    /** Monto mínimo de matrícula por modalidad (para mostrar "desde S/ X"). */
    public function montoDesde(string $modalidad): ?float
    {
        $min = $this->ciclos(['modalidad' => $modalidad])->min('monto');
        return $min !== null ? (float) $min : null;
    }

    /**
     * Monto a pagar por la matrícula de un ciclo (con descuento al contado).
     *
     * @return array{id_cuota:int|null, concepto:string, importe:float, descuento:float, total:float, fecha_vencimiento:?string}|null
     */
    public function calcularMonto(Ciclo $ciclo): ?array
    {
        $cuota = $ciclo->conceptoMatricula();
        if (!$cuota) {
            return null;
        }

        $importe = (float) $cuota->monto;
        $descuento = round($importe * self::DESCUENTO_CONTADO, 2);

        return [
            'id_cuota' => $cuota->id_cuota,
            'concepto' => 'Matrícula',
            'importe' => $importe,
            'descuento' => $descuento,
            'total' => round($importe - $descuento, 2),
            'fecha_vencimiento' => $cuota->fecha_vencimiento?->format('Y-m-d'),
        ];
    }

    // ======================================================
    // VALIDACIÓN (misma para formulario y chatbot)
    // ======================================================

    public function requiereApoderado(array $data): bool
    {
        return ($data['modalidad'] ?? null) === 'colegio' || ($data['es_mayor'] ?? 'no') !== 'si';
    }

    public function reglas(array $data): array
    {
        $apo = $this->requiereApoderado($data) ? 'required' : 'nullable';

        return [
            'modalidad' => 'required|in:colegio,academia',
            'id_ciclo' => ['required', 'integer', Rule::exists('ciclos', 'id_ciclo')->where('activo', 1)],
            'es_mayor' => 'nullable|in:si,no',
            'grado' => 'required_if:modalidad,colegio|nullable|string|max:20',
            'seccion' => 'required_if:modalidad,colegio|nullable|string|max:5',

            'alumno_nombres' => 'required|string|max:100',
            'alumno_ape_paterno' => 'required|string|max:100',
            'alumno_ape_materno' => 'nullable|string|max:100',
            'alumno_dni' => 'required|digits:8',
            'alumno_email' => 'required|email|max:100',
            'alumno_celular' => ($data['modalidad'] ?? null) === 'academia' ? 'required|digits:9' : 'nullable|digits:9',
            'alumno_genero' => 'required|in:M,F',
            'alumno_fecha_nac' => 'required|date|before:today|after:1940-01-01',

            'apoderado_nombres' => "{$apo}|nullable|string|max:100",
            'apoderado_ape_paterno' => "{$apo}|nullable|string|max:100",
            'apoderado_ape_materno' => 'nullable|string|max:100',
            'apoderado_dni' => "{$apo}|nullable|digits:8|different:alumno_dni",
            'apoderado_email' => "{$apo}|nullable|email|max:100",
            'apoderado_celular' => "{$apo}|nullable|digits:9",
            'apoderado_fecha_nac' => 'nullable|date|before:today',

            'terminos_aceptados' => 'accepted',
            'politicas_aceptadas' => 'accepted',
        ];
    }

    public function mensajes(): array
    {
        return [
            'apoderado_dni.different' => 'El DNI del apoderado debe ser distinto al del alumno.',
            'alumno_fecha_nac.before' => 'La fecha de nacimiento no es válida.',
            'alumno_celular.required' => 'El celular del postulante es obligatorio.',
            'terminos_aceptados.accepted' => 'Debes aceptar los Términos y Condiciones.',
            'politicas_aceptadas.accepted' => 'Debes aceptar la Política de Privacidad.',
        ];
    }

    /**
     * Reglas de negocio que no cubre el validador.
     * Devuelve un mensaje de error o null si todo está bien.
     */
    public function validarNegocio(array $data, string $dniVerificado): ?string
    {
        if (!in_array($dniVerificado, [$data['alumno_dni'] ?? null, $data['apoderado_dni'] ?? null], true)) {
            return "El DNI verificado ({$dniVerificado}) debe corresponder al alumno o a su apoderado.";
        }

        if (($data['modalidad'] ?? null) === 'academia' && ($data['es_mayor'] ?? 'no') === 'si'
            && Carbon::parse($data['alumno_fecha_nac'])->age < 18) {
            return 'Según la fecha de nacimiento eres menor de edad: registra los datos de tu apoderado.';
        }

        return null;
    }

    // ======================================================
    // REGISTRO
    // ======================================================

    /**
     * Registra la matrícula (datos ya validados con reglas()).
     */
    public function procesarMatricula(array $data, ?int $conversacionId = null): array
    {
        $ciclo = Ciclo::with(['sede', 'entorno', 'turno', 'universidad', 'nivelEducativo', 'tipoCiclo'])->find($data['id_ciclo'] ?? null);

        if (!$ciclo || !$ciclo->activo) {
            return ['success' => false, 'error' => 'El ciclo seleccionado no está disponible.'];
        }
        $modalidadEsperada = ($data['modalidad'] ?? '') === 'colegio' ? 1 : 2;
        if ((int) $ciclo->id_modalidad !== $modalidadEsperada) {
            return ['success' => false, 'error' => 'El ciclo no corresponde a la modalidad elegida.'];
        }

        // El monto lo calcula el servidor; nunca se confía en el que envía el cliente.
        $monto = $this->calcularMonto($ciclo);
        if (!$monto) {
            return ['success' => false, 'error' => 'El ciclo no tiene un concepto de matrícula configurado.'];
        }

        try {
            return DB::transaction(function () use ($data, $ciclo, $monto, $conversacionId) {

                // 1. APODERADO
                $apoderado = null;
                if ($this->requiereApoderado($data) && !empty($data['apoderado_dni'])) {
                    $apoderado = Apoderado::updateOrCreate(
                        ['dni' => $data['apoderado_dni']],
                        [
                            'nombre' => $data['apoderado_nombres'] ?? '',
                            'apellido' => trim(($data['apoderado_ape_paterno'] ?? '') . ' ' . ($data['apoderado_ape_materno'] ?? '')),
                            'telefono' => $data['apoderado_celular'] ?? null,
                            'correo' => $data['apoderado_email'] ?? null,
                            'fecha_nacimiento' => $data['apoderado_fecha_nac'] ?? null,
                        ]
                    );
                }

                // 2. ALUMNO (fila bloqueada para evitar matrículas dobles por doble clic)
                $datosAlumno = [
                    'nombre' => $data['alumno_nombres'],
                    'apellido' => trim($data['alumno_ape_paterno'] . ' ' . ($data['alumno_ape_materno'] ?? '')),
                    'email' => $data['alumno_email'] ?? null,
                    'telefono' => $data['alumno_celular'] ?? null,
                    'genero' => $data['alumno_genero'] ?? null,
                    'fecha_nacimiento' => $data['alumno_fecha_nac'],
                ];
                if ($apoderado) {
                    $datosAlumno['id_apoderado'] = $apoderado->id_apoderado;
                }

                $alumno = Alumno::where('dni', $data['alumno_dni'])->lockForUpdate()->first();
                $alumnoNuevo = !$alumno;

                if ($alumno) {
                    $alumno->update($datosAlumno);
                } else {
                    // Sin acceso hasta que se verifique el pago (ahí se asignan las credenciales).
                    $alumno = Alumno::create($datosAlumno + [
                        'dni' => $data['alumno_dni'],
                        'usuario' => $data['alumno_dni'],
                        'contrasena' => Hash::make(Str::random(40)),
                    ]);
                }

                // 3. EVITAR DUPLICADOS en el mismo ciclo
                $existente = Matricula::where('id_alumno', $alumno->id_alumno)
                    ->where('id_ciclo', $ciclo->id_ciclo)
                    ->vigentes()
                    ->first();

                if ($existente) {
                    return [
                        'success' => false,
                        'duplicada' => true,
                        'codigo' => $existente->codigo,
                        'error' => $existente->estado === Matricula::ESTADO_PAGADA
                            ? "Ya estás matriculado en este ciclo (código {$existente->codigo})."
                            : "Ya tienes una matrícula pendiente de pago en este ciclo (código {$existente->codigo}).",
                    ];
                }

                // 4. MATRÍCULA
                $matricula = Matricula::create([
                    'id_alumno' => $alumno->id_alumno,
                    'id_ciclo' => $ciclo->id_ciclo,
                    'año_academico' => (int) $ciclo->fecha_inicio->format('Y'),
                    'modalidad' => $data['modalidad'],
                    'eleccion' => Str::limit($this->textoEleccion($ciclo), 47),
                    'ciclo_grado' => Str::limit($this->textoCicloGrado($data, $ciclo), 47),
                    'sede' => Str::limit($ciclo->sede?->nombre ?? '', 47),
                    'entorno' => $ciclo->entorno?->nombre,
                    'turno' => $ciclo->turno ? ucfirst($ciclo->turno->nombre) : null,
                    'monto_total' => $monto['total'],
                    'estado' => Matricula::ESTADO_PENDIENTE,
                    'fecha_registro' => now(),
                    'fecha_expiracion' => now()->addHours(self::HORAS_PARA_PAGAR),
                ]);
                $matricula->update(['codigo' => Matricula::generarCodigo($matricula->id_matricula)]);

                // 5. VINCULAR CONVERSACIÓN DEL CHATBOT
                if ($conversacionId) {
                    ConversacionChatbot::where('id', $conversacionId)->update([
                        'estado' => 'completada',
                        'ultimo_mensaje' => now(),
                        'matricula_id' => $matricula->id_matricula,
                    ]);
                }

                return [
                    'success' => true,
                    'codigo' => $matricula->codigo,
                    'id_matricula' => $matricula->id_matricula,
                    'monto_total' => number_format($monto['total'], 2, '.', ''),
                    'detalle_pago' => $monto,
                    'fecha_expiracion' => $matricula->fecha_expiracion->format('d/m/Y H:i'),
                    'alumno_nuevo' => $alumnoNuevo,
                    'email' => $alumno->email,
                    'mensaje' => 'Matrícula procesada correctamente',
                ];
            });
        } catch (\Throwable $e) {
            Log::error('Error al procesar matrícula: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'dni' => $data['alumno_dni'] ?? null,
            ]);

            return [
                'success' => false,
                'error' => 'No se pudo registrar la matrícula. Inténtalo nuevamente o comunícate con nosotros.',
            ];
        }
    }

    // ======================================================
    // PAGO Y CREDENCIALES
    // ======================================================

    /**
     * Verifica el pago: marca la matrícula como pagada, registra el pago
     * y envía el correo de bienvenida con las credenciales.
     *
     * @return array{ya_pagada:bool, correo_enviado:bool}
     */
    public function registrarPago(Matricula $matricula, ?string $comprobante = null, ?string $verificadoPor = null): array
    {
        if ($matricula->estado === Matricula::ESTADO_PAGADA) {
            return ['ya_pagada' => true, 'correo_enviado' => false];
        }

        DB::transaction(function () use ($matricula, $comprobante, $verificadoPor) {
            $matricula->update(['estado' => Matricula::ESTADO_PAGADA]);

            Pago::create([
                'id_matricula' => $matricula->id_matricula,
                'id_cuota' => $matricula->ciclo ? ($this->calcularMonto($matricula->ciclo)['id_cuota'] ?? null) : null,
                'monto' => $matricula->monto_total,
                'fecha_pago' => now()->toDateString(),
                'comprobante' => $comprobante,
                'estado' => 'confirmado',
                'verificado_por' => $verificadoPor,
            ]);
        });

        return ['ya_pagada' => false, 'correo_enviado' => $this->enviarBienvenida($matricula)];
    }

    /**
     * Credenciales de acceso del alumno:
     *  - usuario: DNI del alumno
     *  - contraseña: fecha de nacimiento en formato ddmmaaaa (ej. 05052009)
     *
     * @return array{usuario:string, password:string}
     */
    public function credenciales(Alumno $alumno): array
    {
        return [
            'usuario' => $alumno->dni,
            'password' => $alumno->fecha_nacimiento->format('dmY'),
        ];
    }

    /**
     * Asigna las credenciales al alumno y le envía el correo de bienvenida
     * (con copia al apoderado). Si el correo falla, las credenciales no cambian.
     */
    public function enviarBienvenida(Matricula $matricula): bool
    {
        $matricula->loadMissing(['alumno.apoderado', 'ciclo']);
        $alumno = $matricula->alumno;

        if (!$alumno || !$alumno->email || !$alumno->fecha_nacimiento) {
            $this->ultimoErrorCorreo = 'El alumno no tiene correo o fecha de nacimiento registrados.';
            Log::warning('Bienvenida no enviada: ' . $this->ultimoErrorCorreo, ['matricula' => $matricula->id_matricula]);
            return false;
        }

        $credenciales = $this->credenciales($alumno);

        $usuarioOcupado = Alumno::where('usuario', $credenciales['usuario'])
            ->where('id_alumno', '!=', $alumno->id_alumno)->exists();
        if ($usuarioOcupado) {
            $this->ultimoErrorCorreo = "El usuario {$credenciales['usuario']} ya pertenece a otro alumno.";
            Log::error('Bienvenida no enviada: ' . $this->ultimoErrorCorreo);
            return false;
        }

        try {
            DB::transaction(function () use ($alumno, $matricula, $credenciales) {
                $alumno->update([
                    'usuario' => $credenciales['usuario'],
                    'contrasena' => Hash::make($credenciales['password']),
                ]);

                $correo = Mail::to($alumno->email);
                $correoApoderado = $alumno->apoderado?->correo;
                if ($correoApoderado && strcasecmp($correoApoderado, $alumno->email) !== 0) {
                    $correo->cc($correoApoderado);
                }
                $correo->send(new BienvenidaAlumno($alumno, $matricula, $credenciales['password']));
            });
            return true;
        } catch (\Throwable $e) {
            $this->ultimoErrorCorreo = app(CorreoService::class)->explicarError($e->getMessage());
            Log::error('No se pudo enviar el correo de bienvenida: ' . $e->getMessage(), ['matricula' => $matricula->id_matricula]);
            return false;
        }
    }

    public function getEstadisticas(): array
    {
        return [
            'total' => Matricula::count(),
            'hoy' => Matricula::whereDate('fecha_registro', today())->count(),
            'semana' => Matricula::where('fecha_registro', '>=', now()->subDays(7))->count(),
            'pendientes' => Matricula::where('estado', Matricula::ESTADO_PENDIENTE)
                ->where(fn ($q) => $q->whereNull('fecha_expiracion')->orWhere('fecha_expiracion', '>', now()))
                ->count(),
            'pagadas' => Matricula::where('estado', Matricula::ESTADO_PAGADA)->count(),
            'recaudado' => (float) Matricula::where('estado', Matricula::ESTADO_PAGADA)->sum('monto_total'),
        ];
    }

    private function textoEleccion(Ciclo $ciclo): string
    {
        if ($ciclo->universidad) {
            return $ciclo->universidad->slug ? strtoupper(str_replace('_', ' ', $ciclo->universidad->slug)) : $ciclo->universidad->nombre;
        }
        return $ciclo->nivelEducativo ? ucfirst($ciclo->nivelEducativo->nombre) : '';
    }

    private function textoCicloGrado(array $data, Ciclo $ciclo): string
    {
        if (($data['modalidad'] ?? '') === 'colegio' && !empty($data['grado'])) {
            return trim($data['grado'] . (!empty($data['seccion']) ? ' - Sección ' . $data['seccion'] : ''));
        }
        return $ciclo->tipoCiclo ? 'Ciclo ' . ucfirst($ciclo->tipoCiclo->nombre) : $ciclo->nombre;
    }
}
