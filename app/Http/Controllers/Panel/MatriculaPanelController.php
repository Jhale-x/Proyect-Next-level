<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Admin\MatriculaAdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

/**
 * Panel de matrículas fuera de la intranet.
 * Reutiliza toda la lógica del módulo de administración; solo cambia
 * las vistas, las rutas y quién queda registrado al verificar un pago.
 */
class MatriculaPanelController extends MatriculaAdminController
{
    protected string $vistas = 'panel.matriculas';
    protected string $rutas = 'panel.';

    protected function verificadoPor(): ?string
    {
        $personal = Auth::guard('matricula')->user();

        return $personal ? "Panel: {$personal->nombre}" : null;
    }

    /** El personal del panel no puede anular una matrícula ya pagada (eso queda para la dirección). */
    public function updateEstado(Request $request, $id)
    {
        $matricula = \App\Models\Matricula::findOrFail($id);

        if ($matricula->estado === \App\Models\Matricula::ESTADO_PAGADA && $request->estado !== \App\Models\Matricula::ESTADO_PAGADA) {
            return back()->with('error', 'Esta matrícula ya está pagada; solo la dirección puede anularla.');
        }

        return parent::updateEstado($request, $id);
    }

    public function cuenta()
    {
        return view('panel.cuenta', ['personal' => Auth::guard('matricula')->user()]);
    }

    public function actualizarClave(Request $request)
    {
        $personal = Auth::guard('matricula')->user();

        $request->validate([
            'clave_actual' => ['required', 'current_password:matricula'],
            'clave_nueva' => ['required', 'confirmed', 'different:clave_actual', Password::min(8)->letters()->numbers()],
        ], [
            'clave_actual.current_password' => 'La contraseña actual no es correcta.',
            'clave_nueva.confirmed' => 'Las contraseñas nuevas no coinciden.',
            'clave_nueva.different' => 'La nueva contraseña debe ser distinta de la actual.',
            'clave_nueva.min' => 'La nueva contraseña debe tener al menos 8 caracteres.',
            'clave_nueva.letters' => 'La nueva contraseña debe tener al menos una letra.',
            'clave_nueva.numbers' => 'La nueva contraseña debe tener al menos un número.',
        ]);

        $personal->update(['password' => Hash::make($request->clave_nueva)]);

        return back()->with('success', 'Tu contraseña se actualizó correctamente.');
    }
}
