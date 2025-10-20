<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="icon" href="{{ asset('img/pasteles/iconos/icono.png') }}" type="image/png">
  <title>Rollos y Variedades - Dayane</title>
  <style>
    :root{
      --cafe-oscuro:#8b5e3c;
      --cafe-medio:#a97e5a;
      --texto:#333;
      --bg:#f5f5f5;
      --sombra:0 8px 24px rgba(0,0,0,.12);
      --sombra-hover:0 14px 30px rgba(0,0,0,.16);
      --radius-xl:24px;
    }
    *{box-sizing:border-box}
    body{
      margin:0;
      font-family:'Trebuchet MS','Lucida Sans Unicode','Lucida Grande','Lucida Sans',Arial,sans-serif;
      background:#f9f6f3;
      color:var(--texto);
    }
    header{
      background:linear-gradient(135deg,#956644,#7b5436);
      color:#fff;
      padding:28px 18px;
      display:flex;
      justify-content:center;
      align-items:center;
      text-align:center;
      box-shadow:var(--sombra);
    }
    header h1{
      margin:0;
      font-size:clamp(22px,3.2vw,36px);
      display:flex;
      align-items:center;
      gap:12px;
      font-weight:700;
    }
    nav{
      background:var(--cafe-medio);
      padding:10px 0;
      box-shadow:var(--sombra);
      text-align:center;
    }
    nav a{
      text-decoration:none;
      color:#fff;
      padding:10px 18px;
      font-size:18px;
      border-radius:999px;
      transition:.2s;
      display:inline-block;
      margin:0 6px;
    }
    nav a:hover{background-color:rgba(255,255,255,.15);}
    main{max-width:1100px;margin:28px auto 60px;padding:0 16px;}
    section.products{
      display:grid;
      grid-template-columns:repeat(auto-fit,minmax(240px,1fr));
      gap:22px;
      padding:18px 0;
    }
    .product-card{
      background:#fff;
      border-radius:var(--radius-xl);
      overflow:hidden;
      box-shadow:var(--sombra);
      transition:.2s;
    }
    .product-card:hover{
      transform:translateY(-4px);
      box-shadow:var(--sombra-hover);
    }
    .product-card img{
      width:100%;
      height:280px;
      object-fit:contain;
      background-color:#fff;
      padding:10px;
      border-bottom:1px solid #eee;
    }
    .card-body{padding:14px 14px 18px;display:grid;gap:10px;}
    .btn{padding:10px 14px;border-radius:999px;border:none;color:#fff;background:#8b5e3c;cursor:pointer;}
    .input,.select{width:100%;padding:8px;border:1px solid #ddd;border-radius:10px;}
    @media (max-width:992px){
      header{padding:22px 14px}
      header h1{gap:10px;font-size:clamp(20px,3vw,30px)}
      nav{padding:8px 6px}
      nav a{padding:8px 14px;font-size:16px;margin:4px}
      main{margin:22px auto 48px;padding:0 14px}
      section.products{grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:18px}
      .product-card img{height:240px}
    }
    @media (max-width:768px){
      header{padding:18px 12px}
      header h1{font-size:20px;gap:8px}
      nav{padding:8px 6px;overflow-x:auto;white-space:nowrap}
      nav a{display:inline-block;padding:8px 12px;margin:4px;font-size:15px}
      main{margin:18px auto 40px;padding:0 12px}
      section.products{grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:16px}
      .product-card{border-radius:18px}
      .product-card img{height:210px;padding:8px}
    }
    @media (max-width:480px){
      header h1{font-size:18px;gap:6px;flex-direction:row !important}
      header h1 img{width:28px}
      nav a{padding:7px 10px;font-size:14px;margin:3px}
      section.products{grid-template-columns:1fr;gap:14px}
      .product-card img{height:180px}
    }
  </style>
</head>
<body>
  <header>
    <h1>Rollos y Variedades - Dayane</h1>
  </header>

  <nav>
    <a href="{{ url('index.html') }}">Inicio</a>
    <a href="{{ url('productos.html') }}">Productos</a>
  </nav>

  <main>
    <section class="products">
      @php
        // coloca estas imágenes en public/img/pasteles/rollos/
        $items = [
          ['img'=>'fresa_nuez.jpg','nombre'=>'Rollo de Fresa con Nuez'],
          ['img'=>'rollo de mango.jpg','nombre'=>'Rollo de Durazno'],
            
      
        ];
      @endphp

      @foreach($items as $it)
      <article class="product-card">
        <img src="{{ asset('img/pasteles/rollos/' . $it['img']) }}" alt="{{ $it['nombre'] }}">
        <div class="card-body">
          <h3 style="margin:0">{{ $it['nombre'] }}</h3>
          @auth
          <form method="POST" action="{{ route('pedidos.crear_rapido') }}" style="display:grid;gap:8px">
            @csrf
            <input type="hidden" name="producto_nombre" value="{{ $it['nombre'] }}">
            <label>Cantidad <input class="input" type="number" name="cantidad" min="1" value="1" required></label>
            <label>Fecha de entrega <input class="input" type="date" name="fecha_entrega"></label>
            <label>Mensaje (opcional) <input class="input" type="text" name="mensaje_pastel" maxlength="255"></label>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px">
              <label>Tamaño
                <select class="select" name="tamano"><option value="">—</option><option>Chico</option><option>Mediano</option><option>Grande</option></select>
              </label>
              <label>Sabor
                <select class="select" name="sabor"><option value="">—</option><option>Chocolate</option><option>Vainilla</option><option>Fresa</option><option>Nuez</option></select>
              </label>
            </div>
            <button class="btn" type="submit">Pedir este rollo</button>
          </form>
          @else
            <a href="{{ route('login') }}" class="btn" style="display:inline-block;text-decoration:none;text-align:center">Inicia sesión para pedir</a>
          @endauth
        </div>
      </article>
      @endforeach
    </section>
  </main>
</body>
</html>
