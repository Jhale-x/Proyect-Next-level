<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Models\CursoActividad;
use App\Models\Nota;
use App\Models\Alumno;
use App\Models\Course;
use App\Models\Salon;
use App\Models\User;
use App\Models\Nivel;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function index()
    {
        $cursos = Course::paginate(15);
        $salonesPrimaria = Salon::with(['nivel', 'grado', 'seccion', 'facultad'])
            ->where('id_nivel', 1)
            ->get();
        $salonesSecundaria = Salon::with(['nivel', 'grado', 'seccion', 'facultad'])
            ->where('id_nivel', 2)
            ->get();
        $users = User::all();
        $salones = Salon::with(['nivel', 'grado', 'seccion', 'facultad'])->get();
        $niveles = Nivel::all();
        $actividades = Activity::all();

        return view('Admin.courses', compact(
            'cursos',
            'salones',
            'users',
            'niveles',
            'actividades',
            'salonesPrimaria',
            'salonesSecundaria',
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'materia' => 'required|string|max:100|unique:cursos,materia',
        ]);
        
        Course::create([
            'materia' => $request->materia,
        ]);
        
        return redirect()->back()->with('success', 'Curso creado correctamente ✅');
    }

    /**
     * Actualizar un curso existente (para el fetch AJAX)
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'materia' => 'required|string|max:100|unique:cursos,materia,' . $id . ',id_curso',
        ]);
        
        $curso = Course::find($id);
        if (!$curso) {
            return response()->json(['success' => false, 'message' => 'Curso no encontrado'], 404);
        }
        
        $curso->update([
            'materia' => $request->materia,
        ]);
        
        return response()->json(['success' => true, 'message' => 'Curso actualizado correctamente']);
    }

    /**
     * Eliminar un curso (para el fetch AJAX)
     */
    public function destroy($id)
    {
        $curso = Course::find($id);
        if (!$curso) {
            return response()->json(['success' => false, 'message' => 'Curso no encontrado'], 404);
        }
        
        $curso->delete();
        
        return response()->json(['success' => true, 'message' => 'Curso eliminado correctamente']);
    }

    // ... tus otros métodos existentes (docentes, salonesPorDocente, asignarSalones, etc.)
}