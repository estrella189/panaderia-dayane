<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Pedido</title>
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
            font-family: Arial, Helvetica, sans-serif;
            background: var(--bg);
            color: var(--text);
            margin: 0;
            padding: 0;
        }
        header {
            background: linear-gradient(180deg,#8b5e3c,#7e5436);
            color: #fff;
            padding: 15px 25px;
            text-align: center;
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

        main {
            max-width: 700px;
            margin: 30px auto;
            background: #fff;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0,0,0,.1);
        }
        .row { display: grid; grid-template-columns: 160px 1fr; gap: 10px; margin: 8px 0; }
        .label { font-weight: bold; color: #5a3f2a; }
        .box {
            background: #fff7ef;
            border: 1px solid #ecdccf;
            padding: 12px;
            border-radius: 8px;
            line-height: 1.45;
        }
        .badge {
            padding: 5px 10px;
            border-radius: 6px;
            font-size: .9rem;
            font-weight: bold;
            color: #fff;
        }
        .pendiente { background: #e3b04b; color: #000; }
        .en_proceso { background:#a97e5a; }
        .entregado { background: #2b8a3e; }
        .cancelado { background: #c0392b; }
        .actions { margin-top: 16px; display: flex; gap: 8px; flex-wrap: wrap; }
        button {
            border: none;
            padding: 8px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }
        .btn-success { background: #2b8a3e; color: #fff; }
        .btn-danger { background: #c0392b; color: #fff; }
        .btn-back { background:#8b5e3c; color:#fff; text-decoration:none; padding:8px 12px; border-radius:6px; display:inline-block; margin-bottom:10px; }
        .muted { color:#6f533f; }
        @media (max-width: 600px){
            .row { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
<header>
    <h1>Detalle del Pedido #{{ $pedido->id }}</h1>
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
    <a href="{{ route('empleado.pedidos.index') }}" class="btn-back">← Volver al listado</a>

    @php
        $clienteNombre   = $pedido->cliente->name ?? '—';
        $cotizacion      = $pedido->cotizacion;
        $productoNombre  = $cotizacion?->producto?->nombre
                          ?? $cotizacion?->producto?->Nombre
                          ?? '— Producto no asignado —';
        $detalles        = $cotizacion?->detalles ?? 'Sin detalles';
        $fechaCreacion   = optional($pedido->created_at)->timezone('America/Monterrey')->format('d/m/Y H:i');
        $cerrado         = in_array($pedido->estado, ['entregado','cancelado']);
    @endphp

    <div class="row">
        <div class="label">Cliente:</div>
        <div>{{ $clienteNombre }}</div>
    </div>

    <div class="row">
        <div class="label">Cotización:</div>
        <div class="box">
            <div><strong>Producto:</strong> {{ $productoNombre }}</div>
            <div class="muted" style="margin-top:6px;"><strong>Detalles:</strong> {{ $detalles }}</div>
        </div>
    </div>

    <div class="row">
        <div class="label">Estado:</div>
        <div><span class="badge {{ $pedido->estado }}">{{ ucfirst(str_replace('_',' ',$pedido->estado)) }}</span></div>
    </div>

    <div class="row">
        <div class="label">Creado:</div>
        <div>{{ $fechaCreacion }}</div>
    </div>

    @if(!$cerrado)
        <div class="actions">
            <form method="POST" action="{{ route('empleado.pedidos.estado',$pedido) }}">
                @csrf @method('PATCH')
                <input type="hidden" name="estado" value="entregado">
                <button class="btn-success">Marcar entregado</button>
            </form>

            <form method="POST" action="{{ route('empleado.pedidos.estado',$pedido) }}">
                @csrf @method('PATCH')
                <input type="hidden" name="estado" value="cancelado">
                <button class="btn-danger">Cancelar</button>
            </form>
        </div>
    @endif
</main>
</body>
</html>
