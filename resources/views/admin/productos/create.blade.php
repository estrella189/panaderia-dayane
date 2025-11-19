<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agregar Producto</title>

  <style>
    body{font-family:'Trebuchet MS',sans-serif;background:#f9f9f9;margin:0}
    header{background:#8b5e3c;padding:20px;color:#fff;text-align:center;font-size:26px}
    .container{
      max-width:700px;margin:30px auto;background:#fff;padding:24px;
      border-radius:12px;box-shadow:0 6px 20px rgba(0,0,0,.1);
    }
    label{display:block;margin-bottom:10px;font-weight:bold}
    select,input,textarea{
      width:100%;padding:10px;margin-top:6px;border-radius:8px;border:1px solid #ccc;
    }
    .btn{
      background:#8b5e3c;color:#fff;padding:12px 18px;border-radius:8px;
      display:inline-block;text-decoration:none;margin-top:14px;
    }
  </style>
</head>

<body>

<header>Agregar Producto</header>

<div class="container">

  <form method="POST" action="{{ route('admin.productos.store') }}" enctype="multipart/form-data">
    @csrf

    <label>Categoría:
      <select id="categoria">
        <option value="">Seleccione una categoría</option>
        @foreach($categorias as $cat)
          <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
        @endforeach
      </select>
    </label>

    <label>Subcategoría:
      <select name="id_subcategoria" id="subcategoria">
        <option value="">Seleccione una subcategoría</option>
      </select>
    </label>

    <label>Nombre del producto:
      <input type="text" name="nombre" required>
    </label>

    <label>Descripción:
      <textarea name="descripcion"></textarea>
    </label>

    <label>Imagen:
      <input type="file" name="imagen">
    </label>

    <button class="btn" type="submit">Guardar</button>
    <a href="{{ route('admin.productos.index') }}" class="btn" style="background:#555">Cancelar</a>

  </form>

</div>

<script>
document.getElementById('categoria').addEventListener('change', function() {
  fetch('/subcategorias/' + this.value)
    .then(res => res.json())
    .then(data => {
      let opciones = '<option value="">Seleccione</option>';
      data.forEach(s => {
        opciones += `<option value="${s.id}">${s.nombre}</option>`;
      });
      document.getElementById('subcategoria').innerHTML = opciones;
    });
});
</script>

</body>
</html>

