<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Panel — Gestión de Productos</title>

  <style>
    :root{
      --cafe:#8b5e3c;
      --cafe2:#a97e5a;
      --cafe-suave:#f4e4d3;
      --bg:#f7f3ee;
      --card:#ffffff;
      --rojo:#c94b4b;
      --rojo-hover:#aa3434;
      --texto:#3a281c;
    }

    *{box-sizing:border-box;}

    body{
      margin:0;
      font-family:'Trebuchet MS', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      background:var(--bg);
      color:var(--texto);
    }

    /* Barra superior */
    header{
      background:linear-gradient(135deg, #956644, #7b5436);
      padding:22px 18px;
      color:#fff;
      text-align:center;
      box-shadow:0 6px 18px rgba(0,0,0,.18);
    }
    header h1{
      margin:0;
      font-size:clamp(22px,3vw,30px);
      letter-spacing:.5px;
    }
    header span{
      font-size:14px;
      opacity:.9;
    }

    /* Tarjeta principal */
    .wrapper{
      max-width:1120px;
      margin:26px auto 40px;
      padding:0 16px;
    }
    .card{
      background:var(--card);
      border-radius:22px;
      padding:24px 22px 26px;
      box-shadow:0 14px 40px rgba(0,0,0,.12);
      border:1px solid #f0dfcf;
    }

    .card-header{
      display:flex;
      justify-content:space-between;
      align-items:flex-start;
      gap:14px;
      margin-bottom:18px;
    }

    .title-block{
      display:flex;
      align-items:center;
      gap:10px;
    }
    .title-icon{
      width:26px;
      height:26px;
      border-radius:9px;
      background:var(--cafe-suave);
      display:flex;
      align-items:center;
      justify-content:center;
      font-size:18px;
    }
    .title-block h2{
      margin:0;
      font-size:22px;
    }
    .title-block p{
      margin:2px 0 0;
      font-size:13px;
      color:#7a6757;
    }

    .actions-header{
      display:flex;
      gap:10px;
      flex-wrap:wrap;
    }

    .btn,
    .btn-sec{
      border:none;
      border-radius:999px;
      padding:9px 16px;
      font-size:14px;
      cursor:pointer;
      text-decoration:none;
      display:inline-flex;
      align-items:center;
      gap:6px;
      font-weight:600;
      transition:.18s ease-in-out;
      white-space:nowrap;
    }

    .btn{
      background:var(--cafe);
      color:#fff;
      box-shadow:0 6px 16px rgba(139,94,60,.35);
    }
    .btn:hover{
      background:#70492f;
      transform:translateY(-1px);
      box-shadow:0 10px 22px rgba(139,94,60,.5);
    }

    .btn-sec{
      background:#f1ebe4;
      color:#5a4a3a;
      border:1px solid #e1d2c3;
    }
    .btn-sec:hover{
      background:#e5d4c1;
    }

    .tag{
      font-size:11px;
      padding:3px 9px;
      border-radius:999px;
      background:#fff6ec;
      color:#9a6a3b;
      border:1px solid #f1ddc5;
      margin-left:4px;
    }

    /* Tabla */
    .table-wrap{
      margin-top:10px;
      border-radius:18px;
      overflow:hidden;
      border:1px solid #f1e1d2;
    }

    table{
      width:100%;
      border-collapse:collapse;
      background:#fff;
    }
    thead{
      background:#e2c09a;
      color:#fff;
    }
    th,td{
      padding:14px 12px;
      font-size:14px;
      text-align:left;
    }
    th{
      font-weight:600;
      letter-spacing:.4px;
    }
    tbody tr:nth-child(even){
      background:#fdf8f3;
    }
    tbody tr:hover{
      background:#f8efe6;
    }

    .thumb{
      width:70px;
      height:70px;
      border-radius:14px;
      object-fit:cover;
      border:1px solid #e1d2c3;
      box-shadow:0 4px 10px rgba(0,0,0,.12);
      background:#fff;
    }

    .subcat-pill{
      display:inline-flex;
      align-items:center;
      gap:6px;
      padding:5px 10px;
      border-radius:999px;
      background:#fff7ef;
      border:1px solid #f1ddc5;
      font-size:12px;
      color:#7b5436;
    }
    .subcat-dot{
      width:7px;
      height:7px;
      border-radius:50%;
      background:#d27c47;
    }

    .row-actions{
      display:flex;
      gap:8px;
      flex-wrap:wrap;
    }

    .btn-small{
      padding:7px 13px;
      font-size:13px;
      box-shadow:none;
    }

    .btn-danger{
      background:var(--rojo);
    }
    .btn-danger:hover{
      background:var(--rojo-hover);
      box-shadow:0 8px 18px rgba(201,75,75,.45);
    }

    .icon{
      font-size:14px;
    }

    /* Responsivo */
    @media (max-width:900px){
      .card-header{
        flex-direction:column;
        align-items:flex-start;
      }
    }

    @media(max-width:768px){
      .table-wrap{
        border:none;
        background:transparent;
      }
      table, thead, tbody, th, td, tr{
        display:block;
      }
      thead{
        display:none;
      }
      tbody tr{
        margin-bottom:16px;
        background:#fff;
        border-radius:16px;
        padding:12px 12px 10px;
        box-shadow:0 8px 22px rgba(0,0,0,.08);
      }
      td{
        border:none;
        padding:6px 4px;
        font-size:13px;
      }
      td[data-label]::before{
        content:attr(data-label) ": ";
        font-weight:600;
        color:#7a6757;
      }
      .row-actions{
        justify-content:flex-end;
        margin-top:6px;
      }
    }
  </style>
</head>

<body>

<header>
  <h1>Panel — Gestión de Productos</h1>
  <span>Administra los pasteles que se muestran en el catálogo de Dayane</span>
</header>

<div class="wrapper">
  <div class="card">

    <div class="card-header">
      <div class="title-block">
        <div class="title-icon">🍰</div>
        <div>
          <h2>Listado de Productos</h2>
          <p>Desde aquí puedes agregar, editar o eliminar productos del catálogo.</p>
        </div>
      </div>

      <div class="actions-header">
        <a href="{{ route('admin.dashboard') }}" class="btn-sec">
          ← Volver al Panel
        </a>

        <a href="{{ route('admin.productos.create') }}" class="btn">
          <span class="icon">＋</span> Agregar Producto
        </a>
      </div>
    </div>

    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Subcategoría</th>
            <th style="width:190px">Acciones</th>
          </tr>
        </thead>

        <tbody>
          @foreach($productos as $p)
          <tr>
            <td data-label="Imagen">
              @if($p->imagen)
                <img src="{{ asset($p->imagen) }}" alt="{{ $p->nombre }}" class="thumb">
              @else
                <div style="width:70px;height:70px;border-radius:14px;border:1px dashed #d3c3b4;
                            display:flex;align-items:center;justify-content:center;font-size:11px;color:#a08971;background:#fffdf9;">
                  Sin imagen
                </div>
              @endif
            </td>

            <td data-label="Nombre">
              <strong>{{ $p->nombre }}</strong>
              @if($p->descripcion)
                <div style="font-size:12px;color:#7a6757;margin-top:3px;max-width:280px;">
                  {{ Str::limit($p->descripcion, 90) }}
                </div>
              @endif
            </td>

            <td data-label="Subcategoría">
              <span class="subcat-pill">
                <span class="subcat-dot"></span>
                {{ $p->subcategoria->nombre ?? '—' }}
              </span>
            </td>

            <td data-label="Acciones">
              <div class="row-actions">
                <a href="{{ route('admin.productos.edit', $p->id) }}" class="btn btn-small">
                  ✏️ Editar
                </a>

                <form action="{{ route('admin.productos.destroy', $p->id) }}"
                      method="POST"
                      onsubmit="return confirm('¿Eliminar este producto?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-small btn-danger">
                    🗑 Eliminar
                  </button>
                </form>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>

      </table>
    </div>

  </div>
</div>

</body>
</html>
