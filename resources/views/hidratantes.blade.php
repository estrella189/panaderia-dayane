<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="icon" href="icono.png" type="image/png">
  <title>Coca-Cola y Refrescos</title>
  <style>
    :root{
      --cafe-oscuro:#8b5e3c;
      --cafe-medio:#a97e5a;
      --texto:#333;
      --bg:#f5f5f5;
      --acento:#d2691e;
      --acento-2:#d95c18;
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
      line-height:1.45;
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

    /* Productos */
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
      text-align:center;
      transition:.2s;
    }
    .product-card:hover{
      transform: translateY(-4px);
      box-shadow:var(--sombra-hover);
    }
    .product-card img {
      width:100%;
      height:280px;
      object-fit:contain;
      background-color:#fff;
      padding:10px;
      border-bottom:1px solid #eee;
    }
    .product-content{
      padding:14px;
    }
    .product-card h3{
      color:var(--acento);
      margin:8px 0 6px;
      font-size:20px;
    }
    .price{
      font-weight:700;
      color:var(--acento-2);
      font-size:18px;
      margin:0;
    }
    /* === Responsivo (Tablets) === */
@media (max-width: 992px) {
  header {
    padding: 22px 14px;
  }

  header h1 {
    gap: 10px;
    font-size: clamp(20px, 3vw, 30px);
  }

  header h1 img {
    width: 40px;
  }

  nav a {
    padding: 8px 14px;
    font-size: 16px;
    margin: 4px;
  }

  main {
    margin: 22px auto 48px;
    padding: 0 14px;
  }

  section.products {
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 18px;
  }

  .product-card img {
    height: 240px; /* un poco más baja en tablet */
  }
}

/* === Responsivo (Celulares grandes) === */
@media (max-width: 768px) {
  header {
    padding: 18px 12px;
  }

  header h1 {
    font-size: 20px; /* asegura legibilidad */
    gap: 8px;
  }

  header h1 img {
    width: 34px;
  }

  nav {
    padding: 8px 6px;
  }

  /* Nav en dos líneas si es necesario */
  nav a {
    display: inline-block;
    padding: 8px 12px;
    margin: 4px 4px;
    font-size: 15px;
  }

  main {
    margin: 18px auto 40px;
    padding: 0 12px;
  }

  section.products {
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 16px;
  }

  .product-card {
    border-radius: 18px;
  }

  .product-card img {
    height: 210px;          /* reduce altura para evitar scroll */
    padding: 8px;           /* un poco menos de padding */
  }

  .product-content {
    padding: 12px;
  }

  .product-card h3 {
    font-size: 18px;
    margin: 6px 0 4px;
  }

  .price {
    font-size: 16px;
  }
}

/* === Responsivo (Celulares pequeños) === */
@media (max-width: 480px) {
  header h1 {
    font-size: 18px;
    gap: 6px;
  }

  header h1 img {
    width: 28px;
  }

  nav a {
    padding: 7px 10px;
    font-size: 14px;
    margin: 3px;
  }

  section.products {
    grid-template-columns: 1fr; /* una sola columna */
    gap: 14px;
  }

  .product-card img {
    height: 180px; /* más compacta en pantallas pequeñas */
  }

  .product-content {
    padding: 10px;
  }
}

  </style>
</head>
<body>
  <!-- Header -->
  <header>
    <h1>
      <img src="pastel.png" alt="Logo">
      Hidratantes - Dayane
      <img src="icono.png" alt="Icono">
    </h1>
  </header>

  <!-- Nav -->
  <nav>
    <a href="index.html">Inicio</a>
    <a href="producto.html">Productos</a>
  </nav>

  <main>
    <!-- Productos -->
    <section id="hidratantes" class="products">

      <article class="product-card">
        <img src="g1.jpg" alt="g1">
        <div class="product-content">
          <h3>Gatorade ponche</h3>
          <p class="price">$33</p>
        </div>
      </article>

      <article class="product-card">
        <img src="gmora1.jpg" alt="gmora1">
        <div class="product-content">
          <h3>Gatorade sabor mora</h3>
          <p class="price">$33</p>
        </div>
      </article>

      <article class="product-card">
        <img src="guva1.jpg" alt="guva1">
        <div class="product-content">
          <h3>Gatorade uva</h3>
          <p class="price">$33</p>
        </div>
      </article>

      <article class="product-card">
        <img src="g700.jpg" alt="g700">
        <div class="product-content">
          <h3>Gatorade naranja </h3>
          <p class="price">$27</p>
        </div>
      </article>

      <article class="product-card">
        <img src="epura1,5.jpg" alt="epura">
        <div class="product-content">
          <h3>Epura 600ml</h3>
          <p class="price">$20</p>
        </div>
      </article>

      <article class="product-card">
        <img src="epura1.jpg" alt="epura">
        <div class="product-content">
          <h3>Epura 1,5L</h3>
          <p class="price">$25 </p>
        </div>
      </article>

      <article class="product-card">
        <img src="be ligth.jpg" alt="Pepsi 600ml">
        <div class="product-content">
          <h3>Be ligth 1L</h3>
          <p class="price">$25</p>
        </div>
      </article>

        <article class="product-card">
        <img src="emora.jpg" alt="emora">
        <div class="product-content">
          <h3>Electrolit sabor Mora</h3>
          <p class="price">$27</p>
        </div>
      </article>

          <article class="product-card">
        <img src="euva.jpg" alt="euva">
        <div class="product-content">
          <h3>Electrolit sabor Uva</h3>
          <p class="price">$27</p>
        </div>
      </article>

          <article class="product-card">
        <img src="enaranja.jpg" alt="enaranja">
        <div class="product-content">
          <h3>Electrolit sabor naranja</h3>
          <p class="price">$27</p>
        </div>
      </article>

    </section>
  </main>
</body>
</html>
