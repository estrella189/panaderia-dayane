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
    .brand{
      display:flex; gap:10px; align-items:center;
    }
    .brand .logo{
      width:44px; height:44px; border-radius:12px; display:grid; place-items:center;
      background:#ffffff20; border:1px solid #ffffff35; font-size:1.2rem;
    }
    header h1{ margin:0; font-size:1.4rem; letter-spacing:.3px; font-weight:800 }
    header .sub{opacity:.9; margin-top:2px; font-size:.9rem; letter-spacing:.2px}

    /* Botón regresar */
    .back-btn{
      background:#ffffff18; color:#fff; text-decoration:none;
      border:1px solid #ffffff30; border-radius:10px;
      padding:10px 14px; font-weight:600;
      display:inline-flex; align-items:center; gap:6px;
      transition:background .2s ease, transform .12s ease;
    }
    .back-btn:hover{background:#ffffff28; transform:translateY(-1px)}

    /* ===== Contenido principal ===== */
    main{ width:min(880px, 92%); margin:42px auto; }
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

    .body{
      padding:26px 22px; display:flex; align-items:center; justify-content:center;
    }
    .chip{
      display:inline-flex; align-items:center; gap:10px;
      background:#fff; border:1px solid var(--line); border-radius:999px;
      padding:10px 14px; font-weight:700; color:var(--brand);
      box-shadow:0 10px 22px rgba(0,0,0,.06);
    }
    .chip .emoji{
      width:36px; height:36px; display:grid; place-items:center;
      font-size:1.2rem; background:#f7ede3; border:1px solid var(--line); border-radius:10px;
    }

    /* Botón cerrar sesión */
    .actions{ text-align:center; padding:0 22px 26px }
    form{ display:inline }
    button{
      appearance:none; border:none; cursor:pointer;
      background:linear-gradient(180deg, var(--accent), #c86635);
      color:#fff; font-weight:800; letter-spacing:.3px;
      padding:12px 18px; border-radius:12px;
      box-shadow:0 10px 22px rgba(215,122,73,.28);
      transition:transform .12s ease, filter .18s ease;
    }
    button:hover{ filter:brightness(.97) }
    button:active{ transform:translateY(1px) }

    /* Pie */
    footer{
      text-align:center; color:var(--muted); padding:18px 12px; margin-bottom:8px;
    }

    /* Responsive */
    @media (max-width:520px){
      header h1{font-size:1.3rem}
      .chip{ font-size:.95rem }
      .chip .emoji{ width:32px; height:32px; font-size:1.05rem }
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
    <section class="card" aria-labelledby="bienvenida">
      <div class="card-head">
        <h2 id="bienvenida">¡Hola!</h2>
        <p>Bienvenido, <span class="hi">{{ auth()->user()->name }}</span>.</p>
      </div>

      <div class="body">
        <div class="chip">
          <div class="emoji">🥐</div>
          <span>Disfruta tu experiencia como cliente</span>
        </div>
      </div>

      <div class="actions">
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" aria-label="Cerrar sesión">🚪 Cerrar sesión</button>
        </form>
      </div>
    </section>
  </main>

  <footer>
    © {{ date('Y') }} Panadería y Pastelería Dayane — Panel de Cliente
  </footer>
</body>
</html>


