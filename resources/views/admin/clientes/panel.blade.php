<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel del Cliente (Admin) — Panadería y Pastelería Dayane</title>

  <style>
    :root{
      /* Colores más fuertes */
      --bg1:#fff4e7;
      --bg2:#f0d4c0;
      --card:#ffffff;
      --text:#3a281c;
      --muted:#5b3f2c;
      --brand:#7a4a28;        /* antes 8b5e3c */
      --brand-soft:#9c6a44;   /* antes a97e5a */
      --line:#d3bca7;         /* línea más marcada */
      --shadow:0 18px 42px rgba(80,45,20,.25);
      --ok:#2b8a3e;
      --warn:#c58a18;         /* dorado más intenso */
      --danger:#b02c2c;       /* rojo más fuerte */
    }

    *{box-sizing:border-box;}

    body{
      margin:0;
      padding:24px 16px 32px;
      font-family:system-ui,-apple-system,"Segoe UI",Roboto,Ubuntu,Arial,sans-serif;
      background:
        radial-gradient(1100px 700px at 10% 0%, #ffddc5 0, #fff 35%),
        linear-gradient(180deg, var(--bg1), var(--bg2));
      color:var(--text);
    }

    .wrapper{
      max-width:1100px;
      margin:0 auto;
    }

    .back-row{
      max-width:1100px;
      margin:0 auto 10px;
      display:flex;
      justify-content:flex-start;
    }

    .back-btn{
      display:inline-flex;
      align-items:center;
      gap:8px;
      padding:8px 14px;
      border-radius:999px;
      background:#fff;
      border:1px solid var(--line);
      color:var(--brand);
      text-decoration:none;
      font-size:.9rem;
      font-weight:600;
      box-shadow:0 8px 20px rgba(0,0,0,.16);
      transition:.15s ease;
    }
    .back-btn:hover{
      background:var(--brand-soft);
      color:#fff;
      border-color:var(--brand);
      transform:translateY(-1px);
    }

    .page-title{
      text-align:center;
      margin:0 0 6px;
      font-size:1.45rem;
      letter-spacing:.3px;
      color:var(--brand);
    }
    .page-sub{
      text-align:center;
      margin:0 0 16px;
      font-size:.9rem;
      color:var(--muted);
    }

    .card{
      background:var(--card);
      border-radius:18px;
      border:1px solid var(--line);
      box-shadow:var(--shadow);
      margin-top:16px;
      overflow:hidden;
    }
    .card-header{
      padding:14px 18px;
      background:linear-gradient(180deg,#fff9f4,#ffe2cd);
      border-bottom:1px solid var(--line);
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap:10px;
      flex-wrap:wrap;
    }
    .card-header h2{
      margin:0;
      font-size:1.05rem;
      display:flex;
      align-items:center;
      gap:8px;
      color:var(--brand);
    }
    .card-header small{
      font-size:.8rem;
      color:var(--muted);
    }
    .card-body{
      padding:16px 18px 18px;
    }

    /* Resumen */
    .chips{
      display:grid;
      grid-template-columns:repeat(auto-fit,minmax(160px,1fr));
      gap:10px;
    }
    .chip{
      background:#fff;
      border-radius:14px;
      border:1px solid var(--line);
      padding:10px 12px;
      box-shadow:0 12px 26px rgba(0,0,0,.06);
      display:flex;
      flex-direction:column;
      gap:4px;
      font-size:.88rem;
    }
    .chip strong{
      font-size:1.05rem;
      color:var(--brand);
    }
    .chip span{
      color:var(--muted);
      font-size:.8rem;
    }

    /* Tablas */
    table{
      width:100%;
      border-collapse:collapse;
      font-size:.88rem;
    }
    th,td{
      padding:8px 10px;
      border-bottom:1px solid #f0e2d5;
      text-align:left;
    }
    th{
      background:#7a4a28;
      color:#fff;
      font-size:.82rem;
      text-transform:uppercase;
      letter-spacing:.5px;
    }
    tr:nth-child(even){
      background:#fbf2ea;
    }
    .empty-text{
      margin:4px 0 0;
      font-size:.9rem;
      color:var(--muted);
      text-align:center;
    }

    .badge-estado{
      display:inline-block;
      padding:3px 10px;
      border-radius:999px;
      font-size:.78rem;
      color:#fff;
      text-transform:capitalize;
    }
    .estado-pendiente{background:var(--warn);}
    .estado-cotizado{background:var(--ok);}
    .estado-entregado{background:var(--ok);}
    .estado-cancelado{background:var(--danger);}
    .estado-otro{background:var(--brand-soft);}

    @media (max-width:720px){
      .card-header{
        align-items:flex-start;
      }
      table{
        font-size:.8rem;
      }
      th,td{
        padding:6px;
      }
    }
  </style>
</head>

<body>
  <div class="back-row">
    <a href="{{ route('admin.clientes.seleccionar') }}" class="back-btn">
      ⬅ Volver a seleccionar cliente
    </a>
  </div>

  <div class="wrapper">
    <h1 class="page-title">Panel del Cliente (vista de administrador)</h1>
    <p class="page-sub">
      Aquí puedes revisar los <strong>pedidos</strong> y <strong>cotizaciones</strong> del cliente seleccionado.
    </p>

    {{-- Resumen rápido --}}
    @php
        $totalPedidos      = $pedidos->count();
        $pedidosEntregados = $pedidos->where('estado','entregado')->count();
        $pedidosCancelados = $pedidos->where('estado','cancelado')->count();

        $totalCotizaciones = $ultimas->count();
        $cotiPendientes    = $ultimas->where('estado','pendiente')->count();
        $cotiCotizadas     = $ultimas->where('estado','cotizado')->count();
    @endphp

    <section class="card" aria-label="Resumen del cliente">
      <div class="card-header">
        <h2>Resumen del cliente</h2>
        <small>Vista general de su actividad</small>
      </div>
      <div class="card-body">
        <div class="chips">
          <div class="chip">
            <strong>{{ $totalPedidos }}</strong>
            <span>Total de pedidos</span>
          </div>
          <div class="chip">
            <strong>{{ $pedidosEntregados }}</strong>
            <span>Pedidos entregados</span>
          </div>
          <div class="chip">
            <strong>{{ $pedidosCancelados }}</strong>
            <span>Pedidos cancelados</span>
          </div>
          <div class="chip">
            <strong>{{ $totalCotizaciones }}</strong>
            <span>Total de cotizaciones</span>
          </div>
          <div class="chip">
            <strong>{{ $cotiPendientes }}</strong>
            <span>Cotizaciones pendientes</span>
          </div>
          <div class="chip">
            <strong>{{ $cotiCotizadas }}</strong>
            <span>Cotizaciones cotizadas</span>
          </div>
        </div>
      </div>
    </section>

    {{-- Pedidos --}}
    <section class="card" aria-label="Pedidos del cliente">
      <div class="card-header">
        <h2>Pedidos del cliente</h2>
        <small>Historial de pedidos generados desde cotizaciones</small>
      </div>
      <div class="card-body">
        @if($pedidos->isEmpty())
          <p class="empty-text">Este cliente aún no tiene pedidos registrados.</p>
        @else
          <div style="overflow-x:auto;">
        <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Cliente</th>
          <th>Fecha</th>
          <th>Estado</th>
        </tr>
      </thead>
      <tbody>
        @foreach($pedidos as $p)
          @php
            $estadoClase = 'estado-otro';
            if ($p->estado === 'entregado') $estadoClase = 'estado-entregado';
            elseif ($p->estado === 'cancelado') $estadoClase = 'estado-cancelado';
            elseif ($p->estado === 'pendiente') $estadoClase = 'estado-pendiente';
          @endphp
          <tr>
            <td>{{ $p->id }}</td>
            <td>{{ $p->cliente->name ?? '—' }}</td>
            <td>{{ optional($p->created_at)->format('d/m/Y H:i') }}</td>
            <td>
              <span class="badge-estado {{ $estadoClase }}">
                {{ ucfirst($p->estado ?? '—') }}
              </span>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
          </div>
        @endif
      </div>
    </section>

    {{-- Cotizaciones --}}
    <section class="card" aria-label="Cotizaciones del cliente">
      <div class="card-header">
        <h2>Cotizaciones del cliente</h2>
        <small>Cotizaciones enviadas desde el panel del cliente</small>
      </div>
      <div class="card-body">
        @if($ultimas->isEmpty())
          <p class="empty-text">Este cliente aún no tiene cotizaciones registradas.</p>
        @else
          <div style="overflow-x:auto;">
           <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Producto</th>
            <th>Estado</th>
            <th>Precio</th>
            <th>Fecha</th>
          </tr>
        </thead>
        <tbody>
          @foreach($ultimas as $c)
            @php
              $estadoClase = 'estado-otro';
              if ($c->estado === 'pendiente') $estadoClase = 'estado-pendiente';
              elseif ($c->estado === 'cotizado') $estadoClase = 'estado-cotizado';
            @endphp
            <tr>
              <td>{{ $c->id }}</td>
              <td>{{ $c->cliente->name ?? '—' }}</td>
              <td>{{ $c->producto->nombre ?? '—' }}</td>
              <td>
                <span class="badge-estado {{ $estadoClase }}">
                  {{ ucfirst($c->estado ?? '—') }}
                </span>
              </td>
              <td>
                @if(!is_null($c->precio))
                  ${{ number_format($c->precio,2) }}
                @else
                  —
                @endif
              </td>
              <td>{{ optional($c->created_at)->format('d/m/Y H:i') }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
          </div>
        @endif
      </div>
    </section>

  </div>
</body>
</html>
