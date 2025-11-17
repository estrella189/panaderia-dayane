<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos — Panel Empleado</title>
    <style>
        :root{
          --bg:#fff9f4; --card:#ffffffcc;
          --text:#3a281c; --muted:#6f533f;
          --brand:#8b5e3c; --accent:#a97e5a;
          --line:#eadfce; --shadow:0 10px 25px rgba(0,0,0,.18);
          --radius:16px; --ok:#2b8a3e; --warn:#e3b04b; --danger:#c04444;
        }
        *{box-sizing:border-box}
        body{
          margin:0; font-family:Arial, Helvetica, sans-serif;
          background:var(--bg); color:var(--text);
        }
        header{
          background:linear-gradient(180deg,#8b5e3c,#7e5436);
          color:#fff; padding:14px 18px;
          display:flex; align-items:center; justify-content:space-between;
          box-shadow:0 8px 22px rgba(0,0,0,.15);
        }
        header h1{margin:0;font-size:1.4rem}

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
          background:var(--brand); color:#fff; border-color:var(--brand);
        }

        main{
          max-width:1000px; margin:30px auto;
          background:#fff; border-radius:10px;
          padding:25px; box-shadow:0 5px 15px rgba(0,0,0,.1);
        }
        table{width:100%; border-collapse:collapse}
        th, td{border-bottom:1px solid #ddd; padding:10px; text-align:left; vertical-align:top}
        th{background:#f7ede3}
        .badge{padding:5px 10px; border-radius:6px; font-size:.9rem; font-weight:bold; color:#fff}
        .pendiente{background:#e3b04b; color:#000}
        .en_proceso{background:#a97e5a;}
        .entregado{background:#2b8a3e}
        .cancelado{background:#c0392b}
        .acciones form{display:inline-block; margin:2px}
        button{border:none; padding:6px 10px; border-radius:6px; cursor:pointer; font-weight:bold}
        .btn-success{background:#2b8a3e;color:#fff}
        .btn-danger{background:#c0392b;color:#fff}
        .btn-secondary{background:#8b5e3c;color:#fff;text-decoration:none;padding:6px 10px;border-radius:6px}
        .alert-success{background:#eaf8ea;border-left:4px solid #2b8a3e;padding:8px;margin-bottom:10px}
        .alert-danger{background:#fdeaea;border-left:4px solid #c0392b;padding:8px;margin-bottom:10px}
        .one-line{white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:380px;display:block;color:#8b5e3c;font-weight:600}
        .one-line:hover{color:#a97e5a;cursor:help}
        @media (max-width:720px){
          main{margin:20px 10px}
          th:nth-child(1),td:nth-child(1){display:none;}
        }
    </style>
</head>
<body>
<header>
    <h1>Pedidos - Empleado</h1>
</header>

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
    @if(session('ok'))    <div class="alert-success">{{ session('ok') }}</div> @endif
    @if(session('error')) <div class="alert-danger">{{ session('error') }}</div> @endif

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>Cotización 🧾</th>
                <th>Estado</th>
                <th>Creado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pedidos as $p)
                @php
                    $clienteNombre  = $p->cliente->name ?? '—';
                    $productoNombre = $p->cotizacion?->producto?->nombre
                                      ?? $p->cotizacion?->producto?->Nombre
                                      ?? '— Producto no asignado —';
                    $tooltip        = $p->cotizacion?->detalles ? ('Detalles: '.$p->cotizacion->detalles) : 'Sin detalles';
                    $cerrado        = in_array($p->estado, ['entregado','cancelado']);
                @endphp
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $clienteNombre }}</td>
                    <td><span class="one-line" title="{{ $tooltip }}">{{ $productoNombre }}</span></td>
                    <td>
                        <span class="badge {{ $p->estado }}">
                            {{ ucfirst(str_replace('_',' ',$p->estado)) }}
                        </span>
                    </td>
                    <td>{{ $p->created_at->format('d/m/Y H:i') }}</td>
                    <td class="acciones">
                        <a href="{{ route('empleado.pedidos.show',$p) }}" class="btn-secondary">Ver</a>

                        @if(!$cerrado)
                            <form method="POST" action="{{ route('empleado.pedidos.estado',$p) }}">
                                @csrf @method('PATCH')
                                <input type="hidden" name="estado" value="entregado">
                                <button class="btn-success">Entregado</button>
                            </form>

                            <form method="POST" action="{{ route('empleado.pedidos.estado',$p) }}">
                                @csrf @method('PATCH')
                                <input type="hidden" name="estado" value="cancelado">
                                <button class="btn-danger">Cancelar</button>
                            </form>
                        @else
                            <em>—</em>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" style="text-align:center; padding:10px;">No hay pedidos.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top:15px;">
        {{ $pedidos->onEachSide(1)->links() }}
    </div>
</main>
</body>
</html>
