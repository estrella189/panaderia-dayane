<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos — Panel Empleado</title>
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
            max-width: 1000px;
            margin: 30px auto;
            background: #fff;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0,0,0,.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border-bottom: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background: #f7ede3;
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
        .acciones form { display: inline-block; margin: 2px; }
        button {
            border: none;
            padding: 6px 10px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }
        .btn-success { background: #2b8a3e; color: #fff; }
        .btn-danger { background: #c0392b; color: #fff; }
        .btn-secondary { background: #8b5e3c; color: #fff; text-decoration:none; padding:6px 10px; border-radius:6px; }
        .alert-success { background:#eaf8ea; border-left:4px solid #2b8a3e; padding:8px; margin-bottom:10px; }
        .alert-danger { background:#fdeaea; border-left:4px solid #c0392b; padding:8px; margin-bottom:10px; }
    </style>
</head>
<body>
<header>
    <h1>Pedidos - Empleado</h1>
</header>

<main>
    @if(session('ok'))    <div class="alert-success">{{ session('ok') }}</div> @endif
    @if(session('error')) <div class="alert-danger">{{ session('error') }}</div> @endif

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>ID Cliente</th>
                <th>ID Cotización</th>
                <th>Estado</th>
                <th>Creado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pedidos as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->id_cliente }}</td>
                    <td>{{ $p->id_cotizacion }}</td>
                    <td>
                        <span class="badge {{ $p->estado }}">
                            {{ ucfirst($p->estado) }}
                        </span>
                    </td>
                    <td>{{ $p->created_at->format('d/m/Y H:i') }}</td>
                    <td class="acciones">
                        <a href="{{ route('empleado.pedidos.show',$p) }}" class="btn-secondary">Ver</a>

                        @if(!in_array($p->estado,['entregado','cancelado']))
                            <form method="POST" action="{{ route('empleado.pedidos.estado',$p) }}">
                                @csrf @method('PATCH')
                                <input type="hidden" name="estado" value="entregado">
                                <button class="btn-success">Entregado</button>
                            </form>

                            <form method="POST" action="{{ route('empleado.pedidos.estado',$p) }}">
                                @csrf @method('PATCH')
                                <input type="hidden" name="estado" value="cancelado">
                                <button class="btn-danger">Cancelar</button>
                            </form>
                        @else
                            <em>—</em>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" style="text-align:center; padding:10px;">No hay pedidos.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top:15px;">
        {{ $pedidos->links() }}
    </div>
</main>
</body>
</html>
