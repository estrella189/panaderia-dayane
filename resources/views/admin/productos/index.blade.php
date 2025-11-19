<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Gestión de Productos</title>

  <style>
    body{
      margin:0;
      font-family:'Trebuchet MS', sans-serif;
      background:#f5f5f5;
      color:#333;
    }
    header{
      background:#8b5e3c;
      padding:20px;
      color:#fff;
      text-align:center;
      font-size:26px;
      font-weight:bold;
    }
    .container{
      max-width:1100px;
      margin:30px auto;
      background:#fff;
      padding:20px;
      border-radius:12px;
      box-shadow:0 6px 20px rgba(0,0,0,.1);
    }
    .top-bar{
      display:flex;
      justify-content:space-between;
      align-items:center;
      margin-bottom:20px;
    }
    .btn{
      background:#8b5e3c;
      color:#fff;
      padding:10px 16px;
      border-radius:8px;
      text-decoration:none;
    }
    table{
      width:100%;
      border-collapse:collapse;
    }
    th,td{
      padding:12px;
      border-bottom:1px solid #ddd;
      text-align:left;
    }
    tr:hover{
      background:#f5ece5;
    }
    img.thumb{
      width:70px;
      height:70px;
      object-fit:cover;
      border-radius:8px;
      border:1px solid #ccc;
    }

    /* Responsive */
    @media(max-width:768px){
      table,thead,tbody,th,td,tr{
        display:block;
      }
      tr{
        margin-bottom:18px;
      }
    }
  </style>
</head>

<body>

<header>Gestión de Productos</header>

<div class="container">

  <div class="top-bar">
    <h2 style="margin:0">Listado de Productos</h2>
    <a href="{{ route('admin.productos.create') }}" class="btn">+ Agregar Producto</a>
  </div>

  <table>
    <thead>
      <tr>
        <th>Imagen</th>
        <th>Nombre</th>
        <th>Subcategoría</th>
        <th>Acciones</th>
      </tr>
    </thead>

    <tbody>
      @foreach($productos as $p)
      <tr>
        <td>
          <img src="{{ asset($p->imagen) }}" class="thumb">
        </td>
        <td>{{ $p->nombre }}</td>
        <td>{{ $p->subcategoria->nombre }}</td>

        <td>
          <a href="{{ route('admin.productos.edit', $p->id) }}" class="btn">Editar</a>

          <form action="{{ route('admin.productos.destroy', $p->id) }}"
                method="POST"
                style="display:inline-block">
            @csrf
            @method('DELETE')
            <button class="btn" style="background:#b34747"
                    onclick="return confirm('¿Eliminar producto?')">Eliminar</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

</div>

</body>
</html>
