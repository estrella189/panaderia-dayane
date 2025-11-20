<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detalle del pedido — Dayane</title>

  <style>
    body{
      margin:0;
      font-family:Segoe UI,Roboto,Arial,sans-serif;
      background:#fdf8f4;
      color:#3a281c;
    }

    header{
      background:#8b5e3c;
      color:#fff;
      padding:16px;
      text-align:center;
      font-weight:700;
      box-shadow:0 4px 12px rgba(0,0,0,.15);
    }

    .wrapper{
      max-width:900px;
      margin:20px auto;
      padding:0 16px;
    }

    .btn-regresar{
      display:inline-block;
      background:#8b5e3c;
      color:#fff;
      padding:10px 20px;
      border-radius:999px;
      text-decoration:none;
      font-weight:600;
      box-shadow:0 4px 12px rgba(0,0,0,.12);
      margin-bottom:18px;
      transition:.2s;
    }

    .btn-regresar:hover{
      background:#6d4428;
      transform:translateY(-2px);
    }

    .card{
      background:#fff;
      border:1px solid #e7d5c3;
      border-radius:12px;
      box-shadow:0 4px 12px rgba(0,0,0,.08);
      padding:20px;
    }

    .badge{
      padding:4px 10px;
      border-radius:8px;
      color:#fff;
      font-size:.85rem;
    }

    .estado-pendiente{background:#e3b04b;}
    .estado-proceso{background:#956644;}
    .estado-entregado{background:#2b8a3e;}
    .estado-cancelado{background:#c04444;}

  </style>
</head>
<body>

<header>Detalle del pedido — Panadería y Pastelería Dayane</header>

<div class="wrapper">

  <a href="{{ route('pedidos.index') }}" class="btn-regresar">← Regresar a mis pedidos</a>

  <div class="card">

    <p><strong>ID del pedido:</strong> #{{ $pedido->id }}</p>
    <p><strong>Fecha:</strong> {{ $pedido->created_at->format('d/m/Y H:i') }}</p>

    <p><strong>Producto:</strong>
      {{ $pedido->cotizacion->producto->nombre ?? '—' }}
    </p>

    <p><strong>Estado:</strong>
      @php
        $class = match($pedido->estado){
          'pendiente' => 'estado-pendiente',
          'proceso'   => 'estado-proceso',
          'entregado' => 'estado-entregado',
          'cancelado' => 'estado-cancelado',
          default => 'estado-pendiente'
        };
      @endphp

      <span class="badge {{ $class }}">{{ ucfirst($pedido->estado) }}</span>
    </p>

    <p><strong>Total:</strong>
      @if($pedido->cotizacion && $pedido->cotizacion->precio)
        ${{ number_format($pedido->cotizacion->precio, 2) }}
      @else
        —
      @endif
    </p>

    <p><strong>Notas:</strong> {{ $pedido->notas ?? '—' }}</p>

  </div>

</div>

</body>
</html>
