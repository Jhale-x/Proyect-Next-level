<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Alumno;

class AlumnosController extends Controller
{
    // ======================================================
    // MÉTODOS PARA EL PANEL DEL ALUMNO (AUTHENTICATED)
    // ======================================================
    
    public function dashboard()
    {
        $alumno = Auth::guard('alumno')->user();
        $cursos = $this->getCursos($alumno);
        
        return view('Alumno.dashboard', compact('alumno', 'cursos'));
    }
    
    public function paginaInstitucional()
    {
        $alumno = Auth::guard('alumno')->user();
        return view('Alumno.pagina_institucional', compact('alumno'));
    }
    
    public function activity()
    {
        $alumno = Auth::guard('alumno')->user();
        return view('Alumno.activity', compact('alumno'));
    }
    
    public function organizations()
    {
        $alumno = Auth::guard('alumno')->user();
        return view('Alumno.organizations', compact('alumno'));
    }
    
    public function calendar()
    {
        $alumno = Auth::guard('alumno')->user();
        return view('Alumno.calendar', compact('alumno'));
    }
    
    public function messages()
    {
        $alumno = Auth::guard('alumno')->user();
        return view('Alumno.messages', compact('alumno'));
    }
    
    public function qualifications()
    {
        $alumno = Auth::guard('alumno')->user();
        return view('Alumno.qualifications', compact('alumno'));
    }
    
    public function tools()
    {
        $alumno = Auth::guard('alumno')->user();
        return view('Alumno.tools', compact('alumno'));
    }
    
    public function eti()
    {
        $alumno = Auth::guard('alumno')->user();
        
        // Obtener nivel, grado y sección del alumno
        $nivel = null;
        $grado = null;
        $seccion = null;
        
        if ($alumno->id_salon) {
            $salonInfo = DB::table('salones as s')
                ->leftJoin('niveles as n', 's.id_nivel', '=', 'n.id_nivel')
                ->leftJoin('grados as g', 's.id_grado', '=', 'g.id_grado')
                ->leftJoin('secciones as sec', 's.id_seccion', '=', 'sec.id_seccion')
                ->where('s.id_salon', $alumno->id_salon)
                ->select('n.nivel as nivel', 'g.grado as grado', 'sec.seccion as seccion')
                ->first();
            
            if ($salonInfo) {
                $nivel = $salonInfo->nivel;
                $grado = $salonInfo->grado;
                $seccion = $salonInfo->seccion;
            }
        }
        
        // Obtener notas del alumno (simuladas o desde BD)
        // Aquí debes reemplazar con tu lógica real de base de datos
        $notas = $this->getNotasAlumno($alumno->id_alumno);
        
        // Calcular promedio general
        $todasLasNotas = [];
        foreach ($notas as $materia => $notasMateria) {
            foreach ($notasMateria as $nota) {
                if ($nota) {
                    $todasLasNotas[] = $nota;
                }
            }
        }
        $promedioGeneral = count($todasLasNotas) > 0 ? array_sum($todasLasNotas) / count($todasLasNotas) : 0;
        
        return view('Alumno.eti', compact('alumno', 'nivel', 'grado', 'seccion', 'notas', 'promedioGeneral'));
    }

    private function getNotasAlumno($idAlumno)
    {
        // EJEMPLO DE NOTAS SIMULADAS
        // Reemplaza esto con la consulta real a tu base de datos
        return [
            'Matemática' => [
                1 => 15, 2 => 14, 3 => 16, 4 => 15, 5 => 17,
                6 => 14, 7 => 16, 8 => 15, 9 => 18, 10 => 16
            ],
            'Comunicación' => [
                1 => 14, 2 => 15, 3 => 14, 4 => 16, 5 => 15,
                6 => 14, 7 => 15, 8 => 16, 9 => 14, 10 => 15
            ],
            'Ciencia y Tecnología' => [
                1 => 16, 2 => 15, 3 => 17, 4 => 16, 5 => 18,
                6 => 15, 7 => 16, 8 => 17, 9 => 15, 10 => 16
            ],
            'Personal Social' => [
                1 => 13, 2 => 14, 3 => 15, 4 => 14, 5 => 16,
                6 => 13, 7 => 15, 8 => 14, 9 => 15, 10 => 14
            ],
            'Inglés' => [
                1 => 17, 2 => 16, 3 => 18, 4 => 17, 5 => 19,
                6 => 16, 7 => 17, 8 => 18, 9 => 16, 10 => 17
            ],
        ];
    }
    
