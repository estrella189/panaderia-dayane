<!DOCTYPE html>
<html>
<head>
    <title>Productos</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid #aaa; }
        th, td { padding: 10px; }
        a { text-decoration: none; padding:6px 10px; color:white; border-radius:4px; }
        .btn-add { background: green; }
        .btn-edit { background: orange; }
        .btn-del { background: red; }
    </style>
</head>
<body>

<h1>Productos</h1>

<a class="btn-add" href="{{ route('admin.productos.create') }}">+ Agregar</a>

<table>
<tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>Categoría</th>
    <th>Subcategoría</th>
    <th>Imagen</th>
    <th>Acciones</th>
</tr>

@foreach($productos as $p)
<tr>
    <td>{{ $p->id }}</td>
    <td>{{ $p->nombre }}</td>
    <td>{{ $p->subcategoria->categoria->nombre }}</td>
    <td>{{ $p->subcategoria->nombre }}</td>
    <td>
        @if($p->imagen)
            <img src="/imagenes/{{ $p->imagen }}" width="60">
        @endif
    </td>
    <td>
        <a class="btn-edit" href="{{ route('admin.productos.edit', $p->id) }}">Editar</a>

        <form action="{{ route('admin.productos.destroy', $p->id) }}" method="POST" style="display:inline;">
            @csrf @method('DELETE')
            <button class="btn-del" onclick="return confirm('¿Eliminar?')">Eliminar</button>
        </form>
    </td>
</tr>
@endforeach

</table>

</body>
</html>
