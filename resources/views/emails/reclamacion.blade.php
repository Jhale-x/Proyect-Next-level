{{--

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Notificación de Reclamación</title>
    <link rel="stylesheet" href="{{ asset('css/web/web_principal.css') }}">
</head>

<body style="margin: 0; padding: 0; background-color: var(--blanco); font-family: sans-serif; color: #333333;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: var(--blanco); padding: 20px 0;">
        <tr>
            <td align="center">
                <table border="0" cellpadding="0" cellspacing="0" width="600" style="background-color: var(--blanco); border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-top: 4px solid var(--rojo-principal);">
                    <tr>
                        <td style="padding: 30px; background-color: var(--azul-oscuro); text-align: center;">
                            <h1 style="color: var(--blanco); margin: 0; font-size: 24px;">Hoja de Reclamación Virtual</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 30px; line-height: 1.6;">
                            <p style="font-size: 16px; margin-top: 0;">Se ha registrado una nueva reclamación en el portal web.</p>

                            <div style="background-color: var(--blanco); border: 1px solid #e2e8f0; padding: 15px; border-radius: 6px; margin: 20px 0; text-align: center;">
                                <span style="font-size: 14px; color: #576574; display: block; margin-bottom: 5px;">CÓDIGO ÚNICO DE SEGUIMIENTO</span>
                                <strong style="font-size: 20px; color: var(--rojo-principal);">{{ $numero_hoja }}</strong>
                            </div>

                            <h3 style="color: var(--azul-oscuro); border-bottom: 1px solid #edf2f7; padding-bottom: 5px; margin-top: 25px;">Datos del Reclamante</h3>
                            <p style="margin: 5px 0; font-size: 14px;"><strong>Nombre:</strong> {{ $datos['nombre_completo'] }}</p>
                            <p style="margin: 5px 0; font-size: 14px;"><strong>Documento:</strong> {{ $datos['tipo_documento'] }} - {{ $datos['numero_documento'] }}</p>
                            <p style="margin: 5px 0; font-size: 14px;"><strong>Teléfono:</strong> {{ $datos['telefono'] }}</p>
                            <p style="margin: 5px 0; font-size: 14px;"><strong>Correo:</strong> {{ $datos['correo'] }}</p>

                            <h3 style="color: var(--azul-oscuro); border-bottom: 1px solid #edf2f7; padding-bottom: 5px; margin-top: 25px;">Detalle de la Incidencia</h3>
                            <p style="margin: 5px 0; font-size: 14px;"><strong>Tipo:</strong> {{ $datos['tipo_incidencia'] }}</p>
                            <p style="margin: 5px 0; font-size: 14px;"><strong>Bien contratado:</strong> {{ $datos['tipo_bien'] }} ({{ $datos['descripcion_bien'] }})</p>
                            <p style="margin: 5px 0; font-size: 14px;"><strong>Detalle del reclamo:</strong></p>
                            <blockquote style="margin: 10px 0; padding: 10px 15px; background-color: var(--blanco); border-left: 3px solid #cbd5e1; font-style: italic; font-size: 14px;">
                                {{ $datos['detalle_incidencia'] }}
                            </blockquote>
                            <p style="margin: 5px 0; font-size: 14px;"><strong>Pedido concreto:</strong> {{ $datos['pedido_consumidor'] }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 30px; background-color: var(--blanco); text-align: center; font-size: 12px; color: #576574; border-top: 1px solid #edf2f7;">
                            © 2026 Next Level School. Todos los derechos reservados.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

--}}
