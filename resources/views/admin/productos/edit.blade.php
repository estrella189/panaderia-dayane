<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Producto</title>

  <style>
    body{
      font-family:'Trebuchet MS',sans-serif;
      background:#f9f9f9;
      margin:0;
    }
    header{
      background:#8b5e3c;
      padding:20px;
      color:#fff;
      text-align:center;
      font-size:26px;
    }
    .container{
      max-width:700px;
      margin:30px auto;
      background:#fff;
      padding:24px;
      border-radius:12px;
      box-shadow:0 6px 20px rgba(0,0,0,.1);
    }
    label{
      display:block;
      margin-bottom:10px;
      font-weight:bold;
    }
    select,input,textarea{
      width:100%;
      padding:10px;
      margin-top:6px;
      border-radius:8px;
      border:1px solid #ccc;
    }
    .btn{
      background:#8b5e3c;
      color:#fff;
      padding:12px 18px;
      border-radius:8px;
      display:inline-block;
      text-decoration:none;
      margin-top:18px;
    }
    .btn-secondary{
      background:#555;
    }
    img.preview{
      width:160px;
      border-radius:8px;
      margin-top:12px;
      border:1px solid #ccc;
    }
  </style>
</head>

<body>

<header>Editar Producto</header>

<div class="container">

  <form method="POST"
        action="{{ route('admin.productos.update', $producto->id) }}"
        enctype="multipart/form-data">

    @csrf
    @method('PUT')

    {{-- CATEGORÍA --}}
    <label>Categoría:
      <select id="categoria">
        @foreach($categorias as $cat)
          <option value="{{ $cat->id }}"
            {{ $producto->subcategoria->id_categoria == $cat->id ? 'selected' : '' }}>
            {{ $cat->nombre }}
          </option>
        @endforeach
      </select>
    </label>

    {{-- SUBCATEGORÍA --}}
    <label>Subcategoría:
      <select name="id_subcategoria" id="subcategoria">
        @foreach($subcategorias as $sub)
          <option value="{{ $sub->id }}"
            {{ $producto->id_subcategoria == $sub->id ? 'selected' : '' }}>
            {{ $sub->nombre }}
          </option>
        @endforeach
      </select>
    </label>

    {{-- NOMBRE --}}
    <label>Nombre del producto:
      <input type="text" name="nombre" value="{{ $producto->nombre }}" required>
    </label>

    {{-- DESCRIPCIÓN --}}
    <label>Descripción:
      <textarea name="descripcion">{{ $producto->descripcion }}</textarea>
    </label>

    {{-- IMAGEN ACTUAL --}}
    <label>Imagen actual:</label>
    @if($producto->imagen)
      <img src="{{ asset($producto->imagen) }}" class="preview">
    @else
      <p>No tiene imagen</p>
    @endif

    {{-- CAMBIAR IMAGEN --}}
    <label>Nueva imagen:
      <input type="file" name="imagen">
    </label>

    <button class="btn" type="submit">Guardar cambios</button>
    <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary">Cancelar</a>

  </form>

</div>

<script>
document.getElementById('categoria').addEventListener('change', function() {
  fetch('/subcategorias/' + this.value)
    .then(res => res.json())
    .then(data => {
      let opciones = '';
      data.forEach(s => {
        opciones += `<option value="${s.id}">${s.nombre}</option>`;
      });
      document.getElementById('subcategoria').innerHTML = opciones;
    });
});
</script>

</body>
</html>
