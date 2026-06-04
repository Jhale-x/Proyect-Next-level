<?php

/*

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reclamacion;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ReclamacionController extends Controller
{
    public function index()
    {
        return view('libro_reclamaciones');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_completo'    => 'required|string|max=255',
            'tipo_documento'     => 'required|string',
            'numero_documento'   => 'required|string',
            'telefono'           => 'required|string',
            'correo'             => 'required|email|max=255',
            'domicilio'          => 'required|string',
            'tipo_bien'          => 'required|string',
            'descripcion_bien'   => 'required|string',
            'tipo_incidencia'    => 'required|string',
            'detalle_incidencia' => 'required|string',
            'pedido_consumidor'  => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            $anioActual = date('Y');
            $cantidadAnio = Reclamacion::whereYear('fecha_registro', $anioActual)->count();
            $correlativo = str_pad($cantidadAnio + 1, 4, '0', STR_PAD_LEFT);
            $numeroHoja = "RECL-{$anioActual}-{$correlativo}";

            $reclamacion = Reclamacion::create([
                'numero_hoja'          => $numeroHoja,
                'nombre_completo'      => $request->nombre_completo,
                'tipo_documento'       => $request->tipo_documento,
                'numero_documento'     => $request->numero_documento,
                'telefono'             => $request->telefono,
                'correo'               => $request->correo,
                'domicilio'            => $request->domicilio,
                'es_menor_edad'        => $request->has('es_menor_edad') ? 1 : 0,
                'nombre_apoderado'     => $request->nombre_apoderado,
                'documento_apoderado'  => $request->documento_apoderado,
                'tipo_bien'            => $request->tipo_bien,
                'monto_reclamado'      => $request->monto_reclamado,
                'descripcion_bien'     => $request->descripcion_bien,
                'tipo_incidencia'      => $request->tipo_incidencia,
                'detalle_incidencia'   => $request->detalle_incidencia,
                'pedido_consumidor'    => $request->pedido_consumidor,
                'estado'               => 'Pendiente',
            ]);

            $dataMail = [
                'numero_hoja' => $numeroHoja,
                'datos'       => $request->all()
            ];

            Mail::send('emails.reclamacion', $dataMail, function($message) use ($request, $numeroHoja) {
                $message->to($request->correo)
                        ->subject("Copia de Hoja de Reclamación - {$numeroHoja}");
            });

            Mail::send('emails.reclamacion', $dataMail, function($message) use ($numeroHoja) {
                $message->to('contacto@nextlevel.edu.pe')
                        ->subject("ALERTA: Nueva Reclamación Registrada - {$numeroHoja}");
            });

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Su reclamación ha sido registrada con éxito y se han enviado las copias digitales a los correos correspondientes.',
                'codigo'  => $numeroHoja
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error al procesar su solicitud. Intente nuevamente.'
            ], 500);
        }
    }
}

*/
