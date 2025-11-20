<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Todos los pedidos — Panadería y Pastelería Dayane</title>
  <style>
    :root{
      --bg:#fff9f4; --card:#ffffffcc;
      --text:#3a281c; --muted:#6f533f;
      --brand:#8b5e3c; --accent:#a97e5a;
      --line:#eadfce; --shadow:0 10px 25px rgba(139,94,60,.18);
      --radius:16px; --ok:#2b8a3e; --warn:#e3b04b; --danger:#c04444;
    }
    *{box-sizing:border-box}
    body{
      margin:0;
      font-family:system-ui,-apple-system,"Segoe UI",Roboto,Ubuntu,sans-serif;
      background:radial-gradient(circle at top left,#fff1e3 0%,#fff9f4 40%,#fff 100%);
      color:var(--text);
    }
    header{
      background:linear-gradient(180deg,#8b5e3c,#7e5436);
      color:#fff; padding:14px 18px;
      display:flex; align-items:center; justify-content:space-between;
      box-shadow:0 8px 22px rgba(0,0,0,.15);
    }
    header h1{margin:0; font-size:1.4rem}
    .back-btn{
      background:#ffffff18; color:#fff;
      border:1px solid #ffffff30; border-radius:10px;
      padding:10px 14px; font-weight:600; text-decoration:none;
      display:inline-flex; align-items:center; gap:6px;
    }

    /* NAV SOLO EMPLEADO */
    .menu-bar{
      background:#fff3e6;
      display:flex; gap:12px;
      padding:10px 20px;
      border-bottom:1px solid var(--line);
      align-items:center;
    }
    .menu-item{
      padding:8px 14px;
      border-radius:10px;
      text-decoration:none;
      font-weight:600;
      color:var(--brand);
      background:#ffffff;
      border:1px solid #e7d4c2;
      font-size:.9rem;
    }
    .menu-item.active{
      background:var(--brand);
      color:#fff;
      border-color:var(--brand);
    }

    main{
      max-width:900px; margin:40px auto; background:var(--card);
      border-radius:var(--radius); padding:30px; box-shadow:var(--shadow);
    }
    table{width:100%;border-collapse:collapse;margin-top:10px}
    th,td{padding:10px;border-bottom:1px solid var(--line);text-align:left;vertical-align:top}
    th{background:#f8f1ea;color:var(--brand)}
    tr:hover td{background:#fff8f3}
    .btn-sm{
      padding:6px 10px;border:none;border-radius:8px;font-weight:600;cursor:pointer;
      color:#fff;margin:2px;text-decoration:none;display:inline-flex;align-items:center;gap:4px;
    }
    .btn-view{background:var(--brand)}
    .badge{
      padding:6px 10px;border-radius:10px;color:#fff;font-weight:700;font-size:.85rem;
    }
    .pendiente{background:var(--warn);color:#000}
    .entregado{background:var(--ok)}
    .cancelado{background:var(--danger)}

    .one-line{
      white-space:nowrap; overflow:hidden; text-overflow:ellipsis;
      max-width:420px; display:block; color:var(--brand); font-weight:600;
    }

    @media (max-width:720px){
      main{margin:20px 10px;padding:20px}
      .one-line{ max-width:180px; font-size:.9rem; }
      th:nth-child(1),td:nth-child(1){display:none;}
    }
  </style>
</head>
<body>

  @php
    $esAdmin = auth()->check() && auth()->user()->role === 'admin';
  @endphp

  <header>
    <h1>📋 Todos los pedidos</h1>

    {{-- ADMIN: botón para regresar --}}
    @if($esAdmin)
      <a href="{{ route('admin.dashboard') }}" class="back-btn">⬅️ Volver al panel admin</a>
    @endif
  </header>

  {{-- NAV SOLO PARA EMPLEADO --}}
  @unless($esAdmin)
    <nav class="menu-bar">
      <a href="{{ route('empleado.panel') }}"
        class="menu-item {{ request()->routeIs('empleado.panel') ? 'active' : '' }}">
        🏠 Panel
      </a>

      <a href="{{ route('empleado.pedidos.index') }}"
        class="menu-item {{ request()->routeIs('empleado.pedidos.index') ? 'active' : '' }}">
        📋 Todos los pedidos
      </a>
    </nav>
  @endunless

  <main>
    <h2 style="margin-top:0;">Listado de pedidos</h2>

    @if($esAdmin)
      <p style="background:#fff7e3;border:1px solid #f1d59a;padding:10px;border-radius:10px;">
        👑 Estás viendo como <strong>Administrador</strong>.  
        Solo se muestran pedidos <strong>entregados</strong> o <strong>cancelados</strong>.
      </p>
    @endif

    @if(($pedidos ?? collect())->count() > 0)
      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>Cliente</th>
            <th>Cotización</th>
            <th>Estado</th>
            <th>Creado</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($pedidos as $p)
            @php
              $productoNombre = $p->cotizacion?->producto?->nombre ?? '— Sin producto —';
            @endphp
            <tr>
              <td>{{ $p->id }}</td>
              <td>{{ $p->cliente->name ?? '—' }}</td>
              <td><span class="one-line">{{ $productoNombre }}</span></td>
              <td><span class="badge {{ $p->estado }}">{{ ucfirst($p->estado) }}</span></td>
              <td>{{ optional($p->created_at)->format('d/m/Y H:i') }}</td>
              <td>
              @unless($esAdmin)
                <a href="{{ route('empleado.pedidos.show', $p) }}" class="btn-sm btn-view">
                  🔍 Ver
                </a>
              @endunless

              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

      <div style="margin-top:15px;">
        {{ $pedidos->onEachSide(1)->links() }}
      </div>

    @else
      <p style="text-align:center;margin-top:20px;">No hay pedidos disponibles.</p>
    @endif
  </main>

</body>
</html>
