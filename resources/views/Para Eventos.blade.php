<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="icon" href="icono.png" type="image/png">
  <title>Pasteles para Eventos</title>
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

    /* Header */
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

    /* Navegación */
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
    }

    /* Galería */
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
    /* ====== Tablets ====== */
@media (max-width: 992px) {
  header { padding: 22px 14px; }
  header h1 { gap: 10px; font-size: clamp(20px, 3vw, 30px); }
  header h1 img { width: 40px; }

  nav { padding: 8px 6px; }
  nav a { padding: 8px 14px; font-size: 16px; margin: 4px; }

  main { margin: 22px auto 48px; padding: 0 14px; }

  section.products {
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 18px;
  }

  .product-card img { height: 240px; }
}

/* ====== Celulares grandes ====== */
@media (max-width: 768px) {
  header { padding: 18px 12px; }
  header h1 { font-size: 20px; gap: 8px; }
  header h1 img { width: 34px; }

  nav { padding: 8px 6px; }
  nav a { padding: 8px 12px; margin: 4px; font-size: 15px; }

  main { margin: 18px auto 40px; padding: 0 12px; }

  section.products {
    grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
    gap: 16px;
  }

  .product-card { border-radius: 18px; }
  .product-card img { height: 210px; padding: 8px; }
}

/* ====== Celulares pequeños ====== */
@media (max-width: 480px) {
  header h1 { font-size: 18px; gap: 6px; flex-direction: column; }
  header h1 img { width: 28px; }

  nav a { padding: 7px 10px; font-size: 14px; margin: 3px; }

  section.products {
    grid-template-columns: 1fr;  /* una columna para ver bien cada pastel */
    gap: 14px;
  }

  .product-card img { height: 180px; }
}
/* 🔸 Mantiene los iconos del header siempre en línea */
header h1 {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: row !important; /* fuerza que siempre estén en fila */
  gap: 8px;
}

  </style>
</head>
<body>
  <!-- Header -->
  <header>
    <h1>
      <img src="pastel.png" alt="Pastel">
      Pasteles para Eventos - Dayane
      <img src="icono.png" alt="Icono">
    </h1>
  </header>

  <!-- Nav -->
  <nav>
    <a href="index.html">Inicio</a>
    <a href="productos.html">Productos</a>
  </nav>

  <!-- Galería -->
  <main>
    <section class="products">
      <article class="product-card"><img src="boda.jpg" alt=""></article>
      <article class="product-card"><img src="evento.jpg" alt=""></article>
      <article class="product-card"><img src="evento2.jpg" alt=""></article>
      <article class="product-card"><img src="fiesta.jpg" alt=""></article>
      <article class="product-card"><img src="fest3.jpg" alt=""></article>
      <article class="product-card"><img src="fiesta2.jpg" alt=""></article>
      <article class="product-card"><img src="aniversario.jpg" alt=""></article>
      <article class="product-card"><img src="quequitos.jpg" alt=""></article>
      <article class="product-card"><img src="evento3.jpg" alt=""></article>
      <article class="product-card"><img src="evento4.jpg" alt=""></article>
      <article class="product-card"><img src="evento5.jpg" alt=""></article>
      <article class="product-card"><img src="evento6.jpg" alt=""></article>
      <article class="product-card"><img src="evento7.jpg" alt=""></article>
      <article class="product-card"><img src="evento8.jpg" alt=""></article>
      <article class="product-card"><img src="evento9.jpg" alt=""></article>
      <article class="product-card"><img src="evento10.jpg" alt=""></article>
      <article class="product-card"><img src="evento11.jpg" alt=""></article>
      <article class="product-card"><img src="evento12.jpg" alt=""></article>
      <article class="product-card"><img src="evento13.jpg" alt=""></article>
      <article class="product-card"><img src="evento14.jpg" alt=""></article>
      <article class="product-card"><img src="evento15.jpg" alt=""></article>
      <article class="product-card"><img src="felicidadesalan.jpg" alt=""></article>
      <article class="product-card"><img src="felicidadesian.jpg" alt=""></article>
      <article class="product-card"><img src="felizcumplerosasazulles.jpg" alt=""></article>
      <article class="product-card"><img src="felizcumple.jpg" alt=""></article>
      <article class="product-card"><img src="pastel de pony.jpg" alt=""></article>
      <article class="product-card"><img src="pstelbely.jpg" alt=""></article>
      <article class="product-card"><img src="quequitos colores.jpg" alt=""></article>
      <article class="product-card"><img src="pastelfrozen.jpg" alt=""></article>
      <article class="product-card"><img src="pastelmasha_oso.jpg" alt=""></article>
    </section>
  </main>
</body>
</html>
