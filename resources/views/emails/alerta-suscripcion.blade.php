<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Alerta de Suscripción</title>
</head>
<body>
    <h2>⚠️ Alerta de Suscripción</h2>

    <p><strong>Empresa:</strong> {{ $suscripcion->cliente->empresa }}</p>
    <p><strong>Email del cliente:</strong> {{ $suscripcion->cliente->correo }}</p>

    <hr>

    <p><strong>Plan:</strong> {{ $suscripcion->planLicencia->nombre }}</p>
    <p><strong>Cantidad de licencias:</strong> {{ $suscripcion->planLicencia->cantidad_licencias }}</p>
    <p><strong>Precio:</strong> ${{ number_format($suscripcion->planLicencia->precio, 0, ',', '.') }}</p>

    <hr>

    <p><strong>Fecha inicio:</strong> {{ $suscripcion->fecha_inicio }}</p>
    <p><strong>Fecha vencimiento:</strong> {{ $suscripcion->fecha_fin }}</p>

    <hr>

    <p><strong>Tipo de alerta:</strong> {{ strtoupper(str_replace('_', ' ', $tipo)) }}</p>

    <p>Este correo es una alerta automática del sistema de facturación.</p>
</body>
</html>