    public function support()
    {
        $alumno = Auth::guard('alumno')->user();
        return view('Alumno.support', compact('alumno'));
    }
    
    public function courses()
    {
        $alumno = Auth::guard('alumno')->user();
        
        // Obtener los cursos del alumno según su salón
        $cursos = collect();
        
        if ($alumno->id_salon) {
            $cursos = DB::table('docente_curso as dc')
                ->join('docente_salon as ds', 'dc.id_docente_salon', '=', 'ds.id_docente_salon')
                ->join('cursos as c', 'dc.id_curso', '=', 'c.id_curso')
                ->join('users as u', 'ds.id_usuario', '=', 'u.id_usuario')
                ->where('ds.id_salon', $alumno->id_salon)
                ->select(
                    'c.id_curso as id_curso',
                    'c.materia as nombre',
                    'c.materia',
                    'u.nombre as docente',
                    'u.apellido as docente_apellido'
                )
                ->get();
        }
        
        return view('Alumno.courses', compact('alumno', 'cursos'));
    }
    
    public function courseDetail($id)
    {
        $alumno = Auth::guard('alumno')->user();
        
        $curso = DB::table('docente_curso as dc')
            ->join('docente_salon as ds', 'dc.id_docente_salon', '=', 'ds.id_docente_salon')
            ->join('cursos as c', 'dc.id_curso', '=', 'c.id_curso')
            ->join('users as u', 'ds.id_usuario', '=', 'u.id_usuario')
            ->where('ds.id_salon', $alumno->id_salon)
            ->where('c.id_curso', $id)
            ->select('c.id_curso', 'c.materia as nombre', 'u.nombre as docente')
            ->first();
        
        if (!$curso) {
            abort(404, 'Curso no encontrado');
        }
        
        return view('Alumno.course_detail', compact('alumno', 'curso'));
    }
    
    // ======================================================
    // MÉTODOS PARA ADMINISTRACIÓN (CRUD DE ALUMNOS)
    // ======================================================
    
    public function index()
    {
        $alumnos = Alumno::orderBy('created_at', 'desc')->paginate(15);
        return view('Admin.alumnos.index', compact('alumnos'));
    }
    
    public function create()
    {
        $grados = DB::table('grados')
            ->select('id_grado', 'grado', 'id_nivel')
            ->orderBy('grado', 'asc')
            ->get();
        
        $niveles = DB::table('niveles')
            ->select('id_nivel', 'nivel')
            ->orderBy('nivel', 'asc')
            ->get();
        
        $secciones = DB::table('secciones')
            ->select('id_seccion', 'seccion')
            ->orderBy('seccion', 'asc')
            ->get();
        
        $facultades = DB::table('facultades')
            ->select('id_facultad', 'facultad')
            ->orderBy('facultad', 'asc')
            ->get();
        
        $cursos = DB::table('cursos')
            ->select('id_curso', 'materia')
            ->orderBy('materia', 'asc')
            ->get();
        
        $salones = DB::table('salones')
            ->select('salones.id_salon', 'niveles.nivel', 'grados.grado', 'secciones.seccion', 'facultades.facultad')
            ->leftJoin('niveles', 'salones.id_nivel', '=', 'niveles.id_nivel')
            ->leftJoin('grados', 'salones.id_grado', '=', 'grados.id_grado')
            ->leftJoin('secciones', 'salones.id_seccion', '=', 'secciones.id_seccion')
            ->leftJoin('facultades', 'salones.id_facultad', '=', 'facultades.id_facultad')
            ->orderBy('grados.grado', 'asc')
            ->get();
        
        return view('Admin.alumnos.create', compact('grados', 'niveles', 'secciones', 'facultades', 'cursos', 'salones'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'dni' => 'nullable|string|max:20|unique:alumnos,dni',
            'fecha_nacimiento' => 'nullable|date',
            'usuario' => 'required|string|max:255|unique:alumnos,usuario',
            'contrasena' => 'required|string|min:6',
            'id_salon' => 'nullable|exists:salones,id_salon',
        ]);
        
        $validated['contrasena'] = Hash::make($validated['contrasena']);
        $alumno = Alumno::create($validated);
        
        return redirect()->route('admin.alumnos.index')
            ->with('success', 'Alumno registrado correctamente. ID: ' . $alumno->id_alumno);
    }
    
