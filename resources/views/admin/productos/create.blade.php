<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar nuevo producto - Admin</title>
    <style>
        body {
            margin: 0;
            font-family: 'Trebuchet MS', Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }
        header {
            background-color: #8b5e3c;
            color: white;
            text-align: center;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .container {
            max-width: 700px;
            margin: 2rem auto;
            background: #fff;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        h2 {
            color: #8b5e3c;
            text-align: center;
            margin-bottom: 1.5rem;
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
            margin-bottom: 5px;
        }
        input, textarea, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-bottom: 15px;
        }
        button, .btn {
            display: inline-block;
            padding: 10px 15px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            font-weight: bold;
        }
        .btn-success {
            background: #8b5e3c;
            color: white;
        }
        .btn-success:hover {
            background: #70482b;
        }
        .btn-secondary {
            background: #ccc;
            color: black;
        }
        .alert {
            background: #fdeaea;
            border: 1px solid #f2b2b2;
            color: #a33;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        footer {
            text-align: center;
            padding: 15px;
            margin-top: 2rem;
            color: #777;
        }
    </style>
</head>
<body>
    <header>
        <h1>Agregar nuevo producto</h1>
    </header>

    <div class="container">
        @if ($errors->any())
            <div class="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.productos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label for="nombre">Nombre del producto</label>
            <input type="text" name="nombre" id="nombre" required>

            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" rows="3"></textarea>

            <label for="precio">Precio ($ MXN)</label>
            <input type="number" name="precio" id="precio" step="0.01" required>

            <label for="categoria_id">Categoría</label>
            <select name="categoria_id" id="categoria_id">
                <option value="">Seleccione una categoría</option>
                @foreach(App\Models\Categoria::all() as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                @endforeach
            </select>

            <label for="imagen">Imagen del producto</label>
            <input type="file" name="imagen" id="imagen" accept="image/*">

            <div style="display: flex; justify-content: space-between; margin-top: 1rem;">
                <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-success">Guardar producto</button>
            </div>
        </form>
    </div>

    <footer>
        © {{ date('Y') }} Panadería y Pastelería Dayane — Todos los derechos reservados
    </footer>
</body>
</html>
