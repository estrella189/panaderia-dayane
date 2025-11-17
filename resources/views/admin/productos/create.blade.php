<!DOCTYPE html>
<html>
<head>
    <title>Agregar Producto</title>
</head>
<body>

<h1>Agregar Producto</h1>

<form action="{{ route('admin.productos.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label>Categoría:</label><br>
    <select id="categoria">
        <option value="">Seleccione...</option>
        @foreach($categorias as $cat)
            <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
        @endforeach
    </select><br><br>

    <label>Subcategoría:</label><br>
    <select name="id_subcategoria" id="subcategoria"></select><br><br>

    <label>Nombre:</label><br>
    <input type="text" name="nombre"><br><br>

    <label>Descripción:</label><br>
    <textarea name="descripcion"></textarea><br><br>

    <label>Imagen:</label><br>
    <input type="file" name="imagen"><br><br>

    <button>Guardar</button>
</form>

<script>
document.getElementById('categoria').addEventListener('change', function() {
    fetch('/api/subcategorias/' + this.value)
        .then(r => r.json())
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
