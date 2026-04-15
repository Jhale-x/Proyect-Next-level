<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Alumno;
use App\Models\Docente;
use App\Models\Course;

class AlumnosController extends Controller
{
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
        return view('Alumno.eti', compact('alumno'));
    }
    
    public function support()
    {
        $alumno = Auth::guard('alumno')->user();
        return view('Alumno.support', compact('alumno'));
    }
    
    public function courses()
    {
        $alumno = Auth::guard('alumno')->user();
        $cursos = $this->getCursos($alumno);
        
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