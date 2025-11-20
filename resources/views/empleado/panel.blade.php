<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel de Empleado — Panadería y Pastelería Dayane</title>
  <style>
    :root{
      --bg:#fff9f4; --card:#ffffff;
      --text:#3a281c; --muted:#6f533f;
      --brand:#8b5e3c; --accent:#a97e5a;
      --line:#eadfce; --shadow:0 10px 25px rgba(139,94,60,.18);
      --radius:18px;
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
      color:#fff;
      padding:18px 22px;
      display:flex; align-items:center; justify-content:space-between;
      box-shadow:0 8px 22px rgba(0,0,0,.15);
      gap:10px;
    }

    header h1{ margin:0; font-size:1.4rem; }

    .header-actions{
      display:flex;
      gap:12px;
      align-items:center;
    }

    .back-btn, .logout-btn{
      background:#ffffff18;
      color:#fff;
      border:1px solid #ffffff30;
      padding:10px 16px;
      border-radius:10px;
      font-weight:600;
      text-decoration:none;
    }

    .logout-btn{
      background:#c04444;
      border-color:#b73838;
    }
    .logout-btn:hover{ background:#a83232; }

    /* TARJETAS */
    .container{ max-width:1000px; margin:40px auto; padding:20px; }
    .grid{
      display:grid;
      grid-template-columns:repeat(auto-fit,minmax(240px,1fr));
      gap:20px;
    }
    .card{
      background:var(--card);
      padding:25px;
      border-radius:var(--radius);
      box-shadow:var(--shadow);
      text-align:center;
      border:1px solid #f1e2d3;
    }
    .card h3{ margin:0 0 10px; color:var(--brand); }
    .card p{ color:var(--muted); margin-bottom:20px; }
    .btn{
      display:inline-block;
      background:var(--brand);
      color:#fff;
      padding:10px 16px;
      border-radius:10px;
      font-weight:700;
      text-decoration:none;
    }
    .btn:hover{ background:#70452b; }

  </style>
</head>
<body>

  @php
    $esAdmin = auth()->check() && auth()->user()->role === 'admin';
  @endphp

  <header>
    <h1>👩‍🍳 Panel de Empleado</h1>

    <div class="header-actions">

      {{-- Admin: regresar al panel --}}
      @if($esAdmin)
        <a href="{{ route('admin.dashboard') }}" class="back-btn">⬅️ Volver al panel admin</a>
      @endif

      {{-- Cerrar sesión para empleado y admin --}}
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="logout-btn">🚪 Cerrar sesión</button>
      </form>

    </div>
  </header>

  <div class="container">
    <h2>Hola, {{ auth()->user()->name }}</h2>
    <p>Selecciona una acción para empezar.</p>

    {{-- TARJETAS DEL PANEL --}}
    <div class="grid">
      
      <div class="card">
        <h3>📋 Ver todos los pedidos</h3>
        <p>Consulta, responde o revisa el estado de los pedidos de los clientes.</p>
        <a class="btn" href="{{ route('empleado.pedidos.index') }}">Ir a pedidos</a>
      </div>

      <div class="card">
        <h3>⚠️ Pedidos pendientes</h3>
        <p>Pedidos sin responder por el empleado.</p>
        <a class="btn" href="{{ route('empleado.pedidos.index', ['estado'=>'pendiente']) }}">Ver pendientes</a>
      </div>

      <div class="card">
        <h3>✔️ Entregados</h3>
        <p>Historial de pedidos completados.</p>
        <a class="btn" href="{{ route('empleado.pedidos.index', ['estado'=>'entregado']) }}">Ver entregados</a>
      </div>

      <div class="card">
        <h3>❌ Cancelados</h3>
        <p>Pedidos cancelados por el cliente o administración.</p>
        <a class="btn" href="{{ route('empleado.pedidos.index', ['estado'=>'cancelado']) }}">Ver cancelados</a>
      </div>

    </div>
  </div>

</body>
</html>
