<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Panel de Administrador — Panadería y Pastelería Dayane</title>
  <style>
    :root{
      --bg1:#fff9f4; --bg2:#f2e7db; --glass:#ffffffaa;
      --text:#3a281c; --muted:#6f533f;
      --brand:#8b5e3c; --brand-2:#a97e5a; --accent:#d77a49;
      --line:#eadfce; --shadow:0 20px 40px rgba(139,94,60,.18);
      --radius:18px; --focus:#1f6feb;
      --ok:#2b8a3e; --warn:#e3b04b; --danger:#c04444;
    }
    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      margin:0; font-family:system-ui,-apple-system,"Segoe UI",Roboto,Ubuntu,Arial,sans-serif;
      color:var(--text);
      background: radial-gradient(1200px 800px at 10% 0%, #ffeede 0%, #fff 30%),
                  linear-gradient(180deg, var(--bg1), var(--bg2));
      position:relative; overflow-x:hidden;
    }

    .container{max-width:1100px;margin:18px auto;padding:0 16px}

    .dust, .dust::before, .dust::after{
      position:absolute; inset:0; pointer-events:none;
      background:
        radial-gradient(2px 2px at 20% 30%, #fff7 55%, #0000 60%),
        radial-gradient(2px 2px at 65% 15%, #fff5 55%, #0000 60%),
        radial-gradient(2px 2px at 80% 60%, #fff6 55%, #0000 60%),
        radial-gradient(2px 2px at 35% 75%, #fff5 55%, #0000 60%);
      opacity:.35; filter:blur(.2px);
    }
    .dust::before{content:""; transform:scale(1.3) translateY(8px); opacity:.25}
    .dust::after{content:""; transform:scale(1.6) translateY(-10px); opacity:.18}

    /* ===== Header + Hamburguesa ===== */
    header{
      position:sticky; top:0; z-index:20;
      background:linear-gradient(180deg, #8b5e3c, #7e5436);
      color:#fff; padding:14px 14px;
      border-bottom:1px solid #00000018; box-shadow:0 8px 22px rgba(0,0,0,.15);
    }
    .header-inner{
      max-width:1100px; margin:0 auto;
      display:flex; align-items:center; gap:12px; justify-content:space-between;
    }
    .brand{
      display:flex; gap:12px; align-items:center; flex-wrap:wrap;
    }
    .logo{
      width:44px; height:44px; border-radius:12px; display:grid; place-items:center;
      background:#ffffff18; border:1px solid #ffffff30; font-size:1.2rem;
    }
    .titles{line-height:1.1}
    .titles h1{margin:0; font-size:1.35rem; letter-spacing:.3px; font-weight:800}
    .titles .sub{opacity:.92; margin-top:2px; letter-spacing:.2px; font-size:.95rem}

    #nav-toggle{position:absolute; left:-9999px}
    .burger{
      display:inline-grid; place-items:center;
      width:44px; height:44px; border-radius:12px;
      background:#ffffff18; border:1px solid #ffffff30; cursor:pointer;
      transition:filter .18s ease, transform .12s ease;
    }
    .burger:hover{filter:brightness(1.05)}
    .burger:active{transform:translateY(1px)}
    .burger .bars, .burger .bars::before, .burger .bars::after{
      content:""; display:block; width:22px; height:2px; background:#fff; border-radius:2px;
      position:relative; transition:transform .2s ease, opacity .2s ease;
    }
    .burger .bars::before{position:absolute; top:-7px}
    .burger .bars::after {position:absolute; top:7px}

    .overlay{
      position:fixed; inset:0; background:rgba(0,0,0,.35);
      opacity:0; visibility:hidden; transition:opacity .18s ease, visibility .18s ease; z-index:18;
    }
    .drawer{
      position:fixed; inset:auto 0 0 auto; top:0; height:100%; width:290px;
      right:-310px; z-index:19;
      background:#fff; color:var(--text);
      box-shadow: -18px 0 36px rgba(0,0,0,.15);
      border-left:1px solid var(--line);
      transition:right .22s ease;
      display:flex; flex-direction:column;
    }
    .drawer-head{
      padding:18px 18px; background:linear-gradient(180deg,#fff,#fff7f1);
      border-bottom:1px solid var(--line);
      display:flex; align-items:center; gap:10px;
    }
    .drawer-head .mini{
      width:36px; height:36px; border-radius:10px; display:grid; place-items:center;
      background:#f7ede4; border:1px solid var(--line);
    }
    .drawer-nav{ padding:12px; display:grid; gap:8px; }
    .drawer-nav a, .drawer-nav form button, .drawer-nav label.close-drawer{
      display:flex; align-items:center; gap:10px;
      padding:12px 14px; border-radius:12px; text-decoration:none; border:1px solid var(--line);
      background:#fff; color:var(--text); font-weight:700;
      box-shadow:0 6px 14px rgba(0,0,0,.04);
      transition:transform .12s ease, box-shadow .18s ease, background .18s ease, border-color .18s ease;
      cursor:pointer;
    }
    .drawer-nav a:hover, .drawer-nav form button:hover, .drawer-nav label.close-drawer:hover{
      transform:translateY(-2px); background:#fffdfb; border-color:#e6d8c7;
      box-shadow:0 12px 20px rgba(0,0,0,.06);
    }
    .drawer-nav .emoji{ width:24px; text-align:center }
    .badge{
      display:inline-block; min-width:22px; padding:2px 6px; border-radius:10px;
      background:#d9534f; color:#fff; font-size:.8rem; line-height:1; text-align:center;
    }

    #nav-toggle:checked ~ .overlay{opacity:1; visibility:visible}
    #nav-toggle:checked ~ .drawer{ right:0 }
    #nav-toggle:checked + label .bars{ transform:rotate(45deg) }
    #nav-toggle:checked + label .bars::before{ transform:rotate(90deg); top:0 }
    #nav-toggle:checked + label .bars::after { opacity:0 }

    /* Tarjetas */
    .card{
      background:var(--glass);
      border:1px solid var(--line);
      border-radius:var(--radius);
      box-shadow:var(--shadow);
      margin-top:16px;
    }
    .card-header{
      padding:14px 18px;
      border-bottom:1px solid var(--line);
      background:linear-gradient(180deg,#ffffffcc,#fff7f0);
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap:10px;
      flex-wrap:wrap;
    }
    .card-header h3{margin:0;font-size:1.05rem}
    .card-body{padding:16px 18px}

    .chips{
      display:grid;
      grid-template-columns:repeat(auto-fit,minmax(160px,1fr));
      gap:10px;
    }
    .chip{
      background:#fff;
      border:1px solid var(--line);
      border-radius:14px;
      padding:10px 12px;
      display:flex;
      flex-direction:column;
      gap:2px;
      font-size:.9rem;
      box-shadow:0 10px 22px rgba(0,0,0,.04);
    }
    .chip strong{font-size:1.05rem}
    .chip span{color:var(--muted);font-size:.8rem}

    /* Filtros */
    .filters{
      display:flex;
      flex-wrap:wrap;
      gap:8px;
      align-items:flex-end;
    }
    .filters-group{
      display:flex;
      flex-direction:column;
      gap:4px;
      font-size:.85rem;
    }
    .filters-group label{color:var(--muted)}
    .filters-group input,
    .filters-group select{
      padding:6px 8px;
      border-radius:8px;
      border:1px solid var(--line);
      min-width:160px;
      font-size:.85rem;
    }
    .filter-chips{
      display:flex;
      flex-wrap:wrap;
      gap:6px;
    }
    .btn-chip{
      border-radius:999px;
      border:1px solid #e1d4c3;
      background:#fff;
      padding:6px 10px;
      font-size:.8rem;
      cursor:pointer;
    }
    .btn-chip.active{
      background:var(--brand);
      color:#fff;
      border-color:#6c442a;
    }
    .btn-submit{
      border:none;
      border-radius:10px;
      padding:8px 14px;
      background:var(--brand);
      color:#fff;
      font-weight:600;
      cursor:pointer;
      font-size:.9rem;
      box-shadow:0 8px 18px rgba(139,94,60,.35);
    }

    /* Tabla */
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
      background:#fff7f1;
      color:#4a2f1f;
    }
    tr:nth-child(even){background:#faf7f4}
    .estado-badge{
      display:inline-block;
      padding:3px 8px;
      border-radius:999px;
      font-size:.8rem;
      color:#fff;
    }
    .estado-pendiente{background:var(--warn);}
    .estado-cotizado{background:var(--ok);}
    .estado-otro{background:var(--accent);}
    .link-btn{
      display:inline-flex;
      padding:6px 10px;
      border-radius:8px;
      border:1px solid var(--line);
      background:#fff;
      font-size:.8rem;
      text-decoration:none;
      color:var(--brand);
    }

    a,button{ outline:none }
    a:focus-visible, button:focus-visible{
      box-shadow:0 0 0 3px #fff, 0 0 0 6px var(--focus) !important;
      border-radius:12px;
    }

    @media (max-width:720px){
      .card-header{align-items:flex-start}
      table{font-size:.8rem}
      th,td{padding:6px}
    }
  </style>
</head>
<body>
  <div class="dust"></div>

  <header>
    <div class="header-inner">
      <div class="brand">
        <div class="logo">🍞</div>
        <div class="titles">
          <h1>Panel de Administrador</h1>
          <div class="sub">Panadería y Pastelería Dayane</div>
        </div>
      </div>


      <input type="checkbox" id="nav-toggle" aria-hidden="true">
      <label for="nav-toggle" class="burger" aria-label="Abrir menú" aria-controls="drawer" aria-expanded="false">
        <span class="bars"></span>
      </label>

      {{-- Overlay + Drawer --}}
      <div class="overlay"></div>

      @php
          use App\Models\Cotizacion;

          $pendientesCount = Cotizacion::where('estado','pendiente')->count();
      @endphp

      <nav id="drawer" class="drawer" aria-label="Navegación principal">
        <div class="drawer-head">
          <div class="mini">🍞</div>
          <div>
            <strong>Hola, {{ auth()->user()->name }}</strong><br>
            <small>Administrador</small>
          </div>
        </div>
        <div class="drawer-nav">
          <label for="nav-toggle" class="close-drawer">
            <span class="emoji">⬅️</span> Regresar
          </label>

          <a href="{{ route('admin.productos.index') }}"><span class="emoji">🥐</span> Gestionar productos</a>

          <a href="{{ route('admin.cotizaciones.index') }}">
            <span class="emoji">💬</span> Cotizaciones
            @if($pendientesCount > 0)
              <span class="badge" title="Pendientes">{{ $pendientesCount }}</span>
            @endif
          </a>

          <a href="{{ route('empleado.pedidos.index') }}"><span class="emoji">👩‍🍳</span> Ver Panel Empleado</a>
          <a href="{{ route('admin.clientes.seleccionar') }}"><span class="emoji">🛍️</span> Ver Página Cliente</a>

          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"><span class="emoji">🚪</span> Cerrar sesión</button>
          </form>
        </div>
      </nav>
    </div>
  </header>

  @php
      use Illuminate\Support\Facades\Request;

      $estado   = request('estado');
      $desde    = request('desde');
      $hasta    = request('hasta');

      // Query base
      $q = Cotizacion::with(['cliente','producto','pedido'])
          ->orderByDesc('created_at');

      if ($estado === 'pendiente' || $estado === 'cotizado') {
          $q->where('estado', $estado);
      } elseif ($estado === 'con_pedido') {
          $q->whereNotNull('precio')->whereHas('pedido');
      }

      if ($desde) {
          $q->whereDate('created_at', '>=', $desde);
      }
      if ($hasta) {
          $q->whereDate('created_at', '<=', $hasta);
      }

      $cotizaciones = $q->take(40)->get();

      // Métricas rápidas
      $total        = Cotizacion::count();
      $totalPend    = Cotizacion::where('estado','pendiente')->count();
      $totalCoti    = Cotizacion::where('estado','cotizado')->count();
      $totalPedido  = Cotizacion::whereNotNull('precio')->whereHas('pedido')->count();
      $hoy          = Cotizacion::whereDate('created_at', now()->toDateString())->count();
  @endphp

  <main class="container">

    {{-- Tarjetas de resumen --}}
    <section class="card" aria-label="Resumen de cotizaciones">
      <div class="card-header">
        <h3>Resumen rápido</h3>
        <span style="font-size:.85rem;color:var(--muted)">Vista general de todas las cotizaciones</span>
      </div>
      <div class="card-body">
        <div class="chips">
          <div class="chip">
            <strong>{{ $total }}</strong>
            <span>Total de cotizaciones</span>
          </div>
          <div class="chip">
            <strong>{{ $totalPend }}</strong>
            <span>Pendientes</span>
          </div>
          <div class="chip">
            <strong>{{ $totalCoti }}</strong>
            <span>Cotizadas</span>
          </div>
          <div class="chip">
            <strong>{{ $totalPedido }}</strong>
            <span>Con pedido generado</span>
          </div>
          <div class="chip">
            <strong>{{ $hoy }}</strong>
            <span>Registradas hoy</span>
          </div>
        </div>
      </div>
    </section>

    {{-- Explorador con filtros --}}
    <section class="card" aria-label="Explorar cotizaciones">
      <div class="card-header">
        <h3>Explorar cotizaciones</h3>
        <span style="font-size:.85rem;color:var(--muted)">
          Filtra por estado y fechas para revisar más rápido.
        </span>
      </div>
      <div class="card-body">

        {{-- Filtros --}}
        <form method="GET" action="{{ route('admin.dashboard') }}" class="filters">
          <div class="filters-group" style="flex:1 1 220px;">
            <label>Estado</label>
            <div class="filter-chips">
              @php
                $estadoActual = $estado ?? '';
              @endphp
              <button type="submit" name="estado" value=""
                      class="btn-chip {{ $estadoActual === '' ? 'active' : '' }}">
                Todas
              </button>
              <button type="submit" name="estado" value="pendiente"
                      class="btn-chip {{ $estadoActual === 'pendiente' ? 'active' : '' }}">
                Pendientes
              </button>
              <button type="submit" name="estado" value="cotizado"
                      class="btn-chip {{ $estadoActual === 'cotizado' ? 'active' : '' }}">
                Cotizadas
              </button>
              <button type="submit" name="estado" value="con_pedido"
                      class="btn-chip {{ $estadoActual === 'con_pedido' ? 'active' : '' }}">
                Con pedido
              </button>
            </div>
          </div>

          <div class="filters-group">
            <label for="desde">Desde</label>
            <input type="date" id="desde" name="desde" value="{{ $desde }}">
          </div>

          <div class="filters-group">
            <label for="hasta">Hasta</label>
            <input type="date" id="hasta" name="hasta" value="{{ $hasta }}">
          </div>

          <div class="filters-group">
            <label>&nbsp;</label>
            <button type="submit" class="btn-submit">
              Aplicar filtros
            </button>
          </div>
        </form>

        {{-- Tabla --}}
        <div style="margin-top:14px;overflow-x:auto;">
          @if($cotizaciones->isEmpty())
            <p style="color:var(--muted);font-size:.9rem;">No se encontraron cotizaciones con esos filtros.</p>
          @else
            <table>
              <thead>
                <tr>
                  <th>Fecha</th>
                  <th>Cliente</th>
                  <th>Producto</th>
                  <th>Estado</th>
                  <th>Precio</th>
                  <th>Pedido</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach($cotizaciones as $c)
                  @php
                    $estadoClass = 'estado-otro';
                    if($c->estado === 'pendiente') $estadoClass = 'estado-pendiente';
                    if($c->estado === 'cotizado')  $estadoClass = 'estado-cotizado';
                  @endphp
                  <tr>
                    <td>{{ optional($c->created_at)->format('d/m/Y H:i') }}</td>
                    <td>{{ $c->cliente->name ?? '—' }}</td>
                    <td>{{ $c->producto->nombre ?? '—' }}</td>
                    <td>
                      <span class="estado-badge {{ $estadoClass }}">
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
                    <td>
                      @if($c->pedido)
                        #{{ $c->pedido->id }} ({{ ucfirst($c->pedido->estado) }})
                      @else
                        —
                      @endif
                    </td>
                    <td>
                      <a href="{{ route('admin.cotizaciones.show', $c) }}" class="link-btn">
                        Ver / responder
                      </a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          @endif
        </div>
      </div>
    </section>

  </main>
</body>
</html>
