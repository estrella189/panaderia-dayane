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
      --radius:16px; --focus:#1f6feb;
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
      transition:background .2s ease, transform .12s ease;
    }
    .back-btn:hover{background:#ffffff28; transform:translateY(-1px)}
    main{
      max-width:900px; margin:50px auto; background:var(--card);
      border-radius:var(--radius); padding:30px; box-shadow:var(--shadow);
    }
    h2{margin-top:0; color:var(--brand)}
    .btn{
      padding:10px 16px; border:none; border-radius:12px;
      background:var(--brand); color:#fff; font-weight:600; cursor:pointer;
      transition:background .2s ease, transform .1s ease;
    }
    .btn:hover{background:var(--accent); transform:translateY(-1px)}
    table{
      width:100%; border-collapse:collapse; margin-top:20px;
    }
    th,td{
      padding:12px; border-bottom:1px solid var(--line);
      text-align:left;
    }
    th{background:#f8f1ea; color:var(--brand)}
    tr:hover td{background:#fff8f3}
  </style>
</head>
<body>
  <header>
    <h1>👩‍🍳 Panel de Empleado</h1>
   @if(auth()->user()->role === 'admin')
        <a href="{{ url()->previous() }}" class="back-btn">⬅️ Regresar</a>
    @endif
  </header>

  <main>
    <h2>Bienvenido, {{ auth()->user()->name }}</h2>
    <p>Aquí puedes gestionar los pedidos y marcar su estado:</p>

    <table>
      <thead>
        <tr>
          <th>Producto</th>
          <th>Cantidad</th>
          <th>Estado</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <!-- Ejemplo -->
        <tr>
          <td>Rollo de Canela</td>
          <td>3</td>
          <td>Pendiente</td>
          <td>
            <button class="btn">Entregado</button>
            <button class="btn" style="background:#c44;">Cancelado</button>
          </td>
        </tr>
      </tbody>
    </table>

    <form action="{{ route('logout') }}" method="POST" style="margin-top:30px">
      @csrf
      <button type="submit" class="btn" style="background:#7e5436;">🚪 Cerrar sesión</button>
    </form>
  </main>
</body>
</html>
