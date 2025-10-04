
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Panel de Empleado — Panadería y Pastelería Dayane</title>
  <style>
    :root{
      --bg1:#fffaf4; --bg2:#f3e7dc; --glass:#ffffffcc;
      --text:#3a281c; --muted:#6f533f;
      --brand:#8b5e3c; --brand-2:#a97e5a; --accent:#d77a49;
      --line:#eadfce; --shadow:0 20px 40px rgba(139,94,60,.18);
      --radius:18px;
    }
    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      margin:0; font-family:system-ui,-apple-system,"Segoe UI",Roboto,Ubuntu,Arial,sans-serif;
      color:var(--text);
      background: radial-gradient(1200px 800px at 10% -5%, #ffeedd 0%, #fff 35%),
                  linear-gradient(180deg, var(--bg1), var(--bg2));
    }

    /* Encabezado */
    header{
      background:linear-gradient(180deg, #8b5e3c, #7a5233);
      color:#fff; text-align:center; padding:26px 18px 22px;
      box-shadow:0 8px 22px rgba(0,0,0,.15);
      border-bottom:1px solid #0000001a;
    }
    .brand{
      display:flex; align-items:center; justify-content:center; gap:12px; flex-wrap:wrap;
    }
    .logo{
      width:44px; height:44px; border-radius:12px;
      background:#ffffff22; border:1px solid #ffffff3a;
      display:grid; place-items:center; font-size:1.2rem;
    }
    header h1{margin:0; font-size:1.6rem; font-weight:800; letter-spacing:.3px}
    .sub{opacity:.92; margin-top:4px; letter-spacing:.2px}

    /* Tarjeta principal */
    main{width:min(900px, 92%); margin:42px auto;}
    .card{
      background:var(--glass);
      backdrop-filter:saturate(1.15) blur(8px);
      -webkit-backdrop-filter:saturate(1.15) blur(8px);
      border:1px solid #ffffff66; border-radius:calc(var(--radius) + 6px);
      box-shadow:var(--shadow); overflow:hidden;
    }

    .card-head{
      padding:24px 22px;
      background:linear-gradient(180deg,#ffffffcc,#fffaf3cc);
      border-bottom:1px solid var(--line);
      text-align:center;
    }
    .card-head h2{margin:.2em 0 .4em; font-size:1.35rem}
    .card-head p{margin:0; font-size:1.05rem}
    .hi{font-weight:800}

    /* Zona de contenido */
    .body{
      padding:28px 24px; text-align:center;
    }
    .body p{
      font-size:1.05rem; color:var(--muted);
      max-width:600px; margin:0 auto 24px;
    }
    .emoji{
      font-size:2rem; margin-bottom:10px;
    }

    /* Botón de cerrar sesión */
    .actions{text-align:center; padding:0 22px 26px}
    form{display:inline}
    button{
      appearance:none; border:none; cursor:pointer;
      background:linear-gradient(180deg, var(--accent), #c76635);
      color:#fff; font-weight:800; letter-spacing:.3px;
      padding:12px 18px; border-radius:12px;
      box-shadow:0 10px 22px rgba(215,122,73,.28);
      transition:transform .12s ease, filter .18s ease;
    }
    button:hover{filter:brightness(.97)}
    button:active{transform:translateY(1px)}

    /* Footer */
    footer{
      text-align:center; color:var(--muted);
      padding:18px 12px; margin-top:24px;
    }

    @media (max-width:520px){
      header h1{font-size:1.35rem}
      .card-head h2{font-size:1.2rem}
    }
  </style>
</head>
<body>

  <header>
    <div class="brand">
      <div class="logo">👩‍🍳</div>
      <div>
        <h1>Panel de Empleado</h1>
        <div class="sub">Panadería y Pastelería Dayane</div>
      </div>
    </div>
  </header>

  <main role="main">
    <section class="card" aria-labelledby="bienvenida">
      <div class="card-head">
        <h2 id="bienvenida">¡Bienvenido!</h2>
        <p>Hola, <span class="hi">{{ auth()->user()->name }}</span>.</p>
      </div>

      <div class="body">
        <div class="emoji">🥐</div>
        <p>
          Aquí podrás revisar los pedidos asignados y marcar su estado como <strong>Entregado</strong> o <strong>Cancelado</strong> según corresponda.
        </p>
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
    © {{ date('Y') }} Panadería y Pastelería Dayane — Panel de Empleado
  </footer>

</body>
</html>
