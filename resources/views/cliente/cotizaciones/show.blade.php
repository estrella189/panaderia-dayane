<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detalle de mi cotización — Dayane</title>
  <style>
    body{margin:0;font-family:Segoe UI,Roboto,Arial,sans-serif;background:#fdf8f4;color:#3a281c}
    header{background:#8b5e3c;color:#fff;padding:16px;text-align:center;font-weight:700;box-shadow:0 4px 12px rgba(0,0,0,.15)}
    .container{max-width:900px;margin:20px auto;padding:0 16px}
    .card{background:#fff;border:1px solid #e7d5c3;border-radius:12px;box-shadow:0 4px 12px rgba(0,0,0,.08);margin-bottom:14px}
    .card-header{background:#fff7f1;border-bottom:1px solid #efd8c5;padding:12px 16px;border-radius:12px 12px 0 0;font-weight:700}
    .card-body{padding:16px}
    .badge{padding:3px 8px;border-radius:8px;color:#fff;font-size:.85rem}
    .bg-warning{background:#e3b04b}.bg-primary{background:#8b5e3c}
    .btn{display:inline-block;padding:10px 14px;border-radius:8px;border:1px solid #a88a70;text-decoration:none;color:#5c3a21;background:#fff}
    .btn-primary{background:#8b5e3c;color:#fff;border-color:#6c442a}
    .alert{margin:12px 0;padding:10px 14px;border-radius:8px}
    .alert-success{background:#e7f7ea;border:1px solid #b3e3b3;color:#2b6b2b}
    .alert-danger{background:#fde8e8;border:1px solid #f4b2b2;color:#8b1a1a}
  </style>
</head>
<body>
  <header>Mi cotización — Panadería y Pastelería Dayane</header>
  <div class="container">

    @if(session('ok'))    <div class="alert alert-success">{{ session('ok') }}</div> @endif
    @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif

    <div class="card">
      <div class="card-body">
        <p><strong>Folio:</strong> #{{ $cotizacion->id }}</p>
        <p><strong>Fecha:</strong> {{ optional($cotizacion->created_at)->format('d/m/Y H:i') ?? '—' }}</p>
        <p><strong>Producto:</strong> {{ $cotizacion->producto->nombre ?? '—' }}</p>
        <p><strong>Detalles:</strong> {{ $cotizacion->detalles ?: '—' }}</p>
        <p>
          <strong>Estado:</strong>
          <span class="badge bg-{{ $cotizacion->estado === 'pendiente' ? 'warning' : 'primary' }}">
            {{ ucfirst($cotizacion->estado) }}
          </span>
        </p>
        <p>
          <strong>Precio:</strong>
          @if($cotizacion->estado === 'cotizado' && !is_null($cotizacion->precio))
            ${{ number_format($cotizacion->precio,2) }}
          @else
            —
          @endif
        </p>
      </div>
    </div>

    @if($cotizacion->estado === 'cotizado' && !is_null($cotizacion->precio))
      @if(!$cotizacion->pedido)
        <form method="POST" action="{{ route('cliente.cotizaciones.confirmar', $cotizacion) }}">
          @csrf
          <button class="btn btn-primary" type="submit">Hacer pedido</button>
          <a class="btn" href="{{ route('cliente.cotizaciones.index') }}">Volver</a>
        </form>
      @else
        <p>Ya existe el pedido #{{ $cotizacion->pedido->id }} ({{ $cotizacion->pedido->estado }}).</p>
        <a class="btn" href="{{ route('cliente.cotizaciones.index') }}">Volver</a>
      @endif
    @else
      <a class="btn" href="{{ route('cliente.cotizaciones.index') }}">Volver al listado</a>
    @endif
  </div>
  @if(empty($cotizacion->pedido))
  <a href="{{ route('cliente.cotizaciones.edit', $cotizacion->id) }}" class="btn btn-brand2">
    Editar cotización
  </a>
@endif

</body>
</html>
