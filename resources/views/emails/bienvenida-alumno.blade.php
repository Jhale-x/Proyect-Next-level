<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a Next Level</title>
</head>
{{-- Estilos en línea: la mayoría de clientes de correo ignoran <style>. --}}
<body style="margin:0; padding:0; background:#f1f4f9; font-family:'Segoe UI', Tahoma, Arial, sans-serif; color:#1a1a1a;">
@php
    $logo = public_path('images/email/logo-correo.png');
    $ciclo = $matricula->ciclo;
@endphp
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f1f4f9; padding:24px 0;">
<tr><td align="center">
    <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="max-width:600px; width:100%; background:#ffffff; border-radius:12px; overflow:hidden;">

        {{-- CABECERA: logo arriba a la izquierda --}}
        <tr>
            <td style="background:#0B2C5C; padding:18px 24px;">
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="76" valign="middle" align="left">
                            <img src="{{ file_exists($logo) ? $message->embed($logo) : rtrim(config('app.url'), '/') . '/images/next-level-logo.png' }}"
                                 alt="Next Level" width="70" style="display:block; width:70px; height:auto; border:0; background:#ffffff; border-radius:50%; padding:4px;">
                        </td>
                        <td valign="middle" align="left" style="padding-left:14px; color:#ffffff;">
                            <div style="font-size:20px; font-weight:800; letter-spacing:1px;">NEXT LEVEL</div>
                            <div style="font-size:12px; opacity:.85;">Colegio y Academia · Pucallpa</div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr><td style="background:#E63946; height:4px; line-height:4px; font-size:0;">&nbsp;</td></tr>

        {{-- CUERPO --}}
        <tr>
            <td style="padding:28px 28px 8px;">
                <h1 style="margin:0 0 12px; font-size:22px; color:#0B2C5C;">¡Bienvenido(a) a Next Level! 🎓</h1>
                <p style="margin:0 0 12px; font-size:15px; line-height:1.6;">
                    Hola <strong>{{ $alumno->nombre_completo }}</strong>,
                </p>
                <p style="margin:0 0 12px; font-size:15px; line-height:1.6;">
                    Hemos <strong style="color:#1a7f37;">verificado el pago</strong> de tu matrícula. ¡Ya eres parte de la familia Next Level!
                    A continuación encontrarás tus credenciales de acceso. Guárdalas: las usarás para ingresar a la plataforma de estudiantes cuando inicien las clases.
                </p>
            </td>
        </tr>

        {{-- CREDENCIALES --}}
        <tr>
            <td style="padding:8px 28px;">
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#fff8e6; border:2px dashed #E63946; border-radius:10px;">
                    <tr><td colspan="2" style="padding:16px 18px 6px; font-size:15px; font-weight:800; color:#0B2C5C;">🔐 TUS CREDENCIALES DE ACCESO</td></tr>
                    <tr>
                        <td style="padding:6px 18px; font-size:14px; color:#576574; width:110px;">Usuario:</td>
                        <td style="padding:6px 18px 6px 0; font-size:16px; font-weight:700; font-family:'Courier New', monospace;">{{ $alumno->usuario }}</td>
                    </tr>
                    <tr>
                        <td style="padding:6px 18px 16px; font-size:14px; color:#576574;">Contraseña:</td>
                        <td style="padding:6px 18px 16px 0; font-size:16px; font-weight:700; font-family:'Courier New', monospace;">{{ $password }}</td>
                    </tr>
                </table>
                <p style="margin:10px 0 0; font-size:13px; color:#576574;">
                    Tu usuario es tu <strong>DNI</strong> y tu contraseña es tu <strong>fecha de nacimiento</strong> (día, mes y año, sin barras).
                    No compartas tus credenciales con nadie.
                </p>
            </td>
        </tr>

        {{-- PRÓXIMOS PASOS --}}
        <tr>
            <td style="padding:22px 28px 18px;">
                <p style="margin:0; font-size:14px; line-height:1.6; color:#334155;">
                    📅 Te avisaremos por este medio y por WhatsApp la fecha de inicio de clases y cómo ingresar a la plataforma.
                </p>
            </td>
        </tr>

        {{-- DETALLE DE MATRÍCULA --}}
        <tr>
            <td style="padding:0 28px 20px;">
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f8fafc; border-left:4px solid #0B2C5C; border-radius:8px;">
                    <tr><td colspan="2" style="padding:14px 16px 6px; font-size:14px; font-weight:800; color:#0B2C5C;">📋 DETALLE DE TU MATRÍCULA</td></tr>
                    @foreach([
                        'Código' => $matricula->codigo,
                        'Modalidad' => ucfirst($matricula->modalidad),
                        'Elección' => $matricula->eleccion,
                        'Ciclo / Grado' => $matricula->ciclo_grado,
                        'Turno' => $matricula->turno,
                        'Inicio de clases' => $ciclo?->fecha_inicio?->format('d/m/Y'),
                        'Monto pagado' => 'S/ ' . number_format($matricula->monto_total, 2),
                    ] as $etiqueta => $valor)
                        @if($valor)
                        <tr>
                            <td style="padding:4px 16px; font-size:13px; color:#576574; width:140px;">{{ $etiqueta }}:</td>
                            <td style="padding:4px 16px 4px 0; font-size:13px; font-weight:600;">{{ $valor }}</td>
                        </tr>
                        @endif
                    @endforeach
                    <tr><td colspan="2" style="height:10px; line-height:10px; font-size:0;">&nbsp;</td></tr>
                </table>
            </td>
        </tr>

        <tr>
            <td style="padding:0 28px 24px; font-size:13px; color:#576574; line-height:1.6;">
                ¿Tienes dudas? Escríbenos por WhatsApp al <strong>{{ config('matricula.telefono') }}</strong> o visítanos en Pucallpa, Perú.
            </td>
        </tr>

        {{-- PIE --}}
        <tr>
            <td style="background:#f8fafc; border-top:1px solid #e2e8f0; padding:16px; text-align:center; font-size:11px; color:#94a3b8;">
                © {{ date('Y') }} Next Level. Todos los derechos reservados.<br>
                Este correo fue enviado automáticamente, por favor no lo respondas.
            </td>
        </tr>
    </table>
</td></tr>
</table>
</body>
</html>
