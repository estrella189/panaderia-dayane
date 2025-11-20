<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel de Empleado — Panadería y Pastelería Dayane</title>
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

    /* NAV SUPERIOR */
    .menu-bar{
      background:#fff3e6;
      display:flex; gap:12px;
      padding:10px 20px;
      border-bottom:1px solid var(--line);
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
    .menu-item:hover{
      background:#ffe4cc;
      border-color:var(--brand);
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
    .one-line:hover{ color:var(--accent); cursor:help; }
    @media (max-width:720px){
      main{margin:20px 10px;padding:20px}
      .one-line{ max-width:180px; font-size:.9rem; }
      th:nth-child(1),td:nth-child(1){display:none;} /* oculta # en móvil */
    }
  </style>
</head>
<body>
  <header>
    <h1>👩‍🍳 Panel de Empleado</h1>
    @auth
      @if(auth()->user()->role === 'admin')
        <a href="{{ url()->previous() }}" class="back-btn">⬅️ Regresar</a>
      @endif
    @endauth
  </header>

  {{-- NAV SUPERIOR --}}
  <nav class="menu-bar">
    <a href="{{ route('empleado.panel') }}"
       class="menu-item {{ request()->routeIs('empleado.panel') ? 'active' : '' }}">
       📋 Panel
    </a>

    <a href="{{ route('empleado.pedidos.index') }}"
       class="menu-item {{ request()->routeIs('empleado.pedidos.index') ? 'active' : '' }}">
       📝 Todos los pedidos
    </a>
  </nav>

  <main>
    <h2>Hola, {{ auth()->user()->name }}</h2>
    <p>Gestiona los pedidos de los clientes y revisa su estado.</p>

    @php
      $filtro = request('estado', 'todos');
    @endphp

    {{-- FILTROS CHIPS (opcional, los dejo porque ya te gustaron) --}}
    <div class="filters" style="display:flex;flex-wrap:wrap;gap:8px;margin:10px 0 6px;">
      <a href="{{ route('empleado.panel') }}"
         class="menu-item {{ $filtro === 'todos' ? 'active' : '' }}"
         style="padding:6px 12px;font-size:.8rem;">
        Todos
      </a>
      <a href="{{ route('empleado.panel',['estado'=>'pendiente']) }}"
         class="menu-item {{ $filtro === 'pendiente' ? 'active' : '' }}"
         style="padding:6px 12px;font-size:.8rem;">
        Sin responder
      </a>
      <a href="{{ route('empleado.panel',['estado'=>'entregado']) }}"
         class="menu-item {{ $filtro === 'entregado' ? 'active' : '' }}"
         style="padding:6px 12px;font-size:.8rem;">
        Entregados
      </a>
      <a href="{{ route('empleado.panel',['estado'=>'cancelado']) }}"
         class="menu-item {{ $filtro === 'cancelado' ? 'active' : '' }}"
         style="padding:6px 12px;font-size:.8rem;">
        Cancelados
      </a>
    </div>

    @if(($pedidos ?? collect())->count() > 0)
      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>Cliente</th>
            <th>Cotización 🧾</th>
            <th>Estado</th>
            <th>Creado</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($pedidos as $p)
            @php
              $productoNombre = $p->cotizacion?->producto?->nombre
                ?? $p->cotizacion?->producto?->Nombre
                ?? '— Producto no asignado —';
              $tooltip = $p->cotizacion?->detalles
                ? ('Detalles: '.$p->cotizacion->detalles)
                : 'Sin detalles';
            @endphp
            <tr>
              <td>{{ $p->id }}</td>
              <td>{{ $p->cliente->name ?? '—' }}</td>
              <td><span class="one-line" title="{{ $tooltip }}">{{ $productoNombre }}</span></td>
              <td><span class="badge {{ $p->estado }}">{{ ucfirst(str_replace('_',' ',$p->estado)) }}</span></td>
              <td>{{ optional($p->created_at)->format('d/m/Y H:i') }}</td>
              <td>
                <a href="{{ route('empleado.pedidos.show', $p) }}" class="btn-sm btn-view">
                  🔍 Ver detalle
                </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <p style="text-align:center;margin-top:20px;">No hay pedidos registrados para este filtro.</p>
    @endif

    @if(is_object($pedidos) && method_exists($pedidos, 'links'))
      <div style="margin-top:15px;">
        {{ $pedidos->onEachSide(1)->links() }}
      </div>
    @endif

    <form action="{{ route('logout') }}" method="POST" style="margin-top:25px">
      @csrf
      <button type="submit" class="btn-sm" style="background:var(--danger)">🚪 Cerrar sesión</button>
    </form>
  </main>
</body>
</html>
