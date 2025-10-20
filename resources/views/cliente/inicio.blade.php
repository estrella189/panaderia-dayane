<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Panel de Cliente — Panadería y Pastelería Dayane</title>
  <style>
    :root{
      --bg1:#fff9f4; --bg2:#f2e7db;
      --glass:#ffffffcc; --card:#ffffff;
      --text:#3a281c; --muted:#6f533f;
      --brand:#8b5e3c; --brand-2:#a97e5a; --accent:#d77a49;
      --line:#eadfce; --shadow:0 18px 40px rgba(139,94,60,.16);
      --radius:18px; --focus:#1f6feb;
    }
    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      margin:0; font-family:system-ui,-apple-system,"Segoe UI",Roboto,Ubuntu,Arial,sans-serif;
      color:var(--text);
      background: radial-gradient(1100px 700px at 12% -10%, #ffeedd 0%, #fff 35%),
                  linear-gradient(180deg, var(--bg1), var(--bg2));
    }

    /* ===== Encabezado ===== */
    header{
      background:linear-gradient(180deg, #8b5e3c, #7b5234);
      color:#fff; display:flex; align-items:center;
      justify-content:space-between; padding:16px 22px;
      box-shadow:0 8px 22px rgba(0,0,0,.15);
    }
    .brand{ display:flex; gap:10px; align-items:center; }
    .brand .logo{
      width:44px; height:44px; border-radius:12px; display:grid; place-items:center;
      background:#ffffff20; border:1px solid #ffffff35; font-size:1.2rem;
    }
    header h1{ margin:0; font-size:1.4rem; letter-spacing:.3px; font-weight:800 }
    header .sub{opacity:.9; margin-top:2px; font-size:.9rem; letter-spacing:.2px}

    /* Botón regresar (solo si admin) */
    .back-btn{
      background:#ffffff18; color:#fff; text-decoration:none;
      border:1px solid #ffffff30; border-radius:10px;
      padding:10px 14px; font-weight:600;
      display:inline-flex; align-items:center; gap:6px;
      transition:background .2s ease, transform .12s ease;
    }
    .back-btn:hover{background:#ffffff28; transform:translateY(-1px)}

    /* ===== Contenido principal ===== */
    main{ width:min(980px, 92%); margin:42px auto; display:grid; gap:18px; }
    .card{
      background:var(--glass);
      backdrop-filter:saturate(1.15) blur(8px);
      -webkit-backdrop-filter:saturate(1.15) blur(8px);
      border:1px solid #ffffff66;
      border-radius:calc(var(--radius) + 6px);
      box-shadow:var(--shadow);
      overflow:hidden;
    }
    .card-head{
      padding:24px 22px; text-align:center;
      background:linear-gradient(180deg,#ffffffcc,#fffaf3cc);
      border-bottom:1px solid var(--line);
    }
    .card-head h2{ margin:.1em 0 .35em; font-size:1.35rem }
    .card-head p{ margin:0; font-size:1.05rem }
    .hi{ font-weight:800 }

    .body{ padding:22px; }

    /* Quick actions */
    .quick{
      display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap:12px;
    }
    .btn{
      display:inline-flex; align-items:center; justify-content:center; gap:8px;
      padding:12px 16px; border-radius:12px; font-weight:800; text-decoration:none; cursor:pointer;
      border:1px solid var(--line);
      box-shadow:0 10px 22px rgba(0,0,0,.06);
      transition:transform .12s ease, filter .18s ease, background .2s ease;
      color:#fff;
    }
    .btn-brand{ background:linear-gradient(180deg, var(--brand), #6f4b30); }
    .btn-brand2{ background:linear-gradient(180deg, var(--brand-2), #8e6949); }
    .btn-accent{ background:linear-gradient(180deg, var(--accent), #c86635); }
    .btn-light{
      background:#fff; color:var(--brand); border-color:#eadfce;
    }
    .btn:hover{ filter:brightness(.98); transform:translateY(-1px) }

    /* Bloque “último pedido” */
    .order{
      background:#fff; border:1px solid var(--line); border-radius:16px; padding:14px 16px;
      display:grid; gap:6px;
    }
    .order small{ color:var(--muted) }

    /* Cerrar sesión */
    .actions{ text-align:center; padding:0 22px 26px }
    form{ display:inline }
    .logout{
      appearance:none; border:none; cursor:pointer;
      background:linear-gradient(180deg, var(--accent), #c86635);
      color:#fff; font-weight:800; letter-spacing:.3px;
      padding:12px 18px; border-radius:12px;
      box-shadow:0 10px 22px rgba(215,122,73,.28);
      transition:transform .12s ease, filter .18s ease;
    }
    .logout:hover{ filter:brightness(.97) }
    .logout:active{ transform:translateY(1px) }

    /* Pie */
    footer{ text-align:center; color:var(--muted); padding:18px 12px; margin-bottom:8px; }

    /* Responsive */
    @media (max-width:520px){
      header h1{font-size:1.3rem}
    }
  </style>
</head>
<body>
  <header>
    <div class="brand">
      <div class="logo">🛍️</div>
      <div>
        <h1>Panel de Cliente</h1>
        <div class="sub">Panadería y Pastelería Dayane</div>
      </div>
    </div>

    @if(auth()->user()->role === 'admin')
      <a href="{{ url()->previous() }}" class="back-btn">⬅️ Regresar</a>
    @endif
  </header>

  <main role="main">
    {{-- Tarjeta de bienvenida --}}
    <section class="card" aria-labelledby="bienvenida">
      <div class="card-head">
        <h2 id="bienvenida">¡Hola!</h2>
        <p>Bienvenido, <span class="hi">{{ auth()->user()->name }}</span>.</p>
      </div>

      <div class="body" style="display:grid; gap:18px">
        {{-- Acciones rápidas para pedir --}}
        <div class="quick">
          {{-- Si definiste una ruta general de catálogo, úsala. Si no, deja las categorías directas. --}}
          {{-- <a href="{{ route('catalogo') }}" class="btn btn-brand">🛒 Ver catálogo y pedir</a> --}}

          <a href="{{ route('productos.publico', 'chocolate') }}" class="btn btn-brand">🍫 Pasteles de chocolate</a>
          <a href="{{ route('productos.publico', 'eventos') }}" class="btn btn-brand2">🎉 Pasteles para eventos</a>
          <a href="{{ route('productos.publico', 'temporada') }}" class="btn btn-accent">🍁 Pasteles de temporada</a>
          <a href="{{ route('productos.publico', 'rollos') }}" class="btn btn-accent">🍥 Rollos y variedades</a>
          <a href="{{ route('productos.publico', 'frutas') }}" class="btn btn-brand2">🍓 Pasteles de frutas</a>
          <a href="{{ route('pedidos.index') }}" class="btn btn-light">📦 Mis pedidos</a>
        </div>

        {{-- Último pedido (opcional) --}}
        @isset($ultimoPedido)
          <div class="order">
            <strong>Tu último pedido</strong>
            <small>#{{ $ultimoPedido->id }} • Estado: {{ ucfirst($ultimoPedido->estado) }} •
              Entrega: {{ $ultimoPedido->fecha_entrega ?? '—' }}</small>
            <div>
              <a href="{{ route('pedidos.show', $ultimoPedido) }}" class="btn btn-light" style="margin-top:6px;">Ver detalle</a>
            </div>
          </div>
        @endisset

        {{-- Mensaje amable --}}
        <div style="text-align:center; color:var(--muted);">
          ¿No encuentras un diseño? Haz tu pedido y escribe el mensaje que quieres en tu pastel. 💌
        </div>
      </div>

      <div class="actions">
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="logout">Cerrar sesión</button>
        </form>
      </div>
    </section>
  </main>

  <footer>
    © {{ date('Y') }} Panadería y Pastelería Dayane — Panel de Cliente
  </footer>
</body>
</html>


