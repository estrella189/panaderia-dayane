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
      margin:0; font-family:system-ui,-apple-system,"Segoe UI",Roboto,Ubuntu,sans-serif;
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
      color:#fff;margin:2px;
    }
    .success{background:var(--ok)}
    .danger{background:var(--danger)}
    .disabled{opacity:.5;cursor:not-allowed}
    .badge{
      padding:6px 10px;border-radius:10px;color:#fff;font-weight:700;
    }
    .pendiente{background:var(--warn);color:#000}
    .entregado{background:var(--ok)}
    .cancelado{background:var(--danger)}

    /* Opción C: producto en una línea + tooltip */
    .one-line{
      white-space:nowrap; overflow:hidden; text-overflow:ellipsis;
      max-width:420px; display:block; color:var(--brand); font-weight:600;
    }
    .one-line:hover{ color:var(--accent); cursor:help; }
    @media (max-width:720px){ .one-line{ max-width:180px; font-size:.9rem; } }
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

  <main>
    <h2>Hola, {{ auth()->user()->name }}</h2>
    <p>Gestiona los pedidos y cambia su estado:</p>

    @if(($pedidos ?? collect())->count() > 0)
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
          @foreach($pedidos as $p)
            @php
              // Nombre de producto: ajusta el campo si en tu tabla no se llama 'nombre'/'Nombre'
              $productoNombre = $p->cotizacion && $p->cotizacion->producto
                ? ($p->cotizacion->producto->nombre ?? $p->cotizacion->producto->Nombre ?? '— Producto no asignado —')
                : '— Producto no asignado —';

              $tooltip = $p->cotizacion && $p->cotizacion->detalles
                ? ('Detalles: ' . $p->cotizacion->detalles)
                : 'Sin detalles';

              $cerrado = in_array($p->estado, ['entregado','cancelado']);
            @endphp
            <tr>
              <td>{{ $p->id }}</td>
              <td>{{ $p->cliente->name ?? '—' }}</td>

              {{-- Opción C aplicada aquí --}}
              <td>
                <span class="one-line" title="{{ $tooltip }}">{{ $productoNombre }}</span>
              </td>

              <td><span class="badge {{ $p->estado }}">{{ ucfirst($p->estado) }}</span></td>
              <td>{{ optional($p->created_at)->format('d/m/Y H:i') }}</td>
              <td>
                @if(!$cerrado)
                  <form method="POST" action="{{ route('empleado.pedidos.estado', $p) }}" style="display:inline">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="estado" value="entregado">
                    <button class="btn-sm success">Entregado</button>
                  </form>
                  <form method="POST" action="{{ route('empleado.pedidos.estado', $p) }}" style="display:inline">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="estado" value="cancelado">
                    <button class="btn-sm danger">Cancelar</button>
                  </form>
                @else
                  <button class="btn-sm disabled" disabled>Finalizado</button>
                @endif

              {{-- 🟤 Botón para ver el detalle --}}
          <a href="{{ route('empleado.pedidos.show', $p) }}" class="btn-sm" style="background:var(--brand); text-decoration:none;">
         🔍 Ver detalle
          </a>
              </td>

            </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <p style="text-align:center;margin-top:20px;">No hay pedidos registrados.</p>
    @endif

    @if(is_object($pedidos) && method_exists($pedidos, 'links'))
      <div style="margin-top:15px;">
        {{ $pedidos->onEachSide(1)->links() }}
      </div>
    @endif

    <form action="{{ route('logout') }}" method="POST" style="margin-top:25px">
      @csrf
      <button type="submit" class="btn-sm danger">🚪 Cerrar sesión</button>
    </form>
  </main>
</body>
</html>
