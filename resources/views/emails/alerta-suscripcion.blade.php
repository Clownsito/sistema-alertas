<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Alerta de Suscripción</title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; background-color:#f4f4f4; padding:20px;">

@php
    $cantidad = $suscripcion->planLicencia->cantidad_licencias;
    $precioUnitario = $suscripcion->planLicencia->precio;
    $precioTotal = $cantidad * $precioUnitario;
@endphp

<div style="max-width:600px; margin:auto; background:#ffffff; padding:20px; border-radius:6px;">

    <h2 style="color:#d9534f; margin-top:0;">
        ⚠️ Alerta de Suscripción
    </h2>

    <p>
        Se ha generado una alerta automática por una suscripción próxima a vencer.
    </p>

    <hr>

    <h3>📌 Información del Cliente</h3>
    <p><strong>Empresa:</strong> {{ $suscripcion->cliente->empresa }}</p>
    <p><strong>Email:</strong> {{ $suscripcion->cliente->correo }}</p>

    <hr>

    <h3>📦 Detalle del Plan</h3>

    <table width="100%" cellpadding="6" cellspacing="0" style="border-collapse: collapse;">
        <tr style="background:#f0f0f0;">
            <th align="left">Plan</th>
            <th align="center">Licencias</th>
            <th align="right">Precio Unitario</th>
            <th align="right">Total</th>
        </tr>
        <tr>
            <td>{{ $suscripcion->planLicencia->nombre }}</td>
            <td align="center">{{ $cantidad }}</td>
            <td align="right">${{ number_format($precioUnitario, 0, ',', '.') }}</td>
            <td align="right"><strong>${{ number_format($precioTotal, 0, ',', '.') }}</strong></td>
        </tr>
    </table>

    <hr>

    <h3>⏰ Fechas</h3>
    <p><strong>Inicio:</strong> {{ $suscripcion->fecha_inicio }}</p>
    <p><strong>Vencimiento:</strong> {{ $suscripcion->fecha_fin }}</p>

    <hr>

    <p>
        <strong>Tipo de alerta:</strong>
        {{ strtoupper(str_replace('_', ' ', $tipo)) }}
    </p>

    <hr>

    <p style="font-size:12px; color:#666;">
        Este correo fue generado automáticamente por el Sistema de Alertas.<br>
        No responda a este mensaje.
    </p>

</div>

</body>
</html>
