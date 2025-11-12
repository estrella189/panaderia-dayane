<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="icono.png" type="image/png">
  <title>Productos</title>
  <style>
    body{
      margin:0;
      font-family:'Trebuchet MS','Lucida Sans Unicode','Lucida Grande','Lucida Sans',Arial,sans-serif;
      background-color:#f5f5f5; color:#333;
    }

    /* Header */
    header{
      background:#8b5e3c; color:#fff; padding:20px;
      display:flex; justify-content:center; align-items:center; text-align:center;
      box-shadow:0 4px 12px rgba(0,0,0,.1);
    }
    header h1{ margin:0; font-size:36px; display:flex; align-items:center; }
    header img{ width:60px; height:auto; margin:0 10px; vertical-align:middle; }

    /* Nav */
    nav{
      background:#a97e5a; padding:10px 0; text-align:center; position:relative;
    }
    nav a{
      text-decoration:none; color:#fff; padding:12px 20px; font-size:18px; display:inline-block;
    }
    nav a:hover, nav a.active{ background:#8b5e3c; }

    /* ===== Dropdown Productos (sin JS) ===== */
    .productos-root{
      display:inline-block; position:relative; /* para posicionar el panel */
    }
    .productos-root > summary{
      list-style:none;
      color:#fff; padding:12px 20px; font-size:18px;
      cursor:pointer; display:inline-block; user-select:none;
      border-radius:0; /* apariencia igual a los <a> */
    }
    .productos-root > summary::-webkit-details-marker{ display:none; }
    .productos-root > summary:hover{ background:#8b5e3c; }

    /* Panel del menú */
    .menu{
      display:none;
      position:absolute; top:100%; left:50%; transform:translateX(-50%);
      background:#fcf4f4; border-radius:20px; width:320px; padding:8px 0;
      box-shadow:0 8px 24px rgba(0,0,0,.16); z-index:2;
      flex-direction:column;
    }

    /* Abrir por hover (desktop) o por click/tap (mobile con details[open]) */
    .productos-root:hover .menu{ display:flex; }
    .productos-root[open] .menu{ display:flex; }

    /* Items del panel */
    .menu a{ color:#0f0e0e; text-decoration:none; padding:8px 12px; font-size:14px; display:block; border-radius:10px; }
    .menu a:hover{ background:#8b5e3c; color:#fff; }

    /* Subgrupos usando <details> internos */
    .menu details{ padding:4px 10px; }
    .menu summary{
      list-style:none; cursor:pointer; padding:8px 10px; font-size:14px; color:#0f0e0e;
      display:flex; justify-content:center; align-items:center; text-align:center;
      border-radius:10px; user-select:none;
    }
    .menu summary::-webkit-details-marker{ display:none; }
    .menu summary:hover{ background:#8b5e3c; color:#fff; }
    .menu summary::after{ content:"▸"; font-size:18px; margin-left:10px; }
    .menu details[open] > summary::after{ content:"▾"; }
    .submenu{
      display:flex; flex-direction:column; margin-left:10px; border-left:2px solid #a97e5a; padding-left:8px;
    }
    .submenu a{ padding:6px 8px; font-size:13px; }
    .submenu a:hover{ background:#8b5e3c; color:#fff; }

    /* ====== Responsivo ====== */
    @media (max-width:768px){
      header h1{ font-size:20px; }
      nav{ padding:6px 0; }
      nav a{ font-size:14px; padding:10px; }

      /* Mantenemos el mismo comportamiento visual en móvil (sin hamburguesa) */
      .productos-root > summary{ font-size:14px; padding:10px 14px; }
      .menu{
        width:min(92vw,360px);
        left:50%; transform:translateX(-50%);
        top:calc(100% + 6px);
      }
    }

    .colash-image{
      display:block; margin:30px auto; max-width:80%; height:auto;
      border-radius:8px; box-shadow:0 4px 12px rgba(0,0,0,.2);
    }

    footer{
      background:#333; color:#fff; padding:20px; text-align:center; margin-top:100px;
    }
    footer p{ margin:0; font-size:14px; }
    footer a{ color:#fff; text-decoration:underline; }
  </style>
</head>
<body>
  <header>
    <h1>
      <img src="pastel.png" alt="Pastel">
      Panadería y Pastelería Dayane
      <img src="icono.png" alt="Icono">
    </h1>
  </header>

  <nav>
    <a href="index.html">Inicio</a>
    <a href="Nosotros.html">Nosotros</a>
    <a href="Mision y Vision.html">Misión y Visión</a>

    <!-- Productos como <details> raíz (abre por hover y por tap) -->
    <details class="productos-root">
      <summary aria-haspopup="true" aria-expanded="false">Productos</summary>

      <div class="menu" role="menu" aria-label="Productos">
        <details>
          <summary>Repostería</summary>
          <div class="submenu">
            <a href="panes_dulces.html">Pan Dulce</a>
            <a href="panes_salados.html">Pan Salado</a>
            <a href="otros.html">Pay de queso</a>
          </div>
        </details>

        <details>
          <summary>Pasteles</summary>
          <div class="submenu">
            <a href="Rollos y Variedades.html">Rollos y Variedades</a>
            <a href="productos de temporada.html">Productos temporada</a>
            <a href="pasteles de chocolate.html">Pasteles de chocolate</a>
            <a href="Para Eventos.html">Para Eventos</a>
            <a href="pasteles de frutas.html">Pasteles de fruta</a>
          </div>
        </details>

        <details>
          <summary>Otros Productos</summary>
          <div class="submenu">
            <a href="leche.html">Leche</a>
            <a href="coca.html">Coca-Cola y Refrescos</a>
            <a href="hidratantes.html">Hidratantes</a>
          </div>
        </details>
      </div>
    </details>
  </nav>

  <img src="prodcts.webp" alt="colash" class="colash-image">

  <footer>
    <p>&copy; 2024 Panadería y Pastelería Dayane. Todos los derechos reservados.</p>
    <a href="Términos y Condiciones.html">Términos y Condiciones</a>
  </footer>
</body>
</html>
