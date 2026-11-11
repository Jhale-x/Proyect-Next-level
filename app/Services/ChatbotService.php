<?php

namespace App\Services;

use App\Models\ConversacionChatbot;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

/**
 * Asistente de matrícula por chat. Recorre los mismos pasos que el
 * formulario web y registra la matrícula con MatriculaService.
 *
 * Cada respuesta tiene:
 *  - mensaje   texto (admite **negrita** y saltos de línea)
 *  - paso      paso actual
 *  - opciones  botones [{valor, texto, detalle?}]
 *  - entrada   pista para el campo de texto {tipo, placeholder}
 *  - tarjeta   datos de pago al terminar
 */
class ChatbotService
{
    private const OMITIR = '__omitir__';
    private const ATRAS = 'atrás';
    private const CANCELAR = 'cancelar';
    private const CONFIRMAR = '__confirmar__';

    public function __construct(
        protected MatriculaService $matriculaService,
        protected DniService $dniService
    ) {
    }

    public function procesarMensaje(string $mensaje, string $sessionId): array
    {
        try {
            $conversacion = $this->obtenerConversacion($sessionId);
            $this->registrarMensaje($conversacion, 'usuario', $mensaje);

            $resultado = $this->responder(trim($mensaje), $conversacion);

            $this->registrarMensaje($conversacion, 'bot', $resultado['mensaje']);
            $conversacion->update([
                'paso_actual' => $resultado['paso'],
                'intencion_actual' => $resultado['intencion'] ?? null,
                'ultimo_mensaje' => now(),
            ]);

            return $resultado;
        } catch (\Throwable $e) {
            Log::error('Error en chatbot: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return $this->respuesta('⚠️ Ocurrió un error. Escribe **cancelar** para empezar de nuevo.', 'inicio', $this->opcionesMenu());
        }
    }

    // ======================================================
    // FLUJO PRINCIPAL
    // ======================================================

    private function responder(string $mensaje, ConversacionChatbot $conversacion): array
    {
        $paso = $conversacion->paso_actual ?: 'inicio';
        $datos = $conversacion->datos_recolectados ?? [];
        $comando = $this->normalizar($mensaje);

        if (in_array($comando, ['cancelar', 'reiniciar', 'salir', 'menu'], true)) {
            $this->guardar($conversacion, []);
            return $this->respuesta("🔄 Listo, empecemos de nuevo. ¿En qué te ayudo?", 'inicio', $this->opcionesMenu());
        }

        if (in_array($paso, ['inicio', 'finalizado'], true)) {
            return $this->menu($comando, $conversacion);
        }

        if (in_array($comando, ['atras', 'volver', 'regresar'], true)) {
            return $this->retroceder($conversacion, $datos);
        }

        if ($paso === 'confirmar') {
            return $this->confirmar($comando, $conversacion, $datos);
        }

        $pasos = $this->pasos();
        if (!isset($pasos[$paso])) {
            $this->guardar($conversacion, []);
            return $this->menu('', $conversacion);
        }

        $res = $pasos[$paso]['procesar']($mensaje, $datos);

        if (is_array($res)) { // error
            if (!empty($res['volver'])) {
                // Volver a un paso anterior (p. ej. DNI no encontrado)
                $datos['_hechos'] = array_values(array_diff($datos['_hechos'] ?? [], [$res['volver']]));
                $this->guardar($conversacion, $datos);
                return $this->preguntar($res['volver'], $datos, $conversacion, "❌ {$res['error']}\n\n");
            }
            return $this->preguntar($paso, $datos, $conversacion, "❌ {$res['error']}\n\n");
        }

        $datos['_hechos'][] = $paso;
        return $this->siguiente($datos, $conversacion);
    }

    /** Menú principal e información general. */
    private function menu(string $comando, ConversacionChatbot $conversacion): array
    {
        if (Str::contains($comando, ['matricul', 'inscrib', 'inscrip', 'empezar', 'comenzar', 'iniciar'])) {
            $datos = ['_hechos' => [], '_auto' => []];
            $this->guardar($conversacion, $datos);
            return $this->preguntar('dni', $datos, $conversacion, "📝 ¡Genial! Te guiaré paso a paso. En cualquier momento puedes escribir **atrás** o **cancelar**.\n\n");
        }

        $info = $this->informacion($comando);
        if ($info) {
            return $this->respuesta($info, 'inicio', $this->opcionesMenu());
        }

        return $this->respuesta(
            "👋 ¡Hola! Soy el asistente de **Next Level**.\n\nPuedo matricularte en minutos o resolver tus dudas. ¿Qué necesitas?",
            'inicio',
            $this->opcionesMenu()
        );
    }

    private function siguiente(array $datos, ConversacionChatbot $conversacion, string $prefijo = ''): array
    {
        foreach ($this->pasos() as $clave => $paso) {
            if (in_array($clave, $datos['_hechos'] ?? [], true) || !$paso['aplica']($datos)) {
                continue;
            }

            // Si solo hay una opción, se elige sola.
            $pregunta = $paso['pregunta']($datos);
            $opciones = $pregunta['opciones'] ?? [];
            if (($pregunta['auto'] ?? false) && count($opciones) === 1) {
                $paso['procesar']((string) $opciones[0]['valor'], $datos);
                $datos['_hechos'][] = $clave;
                $datos['_auto'][] = $clave;
                $prefijo .= "✔️ {$pregunta['titulo']}: **{$opciones[0]['texto']}**\n";
                continue;
            }

            $this->guardar($conversacion, $datos);
            return $this->preguntar($clave, $datos, $conversacion, $prefijo ? $prefijo . "\n" : '');
        }

        $this->guardar($conversacion, $datos);
        return $this->resumen($datos, $prefijo ? $prefijo . "\n" : '');
    }

    private function preguntar(string $clave, array $datos, ConversacionChatbot $conversacion, string $prefijo = ''): array
    {
        $pregunta = $this->pasos()[$clave]['pregunta']($datos);
        $opciones = $pregunta['opciones'] ?? [];

        if (!empty($datos['_hechos'])) {
            $opciones[] = ['valor' => self::ATRAS, 'texto' => '↩️ Atrás', 'secundaria' => true];
        }

        return $this->respuesta($prefijo . $pregunta['texto'], $clave, $opciones, $pregunta['entrada'] ?? null);
    }

    private function retroceder(ConversacionChatbot $conversacion, array $datos): array
    {
        $hechos = $datos['_hechos'] ?? [];
        $auto = $datos['_auto'] ?? [];
        $pasos = $this->pasos();

        // Se saltan los pasos que se eligieron solos.
        do {
            $clave = array_pop($hechos);
            if ($clave === null) {
                $this->guardar($conversacion, ['_hechos' => [], '_auto' => []]);
                return $this->preguntar('dni', ['_hechos' => [], '_auto' => []], $conversacion);
            }
            foreach ($pasos[$clave]['campos'] as $campo) {
                unset($datos[$campo]);
            }
        } while (in_array($clave, $auto, true));

        $datos['_hechos'] = $hechos;
        $datos['_auto'] = array_values(array_intersect($auto, $hechos));
        $this->guardar($conversacion, $datos);

        return $this->preguntar($clave, $datos, $conversacion, "↩️ Volvamos un paso.\n\n");
    }

    // ======================================================
    // DEFINICIÓN DE LOS PASOS (mismo orden que el formulario)
    // ======================================================

    private function pasos(): array
    {
        $s = $this->matriculaService;
        $siempre = fn () => true;
        $esAcademia = fn ($d) => ($d['modalidad'] ?? null) === 'academia';
        $esColegio = fn ($d) => ($d['modalidad'] ?? null) === 'colegio';
        $conApoderado = fn ($d) => isset($d['modalidad']) && $s->requiereApoderado($d);

        return [
            'dni' => [
                'aplica' => $siempre,
                'campos' => ['alumno_dni'],
                'pregunta' => fn () => [
                    'texto' => "🪪 Escribe el **DNI del estudiante** (8 dígitos):",
                    'entrada' => ['tipo' => 'numeric', 'placeholder' => 'Ej: 70001234', 'max' => 8],
                ],
                'procesar' => function ($m, &$d) {
                    $dni = preg_replace('/\D/', '', $m);
                    if (strlen($dni) !== 8) {
                        return ['error' => 'El DNI debe tener 8 dígitos.'];
                    }
                    $d['alumno_dni'] = $dni;
                },
            ],
            'cv' => [
                'aplica' => $siempre,
                'campos' => ['alumno_nombres', 'alumno_ape_paterno', 'alumno_ape_materno', 'dni_verificado'],
                'pregunta' => fn () => [
                    'texto' => "🔐 Escribe el **código de verificación (CV)**: es el dígito que aparece después del guion en el DNI (ej. 12345678-**5**).",
                    'entrada' => ['tipo' => 'numeric', 'placeholder' => 'Un dígito', 'max' => 1],
                ],
                'procesar' => function ($m, &$d) {
                    $cv = preg_replace('/\D/', '', $m);
                    $r = $this->dniService->verificar($d['alumno_dni'] ?? '', $cv, 'chat:' . request()->ip());
                    if (!$r['ok']) {
                        return Str::contains($r['error'], 'CV') || Str::contains($r['error'], 'intentos')
                            ? ['error' => $r['error']]
                            : ['error' => $r['error'], 'volver' => 'dni'];
                    }
                    $d['alumno_nombres'] = $r['datos']['nombres'];
                    $d['alumno_ape_paterno'] = $r['datos']['apellido_paterno'];
                    $d['alumno_ape_materno'] = $r['datos']['apellido_materno'];
                    $d['dni_verificado'] = $r['datos']['dni'];
                },
            ],
            'modalidad' => $this->pasoOpciones('Modalidad', ['modalidad'], fn () => collect([
                ['id' => 'colegio', 'nombre' => 'Colegio', 'detalle' => $this->desde('colegio', 'Primaria y Secundaria')],
                ['id' => 'academia', 'nombre' => 'Academia', 'detalle' => $this->desde('academia', 'Preparación universitaria')],
            ]), "✅ ¡DNI verificado!\n\n🎓 ¿Qué deseas matricular?", $siempre, 'modalidad', 'modalidad_nombre', fn ($d) => "Hola **{$d['alumno_nombres']}** 👋\n\n", false),

            'sede' => $this->pasoOpciones('Sede', [], fn () => $s->sedes(), '📍 Elige la **sede**:', $siempre, 'id_sede', 'sede_nombre'),
            'entorno' => $this->pasoOpciones('Entorno', [], fn () => $s->entornos(), '🏫 Elige el **entorno**:', $siempre, 'id_entorno', 'entorno_nombre'),

            'universidad' => $this->pasoOpciones('Universidad', [], fn () => $s->universidades(), '🏛️ ¿A qué **universidad** postulas?', $esAcademia, 'id_universidad', 'universidad_nombre'),
            'tipo_ciclo' => $this->pasoOpciones('Tipo de ciclo', [], fn () => $s->tiposCiclo(), '🗓️ Elige el **tipo de ciclo**:', $esAcademia, 'id_tipo_ciclo', 'tipo_ciclo_nombre'),

            'nivel' => $this->pasoOpciones('Nivel', [], fn () => $s->niveles(), '📚 Elige el **nivel educativo**:', $esColegio, 'id_nivel', 'nivel_nombre'),
            'grado' => $this->pasoOpciones('Grado', [], fn ($d) => $s->grados($d['id_nivel'] ?? 0), '🔢 Elige el **grado**:', $esColegio, 'grado', 'grado_nombre'),
            'seccion' => $this->pasoOpciones('Sección', [], fn () => $s->secciones(), '🔤 Elige la **sección**:', $esColegio, 'seccion', 'seccion_nombre'),

            'turno' => $this->pasoOpciones('Turno', [], fn () => $s->turnos(), '🕐 Elige el **turno**:', $siempre, 'id_turno', 'turno_nombre'),

            'ciclo' => [
                'aplica' => $siempre,
                'campos' => ['id_ciclo', 'ciclo_nombre', 'ciclo_fechas', 'ciclo_importe', 'ciclo_descuento', 'ciclo_monto'],
                'pregunta' => function ($d) {
                    $ciclos = $this->ciclosDisponibles($d);
                    if ($ciclos->isEmpty()) {
                        return ['texto' => "😕 No hay ciclos disponibles para esa combinación.\n\nEscribe **atrás** para cambiar el turno u otra opción.", 'opciones' => []];
                    }
                    return [
                        'texto' => "📅 Elige tu **ciclo**. El precio ya incluye **5% de descuento** por pago al contado:",
                        'opciones' => $ciclos->map(fn ($c) => [
                            'valor' => (string) $c['id'],
                            'texto' => $c['nombre'],
                            'detalle' => "{$c['fecha_inicio']} – {$c['fecha_fin']} · S/ " . number_format($c['monto'], 2),
                        ])->all(),
                    ];
                },
                'procesar' => function ($m, &$d) {
                    $ciclos = $this->ciclosDisponibles($d);
                    $c = $this->elegir($m, $ciclos->map(fn ($c) => ['id' => (string) $c['id'], 'nombre' => $c['nombre']] + $c));
                    if (!$c) {
                        return ['error' => 'Elige uno de los ciclos de la lista.'];
                    }
                    $d['id_ciclo'] = (int) $c['id'];
                    $d['ciclo_nombre'] = $c['nombre'];
                    $d['ciclo_fechas'] = "{$c['fecha_inicio']} – {$c['fecha_fin']}";
                    $d['ciclo_importe'] = $c['importe'];
                    $d['ciclo_descuento'] = $c['descuento'];
                    $d['ciclo_monto'] = $c['monto'];
                },
            ],

            'email' => $this->pasoTexto('alumno_email', '📧 Escribe el **correo electrónico** del estudiante (ahí llegarán sus credenciales):', 'email', 'nombre@gmail.com',
                fn ($v) => filter_var($v, FILTER_VALIDATE_EMAIL) ? null : 'Ese correo no es válido.'),

            'celular' => [
                'aplica' => $siempre,
                'campos' => ['alumno_celular'],
                'pregunta' => fn ($d) => [
                    'texto' => '📱 Escribe el **celular** del estudiante (9 dígitos)' . ($d['modalidad'] === 'colegio' ? ' o elige *Omitir*:' : ':'),
                    'opciones' => $d['modalidad'] === 'colegio' ? [['valor' => self::OMITIR, 'texto' => 'Omitir']] : [],
                    'entrada' => ['tipo' => 'tel', 'placeholder' => '9XXXXXXXX', 'max' => 9],
                ],
                'procesar' => function ($m, &$d) {
                    if ($m === self::OMITIR && $d['modalidad'] === 'colegio') {
                        $d['alumno_celular'] = null;
                        return;
                    }
                    $cel = preg_replace('/\D/', '', $m);
                    if (!preg_match('/^9\d{8}$/', $cel)) {
                        return ['error' => 'El celular debe tener 9 dígitos y empezar con 9.'];
                    }
                    $d['alumno_celular'] = $cel;
                },
            ],

            'genero' => $this->pasoOpciones('Género', [], fn () => collect([
                ['id' => 'M', 'nombre' => 'Masculino'], ['id' => 'F', 'nombre' => 'Femenino'],
            ]), '⚧ Género del estudiante:', $siempre, 'alumno_genero', 'genero_nombre', null, false),

            'fecha_nac' => $this->pasoFecha('alumno_fecha_nac', '🎂 **Fecha de nacimiento** del estudiante (DD/MM/AAAA):', 2, 80),

            'es_mayor' => [
                'aplica' => $esAcademia,
                'campos' => ['es_mayor'],
                'pregunta' => fn () => [
                    'texto' => '🧑 ¿El postulante es **mayor de edad** y se matricula sin apoderado?',
                    'opciones' => [['valor' => 'si', 'texto' => 'Sí, soy mayor de edad'], ['valor' => 'no', 'texto' => 'No, registraré a mi apoderado']],
                ],
                'procesar' => function ($m, &$d) {
                    $v = $this->normalizar($m);
                    $v = Str::startsWith($v, 's') ? 'si' : (Str::startsWith($v, 'n') ? 'no' : null);
                    if (!$v) {
                        return ['error' => 'Responde *Sí* o *No*.'];
                    }
                    if ($v === 'si' && Carbon::parse($d['alumno_fecha_nac'])->age < 18) {
                        return ['error' => 'Según la fecha de nacimiento eres menor de edad: necesitamos los datos de tu apoderado.'];
                    }
                    $d['es_mayor'] = $v;
                },
            ],

            'apo_nombres' => $this->pasoTexto('apoderado_nombres', "👨‍👩‍👧 Ahora los datos del **apoderado**.\n\nEscribe sus **nombres**:", 'text', 'Nombres',
                fn ($v) => mb_strlen($v) >= 2 ? null : 'Escribe los nombres del apoderado.', $conApoderado),
            'apo_paterno' => $this->pasoTexto('apoderado_ape_paterno', 'Apellido **paterno** del apoderado:', 'text', 'Apellido paterno',
                fn ($v) => mb_strlen($v) >= 2 ? null : 'Escribe el apellido paterno.', $conApoderado),
            'apo_materno' => $this->pasoTexto('apoderado_ape_materno', 'Apellido **materno** del apoderado:', 'text', 'Apellido materno',
                fn ($v) => mb_strlen($v) >= 2 ? null : 'Escribe el apellido materno.', $conApoderado),
            'apo_dni' => $this->pasoTexto('apoderado_dni', '🪪 **DNI** del apoderado:', 'numeric', '8 dígitos',
                fn ($v, $d) => !preg_match('/^\d{8}$/', $v) ? 'El DNI debe tener 8 dígitos.' : ($v === $d['alumno_dni'] ? 'El DNI del apoderado debe ser distinto al del estudiante.' : null),
                $conApoderado, fn ($v) => preg_replace('/\D/', '', $v)),
            'apo_email' => $this->pasoTexto('apoderado_email', '📧 **Correo** del apoderado:', 'email', 'nombre@gmail.com',
                fn ($v) => filter_var($v, FILTER_VALIDATE_EMAIL) ? null : 'Ese correo no es válido.', $conApoderado),
            'apo_celular' => $this->pasoTexto('apoderado_celular', '📱 **Celular** del apoderado:', 'tel', '9XXXXXXXX',
                fn ($v) => preg_match('/^9\d{8}$/', $v) ? null : 'El celular debe tener 9 dígitos y empezar con 9.',
                $conApoderado, fn ($v) => preg_replace('/\D/', '', $v)),
            'apo_fecha_nac' => $this->pasoFecha('apoderado_fecha_nac', '🎂 **Fecha de nacimiento** del apoderado (DD/MM/AAAA):', 18, 100, $conApoderado),
        ];
    }

    /** Paso con botones de opción. */
    private function pasoOpciones(string $titulo, array $extra, callable $catalogo, string $texto, callable $aplica, string $campoId, string $campoNombre, ?callable $intro = null, bool $auto = true): array
    {
        return [
            'aplica' => $aplica,
            'campos' => array_merge([$campoId, $campoNombre], $extra),
            'pregunta' => fn ($d) => [
                'titulo' => $titulo,
                'texto' => ($intro ? $intro($d) : '') . $texto,
                'auto' => $auto,
                'opciones' => collect($catalogo($d))->map(fn ($o) => [
                    'valor' => (string) $o['id'],
                    'texto' => $o['nombre'],
                    'detalle' => $o['detalle'] ?? null,
                ])->values()->all(),
            ],
            'procesar' => function ($m, &$d) use ($catalogo, $campoId, $campoNombre) {
                $o = $this->elegir($m, collect($catalogo($d)));
                if (!$o) {
                    return ['error' => 'Elige una de las opciones.'];
                }
                $d[$campoId] = $o['id'];
                $d[$campoNombre] = $o['nombre'];
            },
        ];
    }

    /** Paso de texto libre con validación. */
    private function pasoTexto(string $campo, string $texto, string $tipo, string $placeholder, callable $validar, ?callable $aplica = null, ?callable $limpiar = null): array
    {
        return [
            'aplica' => $aplica ?? fn () => true,
            'campos' => [$campo],
            'pregunta' => fn () => ['texto' => $texto, 'entrada' => ['tipo' => $tipo, 'placeholder' => $placeholder]],
            'procesar' => function ($m, &$d) use ($campo, $validar, $limpiar) {
                $v = $limpiar ? $limpiar(trim($m)) : trim($m);
                if ($error = $validar($v, $d)) {
                    return ['error' => $error];
                }
                $d[$campo] = $campo === 'alumno_email' || $campo === 'apoderado_email' ? mb_strtolower($v) : $v;
            },
        ];
    }

    /** Paso de fecha DD/MM/AAAA con rango de edad. */
    private function pasoFecha(string $campo, string $texto, int $edadMin, int $edadMax, ?callable $aplica = null): array
    {
        return [
            'aplica' => $aplica ?? fn () => true,
            'campos' => [$campo],
            'pregunta' => fn () => ['texto' => $texto, 'entrada' => ['tipo' => 'fecha', 'placeholder' => 'DD/MM/AAAA']],
            'procesar' => function ($m, &$d) use ($campo, $edadMin, $edadMax) {
                if (!preg_match('/^(\d{1,2})[\/\-.](\d{1,2})[\/\-.](\d{4})$/', trim($m), $p) || !checkdate((int) $p[2], (int) $p[1], (int) $p[3])) {
                    return ['error' => 'Escribe la fecha como **DD/MM/AAAA** (ej. 15/03/2009).'];
                }
                $fecha = Carbon::createFromDate((int) $p[3], (int) $p[2], (int) $p[1])->startOfDay();
                $edad = $fecha->age;
                if ($fecha->isFuture() || $edad < $edadMin || $edad > $edadMax) {
                    return ['error' => 'Revisa la fecha de nacimiento, no parece correcta.'];
                }
                $d[$campo] = $fecha->format('Y-m-d');
            },
        ];
    }

    // ======================================================
    // RESUMEN Y REGISTRO
    // ======================================================

    private function resumen(array $d, string $prefijo = ''): array
    {
        $fecha = fn ($f) => $f ? Carbon::parse($f)->format('d/m/Y') : '-';
        $eleccion = $d['modalidad'] === 'academia'
            ? $d['universidad_nombre'] . ' · ' . $d['tipo_ciclo_nombre']
            : "{$d['nivel_nombre']} · {$d['grado_nombre']} · {$d['seccion_nombre']}";

        $texto = $prefijo . "📋 **Revisa tu matrícula**\n\n"
            . "🎓 **" . ucfirst($d['modalidad']) . "** · {$eleccion}\n"
            . "📅 {$d['ciclo_nombre']}\n"
            . "🗓️ {$d['ciclo_fechas']}\n"
            . "📍 {$d['sede_nombre']} · {$d['entorno_nombre']} · {$d['turno_nombre']}\n\n"
            . "👤 **{$d['alumno_nombres']} {$d['alumno_ape_paterno']} {$d['alumno_ape_materno']}**\n"
            . "🪪 DNI {$d['alumno_dni']} · 🎂 {$fecha($d['alumno_fecha_nac'])}\n"
            . "📧 {$d['alumno_email']}" . (!empty($d['alumno_celular']) ? " · 📱 {$d['alumno_celular']}" : '') . "\n";

        if (!empty($d['apoderado_dni'])) {
            $texto .= "\n👨‍👩‍👧 Apoderado: **{$d['apoderado_nombres']} {$d['apoderado_ape_paterno']} {$d['apoderado_ape_materno']}**\n"
                . "🪪 DNI {$d['apoderado_dni']} · 📱 {$d['apoderado_celular']}\n";
        }

        $texto .= "\n💰 Matrícula: S/ " . number_format($d['ciclo_importe'], 2)
            . " − S/ " . number_format($d['ciclo_descuento'], 2) . " (5% contado)\n"
            . "**Total a pagar: S/ " . number_format($d['ciclo_monto'], 2) . "**\n\n"
            . "Al confirmar aceptas los **Términos y Condiciones** y la **Política de Privacidad**.";

        return $this->respuesta($texto, 'confirmar', [
            ['valor' => self::CONFIRMAR, 'texto' => '✅ Confirmo mi matrícula'],
            ['valor' => self::ATRAS, 'texto' => '↩️ Atrás', 'secundaria' => true],
            ['valor' => self::CANCELAR, 'texto' => '❌ Cancelar', 'secundaria' => true],
        ]);
    }

    private function confirmar(string $comando, ConversacionChatbot $conversacion, array $d): array
    {
        $si = [self::CONFIRMAR, 'si', 'confirmo', 'confirmar', 'acepto', 'ok', 'dale'];
        if (!in_array($comando, $si, true)) {
            return $this->resumen($d, "Elige **Confirmo mi matrícula**, **Atrás** o **Cancelar**.\n\n");
        }

        $data = array_merge(
            array_intersect_key($d, array_flip([
                'modalidad', 'id_ciclo', 'es_mayor', 'grado', 'seccion',
                'alumno_nombres', 'alumno_ape_paterno', 'alumno_ape_materno', 'alumno_dni', 'alumno_email',
                'alumno_celular', 'alumno_genero', 'alumno_fecha_nac',
                'apoderado_nombres', 'apoderado_ape_paterno', 'apoderado_ape_materno', 'apoderado_dni',
                'apoderado_email', 'apoderado_celular', 'apoderado_fecha_nac',
            ])),
            ['terminos_aceptados' => 1, 'politicas_aceptadas' => 1]
        );

        // Mismas reglas que el formulario web
        $validator = Validator::make($data, $this->matriculaService->reglas($data), $this->matriculaService->mensajes());
        $error = $validator->fails()
            ? implode("\n• ", $validator->errors()->all())
            : $this->matriculaService->validarNegocio($data, $d['dni_verificado'] ?? '');

        if ($error) {
            return $this->resumen($d, "⚠️ Hay datos por corregir:\n• {$error}\n\nEscribe **atrás** para corregirlos.\n\n");
        }

        $r = $this->matriculaService->procesarMatricula($data, $conversacion->id);

        if (!$r['success']) {
            return $this->resumen($d, "⚠️ {$r['error']}\n\n");
        }

        $pago = config('matricula.pago');

        return $this->respuesta(
            "🎉 **¡Matrícula registrada!**\n\n"
            . "Tu código es **{$r['codigo']}**. Paga **S/ {$r['monto_total']}** antes del **{$r['fecha_expiracion']}** e indica el código en tu pago.\n\n"
            . "📧 Cuando verifiquemos tu pago enviaremos tus credenciales a **{$r['email']}**:\n"
            . "• Usuario: tu **DNI**\n• Contraseña: tu **fecha de nacimiento** (ddmmaaaa)",
            'finalizado',
            [
                ['valor' => 'pago', 'texto' => '💳 Ver formas de pago'],
                ['valor' => 'matricula', 'texto' => '📝 Otra matrícula', 'secundaria' => true],
            ],
            null,
            [
                'codigo' => $r['codigo'],
                'monto' => $r['monto_total'],
                'expira' => $r['fecha_expiracion'],
                'banco' => $pago['banco'],
                'cuenta' => $pago['cuenta'],
                'cci' => $pago['cci'],
                'titular' => $pago['titular'],
                'qr' => asset($pago['qr']),
                'whatsapp' => config('matricula.whatsapp'),
            ]
        );
    }

    // ======================================================
    // INFORMACIÓN GENERAL
    // ======================================================

    private function informacion(string $c): ?string
    {
        $s = $this->matriculaService;

        if (Str::contains($c, ['cost', 'precio', 'cuanto', 'pension'])) {
            return "💰 **Costos de matrícula** (pago al contado con 5% de descuento):\n\n"
                . "• 🏫 Colegio: " . $this->desde('colegio', 'consultar') . "\n"
                . "• 🎓 Academia: " . $this->desde('academia', 'consultar') . "\n\n"
                . "El monto exacto depende del ciclo; lo verás antes de confirmar.";
        }
        if (Str::contains($c, ['ubica', 'direcc', 'donde', 'sede'])) {
            return "📍 **Nuestras sedes:**\n\n" . $s->sedes()->map(fn ($x) => "• **{$x['nombre']}**" . ($x['detalle'] ? "\n  {$x['detalle']}" : ''))->implode("\n");
        }
        if (Str::contains($c, ['horar', 'turno', 'hora'])) {
            return "🕐 **Turnos:**\n\n" . $s->turnos()->map(fn ($x) => "• **{$x['nombre']}**: {$x['detalle']}")->implode("\n");
        }
        if (Str::contains($c, ['requisit', 'document', 'necesit'])) {
            return "📄 **Para matricularte necesitas:**\n\n"
                . "• DNI del estudiante y su código de verificación (CV)\n"
                . "• Correo electrónico y celular\n"
                . "• Fecha de nacimiento\n"
                . "• Datos del apoderado (DNI, correo y celular) si el estudiante es menor de edad";
        }
        if (Str::contains($c, ['pago', 'pagar', 'cuenta', 'yape', 'plin', 'banco', 'transfer'])) {
            $p = config('matricula.pago');
            return "💳 **Formas de pago**\n\n"
                . "• **QR** con cualquier billetera (Yape, Plin, BBVA…)\n"
                . "• **Transferencia {$p['banco']}**\n  Cuenta: {$p['cuenta']}\n  CCI: {$p['cci']}\n  Titular: {$p['titular']}\n\n"
                . "Indica tu código de matrícula. Al verificar el pago te enviamos tus credenciales por correo.";
        }
        if (Str::contains($c, ['contact', 'telefono', 'whatsapp', 'llamar'])) {
            return "📞 Escríbenos por WhatsApp al **" . config('matricula.telefono') . "**.";
        }
        if (Str::contains($c, ['credencial', 'usuario', 'contrasena', 'intranet'])) {
            return "🔐 Al verificar tu pago te enviamos un correo con tus credenciales:\n\n• Usuario: tu **DNI**\n• Contraseña: tu **fecha de nacimiento** (ddmmaaaa)";
        }

        return null;
    }

    private function opcionesMenu(): array
    {
        return [
            ['valor' => 'matricula', 'texto' => '📝 Matricularme'],
            ['valor' => 'costos', 'texto' => '💰 Costos'],
            ['valor' => 'requisitos', 'texto' => '📄 Requisitos'],
            ['valor' => 'pago', 'texto' => '💳 Formas de pago'],
            ['valor' => 'horarios', 'texto' => '🕐 Horarios'],
            ['valor' => 'ubicacion', 'texto' => '📍 Sedes'],
        ];
    }

    // ======================================================
    // UTILIDADES
    // ======================================================

    private function desde(string $modalidad, string $sinDato): string
    {
        $monto = $this->matriculaService->montoDesde($modalidad);
        return $monto !== null ? 'desde S/ ' . number_format($monto, 2) : $sinDato;
    }

    private function ciclosDisponibles(array $d)
    {
        return $this->matriculaService->ciclos([
            'modalidad' => $d['modalidad'] ?? null,
            'id_sede' => $d['id_sede'] ?? null,
            'id_entorno' => $d['id_entorno'] ?? null,
            'id_universidad' => $d['id_universidad'] ?? null,
            'id_tipo_ciclo' => $d['id_tipo_ciclo'] ?? null,
            'id_turno' => $d['id_turno'] ?? null,
            'id_nivel' => $d['id_nivel'] ?? null,
        ]);
    }

    /** Busca la opción por valor, por número de la lista o por nombre. */
    private function elegir(string $entrada, $opciones): ?array
    {
        $opciones = collect($opciones)->values();
        $e = $this->normalizar($entrada);
        if ($e === '') {
            return null;
        }

        $o = $opciones->first(fn ($o) => $this->normalizar((string) $o['id']) === $e)
            ?? $opciones->first(fn ($o) => $this->normalizar($o['nombre']) === $e)
            ?? $opciones->first(fn ($o) => !empty($o['alias']) && $this->normalizar(str_replace('_', ' ', $o['alias'])) === str_replace('_', ' ', $e));
        if ($o) {
            return $o;
        }

        if (ctype_digit($e) && (int) $e >= 1 && (int) $e <= $opciones->count()) {
            return $opciones[(int) $e - 1];
        }

        // Palabra completa ("A" → "Sección A", "tarde" → "Tarde") y luego coincidencia parcial.
        $palabra = $opciones->filter(fn ($o) => preg_match('/\b' . preg_quote($e, '/') . '\b/u', $this->normalizar($o['nombre'])));
        if ($palabra->count() === 1) {
            return $palabra->first();
        }
        $coinciden = $opciones->filter(fn ($o) => Str::contains($this->normalizar($o['nombre']), $e));
        return $coinciden->count() === 1 ? $coinciden->first() : null;
    }

    private function normalizar(string $texto): string
    {
        return trim(Str::lower(Str::ascii($texto)));
    }

    private function respuesta(string $mensaje, string $paso, array $opciones = [], ?array $entrada = null, ?array $tarjeta = null): array
    {
        return [
            'mensaje' => $mensaje,
            'paso' => $paso,
            'intencion' => $paso === 'inicio' ? 'informacion' : 'matricula',
            'opciones' => $opciones,
            'entrada' => $entrada,
            'tarjeta' => $tarjeta,
        ];
    }

    private function guardar(ConversacionChatbot $conversacion, array $datos): void
    {
        $conversacion->update(['datos_recolectados' => $datos]);
    }

    private function obtenerConversacion(string $sessionId): ConversacionChatbot
    {
        return ConversacionChatbot::firstOrCreate(
            ['session_id' => $sessionId, 'estado' => 'activa'],
            [
                'mensajes' => [],
                'datos_recolectados' => [],
                'paso_actual' => 'inicio',
                'ip_usuario' => request()->ip(),
                'user_agent' => Str::limit((string) request()->userAgent(), 500),
                'ultimo_mensaje' => now(),
            ]
        );
    }

    private function registrarMensaje(ConversacionChatbot $conversacion, string $rol, string $mensaje): void
    {
        $mensajes = $conversacion->mensajes ?? [];
        $mensajes[] = ['rol' => $rol, 'mensaje' => $mensaje, 'timestamp' => now()->toISOString()];
        $conversacion->update(['mensajes' => $mensajes]);
    }
}
