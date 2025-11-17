<!DOCTYPE html>
<html>
<head>
    <title>Editar Producto</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        input, textarea, select { width: 100%; padding: 8px; margin-bottom: 15px; }
        button { padding: 10px; background: blue; color: white; border: none; }
    </style>
</head>
<body>

<h1>Editar Producto</h1>

<form action="{{ route('admin.productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label>Categoría:</label>
    <select id="categoria">
        @foreach($categorias as $cat)
            <option value="{{ $cat->id }}"
                {{ $cat->id == $producto->subcategoria->id_categoria ? 'selected' : '' }}>
                {{ $cat->nombre }}
            </option>
        @endforeach
    </select>

    <label>Subcategoría:</label>
    <select name="id_subcategoria" id="subcategoria"></select>

    <label>Nombre:</label>
    <input type="text" name="nombre" value="{{ $producto->nombre }}">

    <label>Descripción:</label>
    <textarea name="descripcion">{{ $producto->descripcion }}</textarea>

    <label>Imagen actual:</label><br>
    @if($producto->imagen)
        <img src="/imagenes/{{ $producto->imagen }}" width="100"><br><br>
    @endif

    <label>Nueva imagen (opcional):</label>
    <input type="file" name="imagen">

    <button type="submit">Actualizar</button>
</form>

<script>
let categoriaId = document.getElementById('categoria').value;
let subcategoriaActual = "{{ $producto->id_subcategoria }}";

fetch('/api/subcategorias/' + categoriaId)
    .then(res => res.json())
    .then(data => {
        let sub = document.getElementById('subcategoria');
        sub.innerHTML = '';

        data.forEach(s => {
            let selected = (s.id == subcategoriaActual) ? 'selected' : '';
            sub.innerHTML += `<option value="${s.id}" ${selected}>${s.nombre}</option>`;
        });
    });

document.getElementById('categoria').addEventListener('change', function() {
    fetch('/api/subcategorias/' + this.value)
        .then(res => res.json())
        .then(data => {
            let sub = document.getElementById('subcategoria');
            sub.innerHTML = '';

            data.forEach(s => {
                sub.innerHTML += `<option value="${s.id}">${s.nombre}</option>`;
            });
        });
});
</script>

</body>
</html>