    public function show($id)
    {
        $alumno = Alumno::findOrFail($id);
        
        $salonInfo = null;
        if ($alumno->id_salon) {
            $salonInfo = DB::table('salones')
                ->select('salones.*', 'niveles.nivel', 'grados.grado', 'secciones.seccion')
                ->leftJoin('niveles', 'salones.id_nivel', '=', 'niveles.id_nivel')
                ->leftJoin('grados', 'salones.id_grado', '=', 'grados.id_grado')
                ->leftJoin('secciones', 'salones.id_seccion', '=', 'secciones.id_seccion')
                ->where('salones.id_salon', $alumno->id_salon)
                ->first();
        }
        
        $cursos = collect();
        if ($alumno->id_salon) {
            $cursos = DB::table('docente_curso as dc')
                ->join('docente_salon as ds', 'dc.id_docente_salon', '=', 'ds.id_docente_salon')
                ->join('cursos as c', 'dc.id_curso', '=', 'c.id_curso')
                ->join('users as u', 'ds.id_usuario', '=', 'u.id_usuario')
                ->where('ds.id_salon', $alumno->id_salon)
                ->select('c.id_curso', 'c.materia as nombre', 'u.nombre as docente')
                ->get();
        }
        
        return view('Admin.alumnos.show', compact('alumno', 'cursos', 'salonInfo'));
    }
    
    public function edit($id)
    {
        $alumno = Alumno::findOrFail($id);
        
        $grados = DB::table('grados')
            ->select('id_grado', 'grado')
            ->orderBy('grado', 'asc')
            ->get();
        
        $salones = DB::table('salones')
            ->select('salones.id_salon', 'grados.grado', 'secciones.seccion')
            ->leftJoin('grados', 'salones.id_grado', '=', 'grados.id_grado')
            ->leftJoin('secciones', 'salones.id_seccion', '=', 'secciones.id_seccion')
            ->get();
        
        return view('Admin.alumnos.edit', compact('alumno', 'grados', 'salones'));
    }
    
    public function update(Request $request, $id)
    {
        $alumno = Alumno::findOrFail($id);
        
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'dni' => 'nullable|string|max:20|unique:alumnos,dni,' . $id . ',id_alumno',
            'fecha_nacimiento' => 'nullable|date',
            'usuario' => 'required|string|max:255|unique:alumnos,usuario,' . $id . ',id_alumno',
            'id_salon' => 'nullable|exists:salones,id_salon',
        ]);
        
        if ($request->filled('contrasena')) {
            $validated['contrasena'] = Hash::make($request->contrasena);
        }
        
        $alumno->update($validated);
        
        return redirect()->route('admin.alumnos.index')
            ->with('success', 'Alumno actualizado correctamente.');
    }
    
    public function destroy($id)
    {
        $alumno = Alumno::findOrFail($id);
        $nombre = $alumno->nombre . ' ' . $alumno->apellido;
        $alumno->delete();
        
        return redirect()->route('admin.alumnos.index')
            ->with('success', 'Alumno eliminado correctamente: ' . $nombre);
    }
    
    public function datosFormulario()
    {
        $salones = DB::table('salones')
            ->select('salones.id_salon', 'niveles.nivel', 'grados.grado', 'secciones.seccion')
            ->leftJoin('niveles', 'salones.id_nivel', '=', 'niveles.id_nivel')
            ->leftJoin('grados', 'salones.id_grado', '=', 'grados.id_grado')
            ->leftJoin('secciones', 'salones.id_seccion', '=', 'secciones.id_seccion')
            ->get();
        
        return response()->json([
            'success' => true,
            'salones' => $salones
        ]);
    }
    
    public function getGradosByNivel($id_nivel)
    {
        $grados = DB::table('grados')
            ->where('id_nivel', $id_nivel)
            ->select('id_grado', 'grado')
            ->orderBy('grado', 'asc')
            ->get();
        
        return response()->json($grados);
    }
    
    // ======================================================
    // MÉTODO PRIVADO
    // ======================================================
    
    private function getCursos($alumno)
    {
        if (!$alumno->id_salon) {
            return collect();
        }
        
        return DB::table('docente_curso as dc')
            ->join('docente_salon as ds', 'dc.id_docente_salon', '=', 'ds.id_docente_salon')
            ->join('cursos as c', 'dc.id_curso', '=', 'c.id_curso')
            ->join('users as u', 'ds.id_usuario', '=', 'u.id_usuario')
            ->where('ds.id_salon', $alumno->id_salon)
            ->select('c.id_curso', 'c.materia as nombre', 'u.nombre as docente')
            ->get();
    }
}