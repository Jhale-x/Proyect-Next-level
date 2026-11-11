<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Ciclo;
use App\Models\Cuota;
use App\Models\Matricula;
use App\Models\Pago;
use App\Services\MatriculaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

/**
 * Administración de ciclos y cuotas desde el panel de matrículas.
 * Los ciclos no se eliminan: se desactivan para conservar el historial de matrículas.
 */
class CicloPanelController extends Controller
{
    private const MODALIDADES = [1 => 'Colegio', 2 => 'Academia'];

    public function __construct(protected MatriculaService $matriculaService)
    {
    }

    public function index(Request $request)
    {
        $query = Ciclo::with(['sede', 'turno', 'universidad', 'tipoCiclo', 'nivelEducativo', 'cuotas'])
            ->withCount('matriculas');

        if ($request->filled('modalidad')) {
            $query->where('id_modalidad', $request->modalidad);
        }
        match ($request->estado) {
            'activos' => $query->where('activo', 1),
            'inactivos' => $query->where('activo', 0),
            'vigentes' => $query->where('activo', 1)->where('fecha_fin', '>=', today()),
            default => null,
        };
        if ($request->filled('search')) {
            $buscar = $request->search;
            $query->where(fn ($q) => $q->where('nombre', 'LIKE', "%{$buscar}%")->orWhere('codigo', 'LIKE', "%{$buscar}%"));
        }

        $ciclos = $query->orderByDesc('activo')->orderBy('id_modalidad')->orderBy('fecha_inicio')->orderBy('nombre')
            ->paginate(25)->withQueryString();

        $resumen = [
            'total' => Ciclo::count(),
            'visibles' => Ciclo::where('activo', 1)->where('fecha_fin', '>=', today())->whereHas('cuotas')->count(),
            'inactivos' => Ciclo::where('activo', 0)->count(),
            'sin_cuota' => Ciclo::where('activo', 1)->whereDoesntHave('cuotas')->count(),
        ];

        return view('panel.ciclos.index', [
            'ciclos' => $ciclos,
            'resumen' => $resumen,
            'modalidades' => self::MODALIDADES,
        ]);
    }

    public function create()
    {
        return view('panel.ciclos.form', $this->datosFormulario(new Ciclo(['activo' => true, 'id_modalidad' => 2])));
    }

    public function store(Request $request)
    {
        $datos = $this->validar($request);

        $ciclo = DB::transaction(function () use ($datos, $request) {
            $ciclo = Ciclo::create($this->camposCiclo($datos));
            Cuota::create([
                'id_ciclo' => $ciclo->id_ciclo,
                'numero' => 1,
                'nombre' => 'Matrícula',
                'monto' => $request->monto_matricula,
                'fecha_vencimiento' => $ciclo->fecha_inicio,
                'orden' => 0,
            ]);
            return $ciclo;
        });

        return redirect()->route('panel.ciclos.edit', $ciclo->id_ciclo)
            ->with('success', "Ciclo {$ciclo->codigo} creado. Ya aparece en la matrícula en línea; aquí puedes agregar sus pensiones.");
    }

    public function edit($id)
    {
        $ciclo = Ciclo::with(['cuotas' => fn ($q) => $q->orderBy('orden')->orderBy('numero')->orderBy('id_cuota')])
            ->withCount('matriculas')->findOrFail($id);

        return view('panel.ciclos.form', $this->datosFormulario($ciclo));
    }

    public function update(Request $request, $id)
    {
        $ciclo = Ciclo::findOrFail($id);
        $ciclo->update($this->camposCiclo($this->validar($request, $ciclo)));

        return back()->with('success', 'Los datos del ciclo se actualizaron.');
    }

    public function cambiarEstado($id)
    {
        $ciclo = Ciclo::findOrFail($id);
        $ciclo->update(['activo' => !$ciclo->activo]);

        return back()->with('success', $ciclo->activo
            ? "Ciclo {$ciclo->codigo} activado: vuelve a mostrarse en la matrícula en línea."
            : "Ciclo {$ciclo->codigo} desactivado: ya no se muestra en la matrícula en línea. Sus matrículas se conservan.");
    }

    /** Copia un ciclo con sus cuotas para preparar una nueva campaña. */
    public function duplicar($id)
    {
        $original = Ciclo::with('cuotas')->findOrFail($id);

        $copia = DB::transaction(function () use ($original) {
            $copia = $original->replicate();
            $copia->codigo = $this->codigoUnico($original->codigo . '-COPIA');
            $copia->nombre = Str::limit($original->nombre . ' (copia)', 150, '');
            $copia->activo = false;
            $copia->save();

            foreach ($original->cuotas as $cuota) {
                $nueva = $cuota->replicate();
                $nueva->id_ciclo = $copia->id_ciclo;
                $nueva->save();
            }
            return $copia;
        });

        return redirect()->route('panel.ciclos.edit', $copia->id_ciclo)
            ->with('success', "Se creó la copia {$copia->codigo} (desactivada). Ajusta las fechas y actívala cuando esté lista.");
    }

    // ------------------------------------------------------------- cuotas

    public function guardarCuota(Request $request, $id)
    {
        $ciclo = Ciclo::findOrFail($id);
        $datos = $this->validarCuota($request);
        $ciclo->cuotas()->create($datos);

        return back()->with('success', "Se agregó la cuota «{$datos['nombre']}».");
    }

    public function actualizarCuota(Request $request, $id)
    {
        $cuota = Cuota::findOrFail($id);
        $cuota->update($this->validarCuota($request));

        return back()->with('success', "Se actualizó la cuota «{$cuota->nombre}».");
    }

