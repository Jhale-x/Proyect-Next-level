<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuportController extends Controller
{
    /**
     * Muestra la Página Institucional del Auxiliar
     */
    public function auxiliarIndex()
    {
        // Consultas básicas para las estadísticas de la vista institucional
        $totalUsuarios = DB::table('users')->count();
        $anuncios = DB::table('anuncios')->orderBy('created_at', 'desc')->take(5)->get();

        return view('auxiliar.pagina_institucional', compact('totalUsuarios', 'anuncios'));
    }

    /**
     * Muestra el Módulo ETI
     */
    public function etiIndex()
    {
        return view('auxiliar.eti');
    }

    /**
     * Muestra el Módulo ETA (Soporte de Tickets)
     */
    public function etaIndex()
    {
        // Si ya tienes una tabla de tickets, puedes cargarla aquí
        // $tickets = DB::table('tickets')->orderBy('created_at', 'desc')->get();
        // return view('auxiliar.eta', compact('tickets'));

        return view('auxiliar.eta');
    }
}