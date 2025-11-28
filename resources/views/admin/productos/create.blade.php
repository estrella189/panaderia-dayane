<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agregar Producto</title>

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

    *{ box-sizing:border-box; }

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

    .hint{
      font-size:12px;
      color:var(--muted);
      margin-top:4px;
      display:block;
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

<header>Agregar Producto</header>

<div class="wrapper">
  <div class="card">
    <h2>Nuevo producto</h2>
    <p class="sub">Registra la categoría, nombre, precio, descripción e imagen del producto.</p>

    <form method="POST" action="{{ route('admin.productos.store') }}" enctype="multipart/form-data">
      @csrf

      <!-- CATEGORÍA -->
      <label for="categoria">Categoría</label>
      <select id="categoria">
        <option value="">Seleccione una categoría</option>
        @foreach($categorias as $cat)
          <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
        @endforeach
      </select>

      <!-- SUBCATEGORÍA -->
      <label for="subcategoria">Subcategoría</label>
      <select name="id_subcategoria" id="subcategoria">
        <option value="">Seleccione una subcategoría</option>
      </select>

      <!-- NOMBRE -->
      <label for="nombre">Nombre del producto</label>
      <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required>

      <!-- PRECIO -->
      <label for="precio">Precio (solo para panes, bebidas, etc.)</label>
      <input
        type="number"
        step="0.01"
        min="0"
        id="precio"
        name="precio"
        value="{{ old('precio') }}"
        placeholder="Ej.: 10.00">
      <span class="hint">Deja el precio vacío si es pastel y se cotiza.</span>

      <!-- DESCRIPCIÓN -->
      <label for="descripcion">Descripción</label>
      <textarea id="descripcion" name="descripcion">{{ old('descripcion') }}</textarea>

      <!-- IMAGEN -->
      <label for="imagen">Imagen</label>
      <input type="file" id="imagen" name="imagen">

      <!-- BOTONES -->
      <div class="buttons">
        <button class="btn btn-primary" type="submit">Guardar</button>
        <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary">Cancelar</a>
      </div>

    </form>
  </div>
</div>

<script>
// Cargar subcategorías dinámicamente
document.getElementById('categoria').addEventListener('change', function() {
  fetch('/subcategorias/' + this.value)
    .then(res => res.json())
    .then(data => {
      let opciones = '<option value="">Seleccione una subcategoría</option>';
      data.forEach(s => {
        opciones += `<option value="${s.id}">${s.nombre}</option>`;
      });
      document.getElementById('subcategoria').innerHTML = opciones;
    });
});
</script>

</body>
</html>

