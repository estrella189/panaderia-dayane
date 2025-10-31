<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="icono.png" type="image/png">
    <title> Nosotros</title>
    <style>
       body {
            margin: 0;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;

            background-color: #f5f5f5;
            color: #333;
        }

        /* Header */
        .header {
            background-color: #8b5e3c; /* Color más café */
            color: #fff;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .header h1 {
            margin: 0;
            font-size: 36px;
            display: flex;
            align-items: center; /* Alinea el texto y las imágenes verticalmente */
        }

        .header h1 img {
            width: 60px; /* Tamaño más pequeño del ícono */
            height: auto; /* Mantiene la proporción de la imagen */
            margin-right: 10px; /* Espacio entre la imagen y el texto */
            vertical-align: middle; /* Alinea las imágenes al centro del texto */
        }

        /*  barra Navegacion */
        .nav {
            background-color: #a97e5a; /* Color más café */
            padding: 10px 0;
            display: flex;
            justify-content: center;
        }

        .nav a {
            text-decoration: none;
            color: #fff;
            padding: 12px 20px;
            font-size: 18px;
        }

        .nav a:hover {
            background-color: #8b5e3c; /* Color café más oscuro */
        }

        .section img {
    
            height: 300px;
            margin-right: 15px;
        }

        /* About Section */
        .section {
            padding: 40px 20px;
            text-align: center;
        }
        .section h2 {
            font-size: 32px;
            color: #d4a373;
            margin-bottom: 20px;
        }
        .section p {
            font-size: 18px;
            max-width: 800px;
            margin: 0 auto;
            color: #555;
        }

        /* Footer */
        footer {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        footer p {
            margin: 0;
            font-size: 14px;
        }
         /* Media  para dispositivos móviles */
    @media (max-width: 768px) {
         .header h1 {
            font-size: 20px;
        }

        .nav a {
            font-size: 13px;
            padding: 10px;
        }
         .section img {
            height: 200px;
            width: auto;
            margin: 0 auto 20px;
            display: block;
           
        }

        /* About Section */
        .section {
            padding: 20px 10px;
        }
        .section h2 {
            font-size: 28px;
            margin-bottom: 15px;
        }
        .section p {
            font-size: 16px;

        }
        footer p {
            font-size: 12px;
        }

        footer a {
            font-size: 12px;
        }
    }
    </style>
</head>
<body>

    <header class="header">
        <h1>
            <img src="pastel.png" alt="Pastel">
            Panadería y Pastelería Dayane
            <img src="icono.png" alt="Icono">
        </h1>
    </header>


    <nav class="nav">
        <a href="index">Inicio</a>
        <a href="Nosotros">Nosotros</a>
        <a href= "Mision y Vision">Misión y Visión</a>
        <a href="producto">Productos</a>
        <a href="contacto">Contacto</a>
      
    </nav>

  <main>
        <section class="section">
            <img src="local.jpg" alt="portada">
            <h2>Sobre Nosotros</h2>
            <p>Bienvenidos a Panadería y Pastelería Dayane. Nos enorgullecemos de ofrecer productos de alta calidad, con ingredientes frescos y una pasión por la excelencia.
            Desde nuestra fundación, hemos trabajado arduamente para brindar a nuestros clientes los mejores panes y pasteles, y continuar innovando con nuevas recetas y sabores.</p>
        </section>
 </main>
  

    <footer>
        <p>&copy; 2024 Panadería y Pastelería Dayane. Todos los derechos reservados.</p>
        <a href="Términos y Condiciones.html">Términos y Condiciones</a>
    </footer>

</body>
</html>

