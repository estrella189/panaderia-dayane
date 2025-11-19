<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="icon" href="icono.png" type="image/png">
  <title>Pasteles de chocolate</title>
  <style>
    :root{
      --cafe-oscuro:#8b5e3c;
      --cafe-medio:#a97e5a;
      --texto:#333;
      --bg:#f5f5f5;
      --sombra: 0 8px 24px rgba(0,0,0,.12);
      --sombra-hover: 0 14px 30px rgba(0,0,0,.16);
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
      background:linear-gradient(135deg, #956644, #7b5436);
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
      font-size:clamp(22px, 3.2vw, 36px);
      display:flex;
      align-items:center;
      gap:12px;
      font-weight:700;
    }
    header h1 img{
      width:48px;
      height:auto;
    }

    nav{
      background: var(--cafe-medio);
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
    nav a:hover{
      background-color:rgba(255,255,255,.15);
    }

    main{
      max-width:1100px;
      margin:28px auto 60px;
      padding:0 16px;
      text-align:center;
    }

    section.products{
      display:grid;
      grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
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
      transform: translateY(-4px);
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

    .btn{
      display:inline-block;
      text-decoration:none;
      color:#fff;
      background:#8b5e3c;
      padding:12px 20px;
      border-radius:999px;
      font-weight:600;
      transition:.2s;
      margin:12px 6px;
      font-size:18px;
    }
    .btn:hover{
      background:#a97e5a;
    }

    @media (max-width: 768px){
      .product-card img{ height:210px; padding:8px; }
    }

    @media (max-width: 480px){
      .product-card img{ height:180px; }
    }
  </style>
</head>
<body>
  <header>
    <h1>
      <img src="pastel.png" alt="Pastel">
      Pasteles de chocolate - Dayane
      <img src="icono.png" alt="Icono">
    </h1>
  </header>

  <nav>
    <a href="index.html">Inicio</a>
    <a href="producto.html">Productos</a>
  </nav>

  <main>
    <section class="products">
      <article class="product-card">
        <img src="{{ asset('img/pasteles/chocolate/pastel de chocolate.jpg') }}" alt="">
      </article>

      <article class="product-card">
        <img src="{{ asset('img/pasteles/chocolate/1763584321.jpg') }}" alt="">
      </article>

      <article class="product-card">
        <img src="{{ asset('img/pasteles/chocolate/pastel de chocolate_cereza.jpg') }}" alt="">
      </article>

      <article class="product-card">
        <img src="{{ asset('img/pasteles/chocolate/nuezconchocolate.jpg') }}" alt="">
      </article>
    </section>

    <div>
      <a href="{{ route('login') }}" class="btn">Para pedir Iniciar sesión</a>
      <a href="{{ route('register') }}" class="btn" style="background:#a97e5a;">Regístrate</a>
    </div>
  </main>
</body>
</html>
