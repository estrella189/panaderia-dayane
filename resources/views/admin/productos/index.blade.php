<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos - Admin</title>
    <style>
        body {
            margin: 0;
            font-family: 'Trebuchet MS', Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }
        header {
            background-color: #8b5e3c;
            color: #fff;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .container {
            max-width: 1100px;
            margin: 2rem auto;
            background: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #8b5e3c;
        }
        .btn {
            display: inline-block;
            padding: 8px 14px;
            border-radius: 6px;
            background: #8b5e3c;
            color: #fff;
            text-decoration: none;
            margin-bottom: 15px;
        }
        .btn:hover {
            background: #70482b;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f0e6dc;
        }
        img {
            border-radius: 8px;
        }
        button {
            background: #c0392b;
            color: white;
            border: none;
            padding: 6px 10px;
            border-radius: 6px;
            cursor: pointer;
        }
        button:hover {
            background: #a93226;
        }
        .alert {
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 10px;
        }
        .alert-success {
            background: #e6f7ec;
            border: 1px solid #b8e0c6;
        }
        .alert-info {
            background: #f2f2f2;
            border: 1px solid #ddd;
        }
        footer {
            text-align: center;
            margin-top: 2rem;
            padding: 15px;
            color: #777;
        }
    </style>
</head>
<body>
    <header>
        <h2>Panel de Administración</h2>
    </header>

    <div class="container">
        <h1>Gestión de Productos</h1>

        <a href="{{ route('admin.productos.create') }}" class="btn">Agregar Producto</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($productos->isEmpty())
            <div class="alert alert-info">No hay productos registrados.</div>
        @else
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Subcategoría</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                    <tr>
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ optional($producto->categoria)->nombre ?? 'Sin categoría' }}</td>
                        <td>{{ optional($producto->subcategoria)->nombre ?? 'Sin subcategoría' }}</td>
                        <td>
                            @if ($producto->imagen)
                                <img src="{{ asset('storage/' . $producto->imagen) }}" alt="Imagen" width="80">
                            @else
                                <span class="text-muted">Sin imagen</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.productos.edit', $producto->id) }}" class="btn">Editar</a>
                            <form action="{{ route('admin.productos.destroy', $producto->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('¿Eliminar producto?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>

    <footer>
        © {{ date('Y') }} Panadería y Pastelería Dayane — Todos los derechos reservados
    </footer>
</body>
</html>

