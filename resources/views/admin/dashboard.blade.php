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

    /* Motas “harina” decorativas */
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

    header{
      position:sticky; top:0; z-index:10;
      background:linear-gradient(180deg, #8b5e3c, #7e5436);
      color:#fff; text-align:center; padding:26px 18px 22px;
      border-bottom:1px solid #00000018; box-shadow:0 8px 22px rgba(0,0,0,.15);
    }
    header .brand{
      display:flex; gap:12px; align-items:center; justify-content:center; flex-wrap:wrap;
    }
    .logo{
      width:44px; height:44px; border-radius:12px; display:grid; place-items:center;
      background:#ffffff18; border:1px solid #ffffff30; font-size:1.2rem;
    }
    header h1{
      margin:0; font-size:1.7rem; letter-spacing:.3px; font-weight:800;
    }
    header .sub{opacity:.92; margin-top:4px; letter-spacing:.2px}

    main{
      width:min(900px,92%); margin:42px auto; position:relative;
      padding:0 0 26px;
    }

    /* Tarjeta principal con glassmorphism */
    .card{
      background:var(--glass);
      backdrop-filter:saturate(1.2) blur(8px);
      -webkit-backdrop-filter:saturate(1.2) blur(8px);
      border:1px solid #ffffff66;
      box-shadow:var(--shadow);
      border-radius:calc(var(--radius) + 6px);
      overflow:hidden;
    }

    .card-head{
      padding:24px 22px;
      background:linear-gradient(180deg,#ffffffcc,#fffaf3cc);
      border-bottom:1px solid var(--line);
      text-align:center;
    }
    .card-head p{margin:0; font-size:1.06rem}
    .hi{font-weight:700}

    .grid{
      padding:24px; display:grid; gap:16px;
      grid-template-columns:repeat(3,1fr);
    }

    .tile{
      background:#ffffffee; border:1px solid var(--line);
      border-radius:var(--radius); padding:18px 16px;
      text-align:center;
      transition:transform .18s ease, box-shadow .18s ease, border-color .18s ease, background .18s ease;
      box-shadow:0 8px 20px rgba(0,0,0,.05);
    }
    .tile:hover{
      transform:translateY(-4px);
      box-shadow:0 16px 30px rgba(0,0,0,.08);
      border-color:#e0d4c2;
      background:#fff;
    }

    .tile a{
      text-decoration:none; color:var(--text);
      display:flex; flex-direction:column; align-items:center; gap:8px; font-weight:800;
      letter-spacing:.2px;
    }
    .emoji{
      font-size:1.7rem; width:48px; height:48px; display:grid; place-items:center;
      border-radius:14px; background:#f8efe6; border:1px solid var(--line);
    }

    .actions{
      padding:0 24px 24px; display:flex; justify-content:center;
    }
    form{margin-top:4px}
    button{
      appearance:none; border:none; cursor:pointer;
      background:linear-gradient(180deg, var(--accent), #c76635);
      color:#fff; font-weight:800; letter-spacing:.3px;
      padding:12px 18px; border-radius:12px;
      box-shadow:0 10px 22px rgba(215,122,73,.28);
      transition:transform .12s ease, filter .18s ease;
    }
    button:hover{ filter:brightness(.97) }
    button:active{ transform:translateY(1px) }

    /* Focus accesible */
    a,button{ outline:none }
    a:focus-visible, button:focus-visible{
      box-shadow:0 0 0 3px #fff, 0 0 0 6px var(--focus) !important;
      border-radius:12px;
    }

    footer{
      text-align:center; color:var(--muted); padding:18px 12px; margin-bottom:8px;
    }

    /* Responsive */
    @media (max-width:860px){ .grid{grid-template-columns:1fr 1fr} }
    @media (max-width:520px){
      header h1{font-size:1.35rem}
      .grid{grid-template-columns:1fr}
      .emoji{font-size:1.5rem; width:44px; height:44px}
    }
  </style>
</head>
<body>
  <div class="dust"></div>

  <header>
    <div class="brand">
      <div class="logo">🍞</div>
      <div>
        <h1>Panel de Administrador</h1>
        <div class="sub">Panadería y Pastelería Dayane</div>
      </div>
    </div>
  </header>

  <main role="main">
    <section class="card" aria-labelledby="bienvenida">
      <div class="card-head">
        <p id="bienvenida">Bienvenido, <span class="hi">{{ auth()->user()->name }}</span>.</p>
      </div>

      <div class="grid" role="list">
        <div class="tile" role="listitem">
          <a href="{{ route('productos.index') }}" aria-label="Gestionar productos">
            <div class="emoji">🥐</div>
            Gestionar productos
          </a>
        </div>

        <div class="tile" role="listitem">
          <a href="{{ route('empleado.panel') }}" aria-label="Ver Panel Empleado">
            <div class="emoji">👩‍🍳</div>
            Ver Panel Empleado
          </a>
        </div>

        <div class="tile" role="listitem">
          <a href="{{ route('cliente.inicio') }}" aria-label="Ver Página Cliente">
            <div class="emoji">🛍️</div>
            Ver Página Cliente
          </a>
        </div>
      </div>

      <div class="actions">
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" aria-label="Cerrar sesión">Cerrar sesión</button>
        </form>
      </div>
    </section>
  </main>

  <footer>
    © {{ date('Y') }} Panadería y Pastelería Dayane — Panel de Administración
  </footer>
</body>
</html>
