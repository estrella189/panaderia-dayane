<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cotizaciones — Dayane</title>
  <style>
    body{margin:0;font-family:Segoe UI,Roboto,Arial,sans-serif;background:#fdf8f4;color:#3a281c}
    header{background:#8b5e3c;color:#fff;padding:16px;text-align:center;font-weight:700;box-shadow:0 4px 12px rgba(0,0,0,.15)}
    .container{max-width:1100px;margin:20px auto;padding:0 16px}
    .card{background:#fff;border:1px solid #e7d5c3;border-radius:12px;box-shadow:0 4px 12px rgba(0,0,0,.08)}
    .card .body{padding:16px}
    table{width:100%;border-collapse:collapse}
    th,td{padding:10px;border-bottom:1px solid #f0e2d5}
    th{background:#fff7f1;text-align:left}
    .badge{padding:3px 8px;border-radius:8px;color:#fff;font-size:.85rem}
    .bg-warning{background:#e3b04b}.bg-primary{background:#8b5e3c}
    .btn{display:inline-block;padding:8px 12px;border-radius:8px;border:1px solid #a88a70;text-decoration:none;color:#5c3a21;background:#fff}
    .btn:hover{background:#fff8f3}
    .pagination{display:flex;gap:8px;flex-wrap:wrap;margin-top:10px}
    .pagination a,.pagination span{padding:6px 10px;border:1px solid #e0c9b6;border-radius:8px;text-decoration:none;color:#5c3a21;background:#fff}
    .alert{margin-bottom:12px;padding:10px 14px;border-radius:8px}
    .alert-success{background:#e7f7ea;border:1px solid #b3e3b3;color:#2b6b2b}
    .alert-danger{background:#fde8e8;border:1px solid #f4b2b2;color:#8b1a1a}
  </style>
</head>
<body>
  <header>Cotizaciones — Panadería y Pastelería Dayane</header>
  <div class="container">

 
    <a href="{{ route('admin.dashboard') }}" class="btn" style="margin-bottom:14px;display:inline-block;">
      ← Regresar al inicio
    </a>

    <h2 style="margin:12px 0 14px 0;">Cotizaciones</h2>

    @if(session('ok'))    <div class="alert alert-success">{{ session('ok') }}</div> @endif
    @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif

    <div class="card">
      <div class="body">
        <div style="overflow:auto">
          <table>
            <thead>
              <tr>
                <th style="min-width:140px">Fecha</th>
                <th>Cliente</th>
                <th>Producto</th>
                <th>Estado</th>
                <th>Precio</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @forelse($cotizaciones as $c)
              <tr>
                <td>{{ optional($c->created_at)->format('d/m/Y H:i') ?? '—' }}</td>
                <td>{{ $c->cliente->name ?? '—' }}</td>
                <td>{{ $c->producto->nombre ?? '—' }}</td>
                <td>
                  <span class="badge bg-{{ $c->estado === 'pendiente' ? 'warning' : 'primary' }}">
                    {{ ucfirst($c->estado) }}
                  </span>
                </td>
                <td>
                  @if($c->estado === 'cotizado' && !is_null($c->precio))
                    ${{ number_format($c->precio,2) }}
                  @else
                    —
                  @endif
                </td>
                <td>
                  <a class="btn" href="{{ route('admin.cotizaciones.show',$c) }}">Ver</a>
                </td>
              </tr>
              @empty
              <tr><td colspan="6" style="text-align:center;padding:18px 0">Sin cotizaciones.</td></tr>
              @endforelse
            </tbody>
          </table>

        </div>
      </div>
    </div>

  </div>
</body>
</html>
