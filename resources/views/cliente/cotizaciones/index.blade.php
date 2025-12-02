<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mis cotizaciones — Dayane</title>
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

    .container{
      max-width:1100px;
      margin:20px auto;
      padding:0 16px;
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

    .bg-warning{ background:#e3b04b; }
    .bg-primary{ background:#8b5e3c; }

    .btn{
      display:inline-block;
      padding:8px 12px;
      border-radius:8px;
      border:1px solid #a88a70;
      text-decoration:none;
      color:#5c3a21;
      background:#fff;
      transition:.2s;
    }

    .alert{ margin:12px 0; padding:10px 14px; border-radius:8px; }

    .alert-success{
      background:#e7f7ea;
      border:1px solid #b3e3b3;
      color:#2b6b2b;
    }

    .alert-danger{
      background:#fde8e8;
      border:1px solid #f4b2b2;
      color:#8b1a1a;
    }

    .pagination{
      display:flex;
      gap:8px;
      flex-wrap:wrap;
      margin-top:10px;
    }

    .pagination a,.pagination span{
      padding:6px 10px;
      border:1px solid #e0c9b6;
      border-radius:8px;
      text-decoration:none;
      color:#5c3a21;
      background:#fff;
    }

    /* ===== BOTÓN DE REGRESAR AL INICIO BONITO ===== */

    .regresar-wrapper{
      max-width:1100px;
      margin:20px auto 0;
      padding:0 16px;
      display:flex;
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
    }

    .btn-regresar:hover{
      background:#6d4428;
      transform:translateY(-2px);
    }

  </style>
</head>
<body>

  <header>Mis cotizaciones — Panadería y Pastelería Dayane</header>

  {{-- Botón centrado y elegante --}}
  <div class="regresar-wrapper">
      <a href="{{ route('cliente.inicio') }}" class="btn-regresar">
        ← Regresar al inicio
      </a>
  </div>

  <div class="container">

    @if(session('ok'))
      <div class="alert alert-success">{{ session('ok') }}</div>
    @endif

    @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
      <div class="body" style="overflow:auto">

        <table>
          <thead>
            <tr>
              <th>Fecha</th>
              <th>Producto</th>
              <th>Estado</th>
              <th>Precio</th>
              <th>Pedido</th>
              <th></th>
            </tr>
          </thead>

          <tbody>
            @forelse($cotizaciones as $c)
              <tr>
                <td>{{ optional($c->created_at)->format('d/m/Y H:i') ?? '—' }}</td>
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
                  @if($c->pedido)
                    #{{ $c->pedido->id }} ({{ $c->pedido->estado }})
                  @else
                    —
                  @endif
                </td>

                <td>
                  <a class="btn" href="{{ route('cliente.cotizaciones.show', $c) }}">Ver</a>
                </td>
              </tr>
            @empty
              <tr><td colspan="6" style="text-align:center;padding:20px 0">Aún no tienes cotizaciones.</td></tr>
            @endforelse
          </tbody>
        </table>

      </div>
    </div>

  </div>

</body>
</html>
