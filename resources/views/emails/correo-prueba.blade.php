<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Prueba de correo</title></head>
<body style="margin:0; padding:24px 0; background:#f1f4f9; font-family:'Segoe UI', Tahoma, Arial, sans-serif; color:#1a1a1a;">
@php($logo = public_path('images/email/logo-correo.png'))
<table role="presentation" width="600" cellpadding="0" cellspacing="0" align="center" style="max-width:600px; width:100%; background:#ffffff; border-radius:12px; overflow:hidden;">
    <tr>
        <td style="background:#0B2C5C; padding:18px 24px;">
            <table role="presentation" cellpadding="0" cellspacing="0"><tr>
                <td><img src="{{ file_exists($logo) ? $message->embed($logo) : '' }}" alt="Next Level" width="56" style="display:block; width:56px; background:#ffffff; border-radius:50%; padding:3px;"></td>
                <td style="padding-left:12px; color:#ffffff; font-size:18px; font-weight:800;">NEXT LEVEL</td>
            </tr></table>
        </td>
    </tr>
    <tr>
        <td style="padding:28px;">
            <h1 style="margin:0 0 12px; font-size:20px; color:#0B2C5C;">¡El envío de correos funciona! ✅</h1>
            <p style="margin:0 0 12px; font-size:15px; line-height:1.6;">
                Si estás leyendo esto, los alumnos recibirán automáticamente su correo de bienvenida con su
                <strong>usuario</strong> y <strong>contraseña</strong> en cuanto se verifique el pago de su matrícula.
            </p>
            <p style="margin:0; font-size:13px; color:#576574;">
                Remitente: {{ $estado['remitente'] }} · Servidor: {{ $estado['servidor'] ?? $estado['mailer'] }} · {{ now()->format('d/m/Y H:i') }}
            </p>
        </td>
    </tr>
</table>
</body>
</html>
