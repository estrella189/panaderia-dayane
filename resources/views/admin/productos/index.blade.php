<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Gestión de Productos</title>

  <style>
    :root{
      --cafe:#5b331c;
      --cafe-2:#9a5a30;
      --cafe-3:#d48a4a;
      --bg1:#fff3e2;
      --bg2:#f0d3bb;
      --card:#ffffff;
      --rojo:#d04646;
      --rojo-hover:#aa2f2f;
      --texto:#2f1e14;
      --muted:#7a6757;
      --line:#e3cdb8;
      --badge:#f9e1c7;
    }

    *{box-sizing:border-box;}

    body{
      margin:0;
      font-family:'Trebuchet MS', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      background:
        radial-gradient(1100px 700px at 12% -5%, #ffe0c0 0, #fff7f0 32%, #f6ddc9 60%),
        linear-gradient(180deg, var(--bg1), var(--bg2));
      color:var(--texto);
      min-height:100vh;
    }

    /* ===== TOP BAR ===== */
    header{
      background:linear-gradient(135deg, #5b331c, #9a5a30);
      padding:14px 18px;
      color:#fff;
      box-shadow:0 10px 26px rgba(0,0,0,.28);
      position:sticky;
      top:0;
      z-index:50;
    }
    .header-inner{
      max-width:1120px;
      margin:0 auto;
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap:12px;
      flex-wrap:wrap;
    }
    .brand{
      display:flex;
      align-items:center;
      gap:10px;
    }
    .brand-logo{
      width:40px;
      height:40px;
      border-radius:14px;
      background:radial-gradient(circle at 30% 20%, #fff 0, #ffe7cf 35%, transparent 70%);
      display:flex;
      align-items:center;
      justify-content:center;
      font-size:22px;
      box-shadow:0 8px 22px rgba(0,0,0,.35);
    }
    .brand-text h1{
      margin:0;
      font-size:clamp(20px,2.7vw,24px);
      letter-spacing:.6px;
    }
    .brand-text span{
      font-size:12px;
      opacity:.92;
    }

    .header-badge{
      padding:6px 12px;
      border-radius:999px;
      font-size:12px;
      background:rgba(255,255,255,.16);
      border:1px solid rgba(255,255,255,.4);
      display:inline-flex;
      align-items:center;
      gap:6px;
      backdrop-filter:blur(6px);
      -webkit-backdrop-filter:blur(6px);
    }
    .header-badge strong{
      font-weight:700;
    }

    /* ===== CONTENEDOR PRINCIPAL ===== */
    .wrapper{
      max-width:1120px;
      margin:26px auto 40px;
      padding:0 16px;
    }

    .card{
      background:var(--card);
      border-radius:24px;
      padding:22px 22px 26px;
      box-shadow:0 22px 50px rgba(56,28,11,.32);
      border:1px solid rgba(255,255,255,.7);
      position:relative;
      overflow:hidden;
    }

    /* Glow decorativo */
    .card::before{
      content:"";
      position:absolute;
      width:260px;
      height:260px;
      border-radius:50%;
      background:radial-gradient(circle at 30% 20%, rgba(255,255,255,.95), rgba(255,255,255,0));
      top:-120px;
      right:-60px;
      opacity:.9;
      pointer-events:none;
    }
    .card::after{
      content:"";
      position:absolute;
      width:220px;
      height:220px;
      border-radius:50%;
      background:radial-gradient(circle at 10% 80%, rgba(250,207,154,.9), rgba(250,207,154,0));
      bottom:-110px;
      left:-40px;
      opacity:.7;
      pointer-events:none;
    }

    .card-inner{
      position:relative;
      z-index:5;
    }

    .card-header{
      display:flex;
      justify-content:space-between;
      align-items:flex-start;
      gap:14px;
      margin-bottom:18px;
      flex-wrap:wrap;
    }

    .title-block{
      display:flex;
      align-items:flex-start;
      gap:10px;
    }
    .title-icon{
      width:36px;
      height:36px;
      border-radius:14px;
      background:linear-gradient(135deg,#fbe4c9,#f7c18b);
      display:flex;
      align-items:center;
      justify-content:center;
      font-size:20px;
      box-shadow:0 8px 20px rgba(0,0,0,.16);
    }
    .title-block h2{
      margin:0;
      font-size:21px;
      color:var(--cafe);
    }
    .title-block p{
      margin:3px 0 0;
      font-size:13px;
      color:var(--muted);
    }

    .mini-stats{
      display:flex;
      gap:8px;
      margin-top:8px;
      flex-wrap:wrap;
    }
    .pill{
      font-size:11px;
      padding:4px 10px;
      border-radius:999px;
      border:1px solid #edd3b8;
      background:rgba(255,248,239,.9);
      display:inline-flex;
      align-items:center;
      gap:6px;
      color:#765237;
    }
    .pill strong{
      font-size:12px;
      color:var(--cafe);
    }

    .actions-header{
      display:flex;
      gap:10px;
      flex-wrap:wrap;
      justify-content:flex-end;
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
      background:linear-gradient(135deg,#5b331c,#9a5a30);
      color:#fff;
      box-shadow:0 10px 26px rgba(52,24,8,.65);
    }
    .btn:hover{
      background:linear-gradient(135deg,#482415,#834722);
      transform:translateY(-1px);
      box-shadow:0 13px 30px rgba(52,24,8,.8);
    }

    .btn-sec{
      background:rgba(255,255,255,.8);
      color:#5a4a3a;
      border:1px solid #dec8b4;
      backdrop-filter:blur(4px);
      -webkit-backdrop-filter:blur(4px);
    }
    .btn-sec:hover{
      background:#f3e3d3;
    }

    .icon{
      font-size:15px;
    }

    /* ===== TABLA ===== */
    .table-wrap{
      margin-top:6px;
      border-radius:18px;
      overflow:hidden;
      border:1px solid #f1e1d2;
      background:#fff;
    }

    table{
      width:100%;
      border-collapse:collapse;
      background:#fff;
    }
    thead{
      background:linear-gradient(90deg,#5b331c,#9a5a30,#d48a4a);
      color:#fff;
    }
    th,td{
      padding:12px 12px;
      font-size:14px;
      text-align:left;
    }
    th{
      font-weight:600;
      letter-spacing:.4px;
      text-transform:uppercase;
      font-size:12px;
    }
    tbody tr:nth-child(even){
      background:#fdf6ef;
    }
    tbody tr:hover{
      background:#f7ebdd;
    }

    th:nth-child(1),
    td:nth-child(1){
      width:110px;
    }
    th:nth-child(4),
    td:nth-child(4){
      width:210px;
    }

    .thumb{
      width:72px;
      height:72px;
      border-radius:16px;
      object-fit:cover;
      border:1px solid #e1d2c3;
      box-shadow:0 5px 14px rgba(0,0,0,.16);
      background:#fff;
    }

    .no-img{
      width:72px;
      height:72px;
      border-radius:16px;
      border:1px dashed #d3c3b4;
      display:flex;
      align-items:center;
      justify-content:center;
      font-size:11px;
      color:#a08971;
      background:#fffdf9;
      text-align:center;
      padding:4px;
    }

    .nombre{
      font-weight:700;
      display:block;
      color:var(--cafe);
    }
    .descripcion{
      font-size:12px;
      color:var(--muted);
      margin-top:3px;
      max-width:320px;
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
      justify-content:flex-end;
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

    /* ===== VACÍO ===== */
    .empty{
      text-align:center;
      padding:26px 16px;
      font-size:14px;
      color:var(--muted);
    }

    /* ===== RESPONSIVO ===== */
    @media (max-width:900px){
      .card-header{
        flex-direction:column;
        align-items:flex-start;
      }
      .actions-header{
        width:100%;
        justify-content:flex-start;
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
        border-radius:18px;
        padding:12px 12px 10px;
        box-shadow:0 12px 28px rgba(0,0,0,.14);
        border:1px solid #f1e1d2;
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
  <div class="header-inner">
    <div class="brand">
      <div class="brand-logo">🥐</div>
      <div class="brand-text">
        <h1>Gestión de Productos</h1>
        <span>Administra los pasteles visibles en el catálogo de Dayane</span>
      </div>
    </div>

    <div class="header-badge">
      📦 <span>Productos registrados:</span>
      <strong>{{ $productos->count() }}</strong>
    </div>
  </div>
</header>

<div class="wrapper">
  <div class="card">
    <div class="card-inner">

      <div class="card-header">
        <div class="title-block">
          <div class="title-icon">🍰</div>
          <div>
            <h2>Listado de Productos</h2>
            <p>Desde aquí puedes agregar, editar o eliminar productos del catálogo.</p>

            <div class="mini-stats">
              <span class="pill">
                🧁 <span>Catálogo activo</span>
              </span>
              <span class="pill">
                🎨 <span>Organiza por subcategoría para mantener ordenado el menú.</span>
              </span>
            </div>
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
        @if($productos->isEmpty())
          <div class="empty">
            Aún no tienes productos registrados.  
            Usa el botón <strong>“Agregar Producto”</strong> para crear el primero.
          </div>
        @else
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
                <td data-label="Imagen">
                  @if($p->imagen)
                    <img src="{{ asset($p->imagen) }}" alt="{{ $p->nombre }}" class="thumb">
                  @else
                    <div class="no-img">
                      Sin imagen
                    </div>
                  @endif
                </td>

                <td data-label="Nombre">
                  <span class="nombre">{{ $p->nombre }}</span>
                  @if($p->descripcion)
                    <div class="descripcion">
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
        @endif
      </div>

    </div>
  </div>
</div>

</body>
</html>
