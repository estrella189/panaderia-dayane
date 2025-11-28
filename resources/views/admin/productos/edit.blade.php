<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Editar Producto</title>

  <style>
    :root{
      --cafe:#8b5e3c;
      --cafe-oscuro:#6d4628;
      --bg:#f5f2ee;
      --card:#ffffff;
      --borde:#e0d5c9;
      --texto:#3a2a1c;
      --muted:#7a6a5b;
    }

    *{box-sizing:border-box;}

    body{
      margin:0;
      font-family:'Trebuchet MS',system-ui,sans-serif;
      background:var(--bg);
      color:var(--texto);
    }

    header{
      background:var(--cafe);
      color:#fff;
      padding:14px 16px;
      text-align:center;
      font-size:20px;
      font-weight:700;
    }

    .wrapper{
      max-width:780px;
      margin:24px auto 32px;
      padding:0 14px;
    }

    .card{
      background:var(--card);
      border-radius:14px;
      padding:20px 18px 22px;
      border:1px solid var(--borde);
      box-shadow:0 8px 18px rgba(0,0,0,.08);
    }

    .card h2{
      margin:0 0 10px;
      font-size:18px;
      color:var(--cafe-oscuro);
      text-align:center;
    }

    .card p.sub{
      margin:0 0 18px;
      text-align:center;
      font-size:13px;
      color:var(--muted);
    }

    label{
      display:block;
      margin-top:12px;
      font-size:14px;
      font-weight:600;
      color:var(--cafe-oscuro);
    }

    select,
    input[type="text"],
    input[type="number"],
    input[type="file"],
    textarea{
      width:100%;
      margin-top:5px;
      padding:10px;
      border-radius:10px;
      border:1px solid var(--borde);
      font-size:14px;
      background:#fff;
      color:var(--texto);
    }

    textarea{
      min-height:90px;
      resize:vertical;
    }

    select:focus,
    input:focus,
    textarea:focus{
      outline:none;
      border-color:var(--cafe);
    }

    .preview{
      width:150px;
      border-radius:10px;
      margin-top:8px;
      border:1px solid var(--borde);
    }

    .no-img{
      margin-top:6px;
      font-size:13px;
      color:var(--muted);
    }

    .buttons{
      margin-top:20px;
      display:flex;
      flex-wrap:wrap;
      gap:10px;
      justify-content:center;
    }

    .btn{
      display:inline-block;
      padding:10px 18px;
      border-radius:999px;
      font-size:14px;
      font-weight:600;
      text-decoration:none;
      border:none;
      cursor:pointer;
      transition:.15s ease;
    }

    .btn-primary{
      background:var(--cafe);
      color:#fff;
    }
    .btn-primary:hover{
      background:var(--cafe-oscuro);
    }

    .btn-secondary{
      background:#e5ddd5;
      color:var(--texto);
    }
    .btn-secondary:hover{
      background:#d8ccc0;
    }

    @media(max-width:600px){
      .card{
        padding:16px 14px 18px;
      }
    }
  </style>
</head>

<body>

<header>Editar Producto</header>

<div class="wrapper">
  <div class="card">
    <h2>Modificar producto</h2>
    <p class="sub">Actualiza la categoría, nombre, descripción, precio e imagen del producto.</p>

    <form method="POST"
          action="{{ route('admin.productos.update', $producto->id) }}"
          enctype="multipart/form-data">

      @csrf
      @method('PUT')

      <!-- Categoría -->
      <label for="categoria">Categoría</label>
      <select id="categoria">
        @foreach($categorias as $cat)
          <option value="{{ $cat->id }}"
            {{ $producto->subcategoria->id_categoria == $cat->id ? 'selected' : '' }}>
            {{ $cat->nombre }}
          </option>
        @endforeach
      </select>

      <!-- Subcategoría -->
      <label for="subcategoria">Subcategoría</label>
      <select name="id_subcategoria" id="subcategoria">
        @foreach($subcategorias as $sub)
          <option value="{{ $sub->id }}"
            {{ $producto->id_subcategoria == $sub->id ? 'selected' : '' }}>
            {{ $sub->nombre }}
          </option>
        @endforeach
      </select>

      <!-- Nombre -->
      <label for="nombre">Nombre del producto</label>
      <input
        type="text"
        id="nombre"
        name="nombre"
        value="{{ old('nombre', $producto->nombre) }}"
        required
      >

      <!-- Precio -->
      <label for="precio">Precio (solo para panes con precio)</label>
      <input
        type="number"
        step="0.01"
        min="0"
        id="precio"
        name="precio"
        value="{{ old('precio', $producto->precio) }}"
        placeholder="Ejemplo: 10.00"
      >

      <!-- Descripción -->
      <label for="descripcion">Descripción</label>
      <textarea id="descripcion" name="descripcion">{{ old('descripcion', $producto->descripcion) }}</textarea>

      <!-- Imagen actual -->
      <label>Imagen actual</label>
      @if($producto->imagen)
        <img src="{{ asset($producto->imagen) }}" alt="Imagen actual" class="preview">
      @else
        <div class="no-img">Este producto no tiene imagen registrada.</div>
      @endif

      <!-- Nueva imagen -->
      <label for="imagen">Nueva imagen</label>
      <input type="file" id="imagen" name="imagen">

      <div class="buttons">
        <button class="btn btn-primary" type="submit">Guardar cambios</button>
        <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary">Cancelar</a>
      </div>

    </form>
  </div>
</div>

<script>
document.getElementById('categoria').addEventListener('change', function() {
  fetch('/subcategorias/' + this.value)
    .then(res => res.json())
    .then(data => {
      let opciones = '';
      data.forEach(function(s){
        opciones += `<option value="${s.id}">${s.nombre}</option>`;
      });
      document.getElementById('subcategoria').innerHTML = opciones;
    });
});
</script>

</body>
</html>
