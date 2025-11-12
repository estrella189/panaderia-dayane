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
    height: 240px;
  }
}

/* === Responsivo (Celulares grandes) === */
@media (max-width: 768px) {
  header {
    padding: 18px 12px;
  }

  header h1 {
    font-size: 20px;
    gap: 8px;
  }

  header h1 img {
    width: 34px;
  }

  nav {
    padding: 8px 6px;
    overflow-x: auto;            /* permite desplazamiento horizontal */
    white-space: nowrap;         /* mantiene los links en una línea */
  }

  nav a {
    display: inline-block;
    padding: 8px 12px;
    margin: 4px;
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
    height: 210px;
    padding: 8px;
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
    grid-template-columns: 1fr;
    gap: 14px;
  }

  .product-card img {
    height: 180px;
  }

  .product-content {
    padding: 10px;
  }

  .product-card h3 {
    font-size: 16px;
  }

  .price {
    font-size: 15px;
  }
}

  </style>
</head>
<body>
  <!-- Header -->
  <header>
    <h1>
      <img src="pastel.png" alt="Logo">
      Refrescos y Coca-Cola - Dayane
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
    <section id="refrescos" class="products">

      <article class="product-card">
        <img src="coca600.webp" alt="Coca-Cola 600ml">
        <div class="product-content">
          <h3>Coca-Cola 600ml</h3>
          <p class="price">$22</p>
        </div>
      </article>

      <article class="product-card">
        <img src="CocaCola2.5.jpg" alt="Coca-Cola">
        <div class="product-content">
          <h3>Coca-Cola 1,5L</h3>
          <p class="price">$29</p>
        </div>
      </article>

      <article class="product-card">
        <img src="cocacmini.jpg" alt="Coca-Cola">
        <div class="product-content">
          <h3>Coca-Cola</h3>
          <p class="price">$13</p>
        </div>
      </article>

      <article class="product-card">
        <img src="coca 3l.png" alt="Coca-Cola 3 litros">
        <div class="product-content">
          <h3>Coca-Cola 3L</h3>
          <p class="price">$48</p>
        </div>
      </article>

      <article class="product-card">
        <img src="fanta.jpg" alt="Fanta">
        <div class="product-content">
          <h3>Fanta Naranja 355ml</h3>
          <p class="price">$13</p>
        </div>
      </article>

      <article class="product-card">
        <img src="sprite600.jpg" alt="Sprite">
        <div class="product-content">
          <h3>Sprite 600ml</h3>
          <p class="price">$20</p>
        </div>
      </article>

      <article class="product-card">
        <img src="pepsi600.jpg" alt="Pepsi 600ml">
        <div class="product-content">
          <h3>Pepsi 600ml</h3>
          <p class="price">$20</p>
        </div>
      </article>

        <article class="product-card">
        <img src="joyauva600.jpg" alt="joya de uva">
        <div class="product-content">
          <h3>Joya de uva 600ml</h3>
          <p class="price">$22</p>
        </div>
      </article>

         <article class="product-card">
        <img src="joyadurazno.jpg" alt="joya">
        <div class="product-content">
          <h3>Joya de durazno 600ml</h3>
          <p class="price">$22</p>
        </div>
      </article>

         <article class="product-card">
        <img src="joyamanzana.jpg" alt="joya">
        <div class="product-content">
          <h3>Joya de manzana 600ml</h3>
          <p class="price">$22</p>
        </div>
      </article>

         <article class="product-card">
        <img src="joyaponche.jpg" alt="joya">
        <div class="product-content">
          <h3>Joya de ponche 600ml</h3>
          <p class="price">$22</p>
        </div>
      </article>

         <article class="product-card">
        <img src="arikiwi.jpg" alt="Arizona">
        <div class="product-content">
          <h3>Arizona fresa-kiwi</h3>
          <p class="price">$25</p>
        </div>
      </article>

         <article class="product-card">
        <img src="arisandia.jpg" alt="Arizona">
        <div class="product-content">
          <h3>Arizona sandia </h3>
          <p class="price">$25</p>
        </div>
      </article>

         <article class="product-card">
        <img src="cocavidrio.jpg" alt="coca-cola vidrio">
        <div class="product-content">
          <h3>Coca-Cola Medio</h3>
          <p class="price">$15</p>
        </div>
      </article>

         <article class="product-card">
        <img src="topo600.jpg" alt="topo chico">
        <div class="product-content">
          <h3>Topo chico sangría</h3>
          <p class="price">$22</p>
        </div>
      </article>

         <article class="product-card">
        <img src="jugodelvalle600.jpg" alt="jugo del valle">
        <div class="product-content">
          <h3>Jugo del valle Naranja</h3>
          <p class="price">$20</p>
        </div>
      </article>

         <article class="product-card">
        <img src="cocasmini.jpg" alt="cocas mini">
        <div class="product-content">
          <h3>Refrescos-Mini</h3>
          <p class="price">$13</p>
        </div>
      </article>

         <article class="product-card">
        <img src="squirt600.jpg" alt="squirt">
        <div class="product-content">
          <h3>Squirt 600ml</h3>
          <p class="price">$20</p>
        </div>
      </article>

           <article class="product-card">
        <img src="pepsi3.jpg" alt="pepsi">
        <div class="product-content">
          <h3>Pepsi 2,5L</h3>
          <p class="price">$39</p>
        </div>
      </article>

           <article class="product-card">
        <img src="coca2retorn.jpg" alt="squirt">
        <div class="product-content">
          <h3>Coca retornable</h3>
          <p class="price">$20</p>
        </div>
      </article>

           <article class="product-card">
        <img src="manzana sol.jpg" alt="manzana">
        <div class="product-content">
          <h3>Manzanita sol</h3>
          <p class="price">$20</p>
        </div>
      </article>

    </section>
  </main>
</body>
</html>
