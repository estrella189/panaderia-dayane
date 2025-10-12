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

    /* Toggle (checkbox hack) */
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

    /* Drawer */
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
    .drawer-nav{
      padding:12px;
      display:grid; gap:8px;
    }
    .drawer-nav a, .drawer-nav form button{
      display:flex; align-items:center; gap:10px;
      padding:12px 14px; border-radius:12px; text-decoration:none; border:1px solid var(--line);
      background:#fff; color:var(--text); font-weight:700;
      box-shadow:0 6px 14px rgba(0,0,0,.04);
      transition:transform .12s ease, box-shadow .18s ease, background .18s ease, border-color .18s ease;
    }
    .drawer-nav a:hover, .drawer-nav form button:hover{
      transform:translateY(-2px); background:#fffdfb; border-color:#e6d8c7;
      box-shadow:0 12px 20px rgba(0,0,0,.06);
    }
    .drawer-nav .emoji{ width:24px; text-align:center }

    /* Estado abierto */
    #nav-toggle:checked ~ .overlay{opacity:1; visibility:visible}
    #nav-toggle:checked ~ .drawer{ right:0 }
    #nav-toggle:checked + label .bars{ transform:rotate(45deg) }
    #nav-toggle:checked + label .bars::before{ transform:rotate(90deg); top:0 }
    #nav-toggle:checked + label .bars::after { opacity:0 }

    /* Focus accesible */
    a,button{ outline:none }
    a:focus-visible, button:focus-visible{
      box-shadow:0 0 0 3px #fff, 0 0 0 6px var(--focus) !important;
      border-radius:12px;
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

      <!-- Toggle + botón hamburguesa -->
      <input type="checkbox" id="nav-toggle" aria-hidden="true">
      <label for="nav-toggle" class="burger" aria-label="Abrir menú" aria-controls="drawer" aria-expanded="false">
        <span class="bars"></span>
      </label>

      <!-- Overlay + Drawer -->
      <div class="overlay"></div>
      <nav id="drawer" class="drawer" aria-label="Navegación principal">
        <div class="drawer-head">
          <div class="mini">🍞</div>
          <div>
            <strong>Hola, {{ auth()->user()->name }}</strong><br>
            <small>Administrador</small>
          </div>
        </div>
     <div class="drawer-nav">
      <!-- Nuevo botón regresar que solo cierra el menú -->
      <label for="nav-toggle" class="close-drawer">
        <span class="emoji">⬅️</span> Regresar
      </label>

      <a href="{{ route('productos.index') }}"><span class="emoji">🥐</span> Gestionar productos</a>
      <a href="{{ route('empleado.panel') }}"><span class="emoji">👩‍🍳</span> Ver Panel Empleado</a>
      <a href="{{ route('cliente.inicio') }}"><span class="emoji">🛍️</span> Ver Página Cliente</a>

      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit"><span class="emoji">🚪</span> Cerrar sesión</button>
      </form>
    </div>

  </header>

  <!-- Página sin contenido adicional, solo el header con el menú -->
</body>
</html>