    public function eliminarCuota($id)
    {
        $cuota = Cuota::findOrFail($id);

        if (Pago::where('id_cuota', $cuota->id_cuota)->exists()) {
            return back()->with('error', "La cuota «{$cuota->nombre}» tiene pagos registrados y no se puede eliminar.");
        }
        if ($cuota->ciclo->cuotas()->where('nombre', 'Matrícula')->count() === 1 && $cuota->nombre === 'Matrícula'
            && $cuota->ciclo->activo) {
            return back()->with('error', 'Es la única cuota de matrícula de un ciclo activo: sin ella el ciclo dejaría de mostrarse en la web. Edítala o desactiva el ciclo primero.');
        }

        $cuota->delete();

        return back()->with('success', "Se eliminó la cuota «{$cuota->nombre}».");
    }

    // ------------------------------------------------------------- ayudantes

    private function datosFormulario(Ciclo $ciclo): array
    {
        $catalogo = fn () => [
            'sedes' => $this->matriculaService->sedes(),
            'entornos' => $this->matriculaService->entornos(),
            'turnos' => $this->matriculaService->turnos(),
            'universidades' => $this->matriculaService->universidades(),
            'tiposCiclo' => $this->matriculaService->tiposCiclo(),
            'niveles' => $this->matriculaService->niveles(),
        ];

        $duplicadas = $ciclo->exists
            ? $ciclo->cuotas->groupBy(fn ($c) => mb_strtolower($c->nombre) . '|' . $c->numero . '|' . $c->monto)
                ->filter(fn ($g) => $g->count() > 1)->flatten()->pluck('id_cuota')->all()
            : [];

        return [
            'ciclo' => $ciclo,
            'modalidades' => self::MODALIDADES,
            'catalogo' => $catalogo(),
            'monto' => $ciclo->exists ? $this->matriculaService->calcularMonto($ciclo) : null,
            'duplicadas' => $duplicadas,
        ];
    }

    private function validar(Request $request, ?Ciclo $ciclo = null): array
    {
        $academia = (int) $request->id_modalidad === 2;

        return $request->validate([
            'id_modalidad' => ['required', Rule::in(array_keys(self::MODALIDADES))],
            'nombre' => 'required|string|max:150',
            'codigo' => ['nullable', 'string', 'max:50', 'regex:/^[A-Za-z0-9_\-]+$/',
                Rule::unique('ciclos', 'codigo')->ignore($ciclo?->id_ciclo, 'id_ciclo')],
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'id_sede' => 'required|exists:sedes,id',
            'id_entorno' => 'required|exists:entornos,id',
            'id_turno' => 'required|exists:turnos,id_turno',
            'id_universidad' => [$academia ? 'required' : 'nullable', 'exists:universidades,id_universidad'],
            'id_tipo_ciclo' => [$academia ? 'required' : 'nullable', 'exists:tipos_ciclo,id_tipo_ciclo'],
            'id_nivel' => [$academia ? 'nullable' : 'required', 'exists:niveles_educativos,id'],
            'activo' => 'nullable|boolean',
            'monto_matricula' => [$ciclo ? 'nullable' : 'required', 'numeric', 'min:0', 'max:99999'],
        ], [
            'nombre.required' => 'Escribe el nombre del ciclo.',
            'codigo.unique' => 'Ya existe un ciclo con ese código.',
            'codigo.regex' => 'El código solo puede tener letras, números, guiones y guion bajo.',
            'fecha_fin.after' => 'La fecha de fin debe ser posterior a la de inicio.',
            'id_universidad.required' => 'Elige la universidad del ciclo de academia.',
            'id_tipo_ciclo.required' => 'Elige el tipo de ciclo.',
            'id_nivel.required' => 'Elige el nivel (primaria o secundaria).',
            'monto_matricula.required' => 'Indica el monto de la matrícula.',
        ]);
    }

    private function camposCiclo(array $datos): array
    {
        $academia = (int) $datos['id_modalidad'] === 2;
        $campos = [
            'id_modalidad' => $datos['id_modalidad'],
            'nombre' => $datos['nombre'],
            'fecha_inicio' => $datos['fecha_inicio'],
            'fecha_fin' => $datos['fecha_fin'],
            'id_sede' => $datos['id_sede'],
            'id_entorno' => $datos['id_entorno'],
            'id_turno' => $datos['id_turno'],
            'id_universidad' => $academia ? $datos['id_universidad'] : null,
            'id_tipo_ciclo' => $academia ? $datos['id_tipo_ciclo'] : null,
            'id_nivel' => $academia ? null : $datos['id_nivel'],
            'activo' => (bool) ($datos['activo'] ?? false),
        ];
        $campos['codigo'] = filled($datos['codigo'] ?? null)
            ? Str::upper($datos['codigo'])
            : $this->codigoUnico(($academia ? 'ACA' : 'COL') . '_' . now()->format('Y') . '_' . Str::upper(Str::random(4)));

        return $campos;
    }

    private function codigoUnico(string $base): string
    {
        $base = Str::upper(Str::limit($base, 44, ''));
        $codigo = $base;
        for ($n = 2; Ciclo::where('codigo', $codigo)->exists(); $n++) {
            $codigo = "{$base}-{$n}";
        }
        return $codigo;
    }

    private function validarCuota(Request $request): array
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:100',
            'numero' => 'required|integer|min:0|max:99',
            'monto' => 'required|numeric|min:0|max:99999',
            'fecha_vencimiento' => 'required|date',
            'orden' => 'nullable|integer|min:0|max:99',
        ], [
            'nombre.required' => 'Escribe el nombre de la cuota (por ejemplo, Matrícula o Cuota 1).',
            'monto.required' => 'Indica el monto de la cuota.',
            'fecha_vencimiento.required' => 'Indica la fecha de vencimiento de la cuota.',
        ]);
        $datos['orden'] = (int) ($datos['orden'] ?? 0);

        return $datos;
    }
}
