<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mis pedidos — Dayane</title>
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
      max-width:1100px;
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
      transition:.2s ease;
      margin-bottom:18px;
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
    }

    .body{ padding:16px; }
    table{ width:100%; border-collapse:collapse; }
    th,td{ padding:10px; border-bottom:1px solid #f0e2d5; text-align:left; }
    th{ background:#fff7f1; }

    .badge{
      padding:3px 8px;
      border-radius:8px;
      color:#fff;
      font-size:.85rem;
    }

    .estado-pendiente{ background:#e3b04b; }
    .estado-proceso{ background:#956644; }
    .estado-entregado{ background:#2b8a3e; }
    .estado-cancelado{ background:#c04444; }

    .btn{
      display:inline-block;
      padding:6px 12px;
      border-radius:8px;
      border:1px solid #a88a70;
      text-decoration:none;
      color:#5c3a21;
      background:#fff;
      transition:.2s ease;
    }

    .btn:hover{
      background:#f6eee6;
    }

  </style>
</head>
<body>

<header>Mis pedidos — Panadería y Pastelería Dayane</header>

<div class="wrapper">

  <a href="{{ route('cliente.inicio') }}" class="btn-regresar">← Regresar al inicio</a>

  <div class="card">
    <div class="body">

      <table>
        <thead>
          <tr>
            <th>Fecha</th>
            <th>Producto</th>
            <th>Estado</th>
            <th>Total</th>
            <th></th>
          </tr>
        </thead>

        <tbody>
        @forelse($pedidos as $p)
          <tr>
            <td>{{ $p->created_at->format('d/m/Y H:i') }}</td>

            <td>{{ $p->cotizacion->producto->nombre ?? '—' }}</td>

            <td>
              @php
                $class = match($p->estado){
                  'pendiente' => 'estado-pendiente',
                  'proceso'   => 'estado-proceso',
                  'entregado' => 'estado-entregado',
                  'cancelado' => 'estado-cancelado',
                  default => 'estado-pendiente'
                };
              @endphp

              <span class="badge {{ $class }}">{{ ucfirst($p->estado) }}</span>
            </td>

            <td>
              @if($p->cotizacion && $p->cotizacion->precio)
                ${{ number_format($p->cotizacion->precio,2) }}
              @else
                — 
              @endif
            </td>

            <td>
              <a href="{{ route('pedidos.show', $p) }}" class="btn">Ver detalles</a>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" style="padding:20px; text-align:center;">
              No tienes pedidos aún.
            </td>
          </tr>
        @endforelse
        </tbody>
      </table>

    </div>
  </div>

</div>

</body>
</html>
