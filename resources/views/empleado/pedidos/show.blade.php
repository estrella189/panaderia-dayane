<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Pedido</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #faf5ef;
            color: #333;
            margin: 0;
            padding: 0;
        }
        header {
            background: #8b5e3c;
            color: #fff;
            padding: 15px 25px;
            text-align: center;
        }
        main {
            max-width: 700px;
            margin: 30px auto;
            background: #fff;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0,0,0,.1);
        }
        .badge {
            padding: 5px 10px;
            border-radius: 6px;
            font-size: .9rem;
            font-weight: bold;
            color: #fff;
        }
        .pendiente { background: #e3b04b; color: #000; }
        .entregado { background: #2b8a3e; }
        .cancelado { background: #c0392b; }
        button {
            border: none;
            padding: 8px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }
        .btn-success { background: #2b8a3e; color: #fff; }
        .btn-danger { background: #c0392b; color: #fff; }
        .btn-back { background:#8b5e3c; color:#fff; text-decoration:none; padding:8px 12px; border-radius:6px; }
    </style>
</head>
<body>
<header>
    <h1>Detalle del Pedido #{{ $pedido->id }}</h1>
</header>

<main>
    <a href="{{ route('empleado.pedidos.index') }}" class="btn-back">← Volver</a>

    <p><strong>ID Cliente:</strong> {{ $pedido->id_cliente }}</p>
    <p><strong>ID Cotización:</strong> {{ $pedido->id_cotizacion }}</p>
    <p><strong>Estado:</strong> 
        <span class="badge {{ $pedido->estado }}">{{ ucfirst($pedido->estado) }}</span>
    </p>
    <p><strong>Fecha de creación:</strong> {{ $pedido->created_at->format('d/m/Y H:i') }}</p>

    @if(!in_array($pedido->estado,['entregado','cancelado']))
        <form method="POST" action="{{ route('empleado.pedidos.estado',$pedido) }}" style="display:inline-block;">
            @csrf @method('PATCH')
            <input type="hidden" name="estado" value="entregado">
            <button class="btn-success">Marcar entregado</button>
        </form>

        <form method="POST" action="{{ route('empleado.pedidos.estado',$pedido) }}" style="display:inline-block;">
            @csrf @method('PATCH')
            <input type="hidden" name="estado" value="cancelado">
            <button class="btn-danger">Cancelar</button>
        </form>
    @endif
</main>
</body>
</html>
