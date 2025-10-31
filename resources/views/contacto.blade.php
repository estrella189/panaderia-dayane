<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="icono.png" type="image/png">
    <title>Contacto</title>
    <style>
      body {
            margin: 0;
            font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;

            background-color: #f5f5f5;
            color: #333;
        }

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

        /* Navigation Bar */
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

        .contenido {
            text-align: center;
            padding: 20px;
        }
        .contact-info {
            margin: 0 auto;
            width: 50%;
            background-color: #f7f7f7;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: left;
        }
        .contact-info h3 {
            margin-top: 20px;
        }
        .contact-info p {
            margin: 10px 0;
        }
         /* Footer */
         footer {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
            margin-top: 120px;
        }
        footer p {
            margin: 0;
            font-size: 14px;
        }
        @media (max-width: 768px) {
    /* Header */
    .header h1 {
        font-size: 20px; /* Reduce el tamaño del texto */
    }

    /* Navigation Bar */
    .nav a {
        font-size: 13px; /* Reduce el tamaño de fuente de los enlaces */
        padding: 8px 10px; /* Ajusta el espacio entre enlaces */
    }

    /* Contenido */
    .contenido {
        padding: 10px; /* Reduce el padding del contenido */
    }

    .contact-info {
        width: 90%; /* Ocupa casi todo el ancho disponible */
        padding: 10px; /* Reduce el padding interno */
        text-align: center; /* Centra el contenido */
    }

    .contact-info h3 {
        font-size: 18px; /* Reduce el tamaño de los títulos */
    }

    .contact-info p {
        font-size: 14px; /* Reduce el tamaño del texto */
    }

    /* Google Maps iframe */
    iframe {
        width: 100%; /* Ajusta el ancho del mapa al 100% */
        height: 300px; /* Reduce la altura para móviles */
    }

    footer p {
        font-size: 12px; /* Reduce el tamaño de fuente */
    }
    footer a {
        font-size: 12px;
    }
}

    </style>
</head>
<body>

    <!-- Header -->
    <header class="header">
        <h1>
            <img src="pastel.png" alt="Pastel">
            Panadería y Pastelería Dayane
            <img src="icono.png" alt="Icono">
        </h1>
    </header>

    <nav class="nav">
        <a href="index.html">Inicio</a>
        <a href="Nosotros.html">Nosotros</a>
        <a href= "Mision y Vision.html">Misión y Visión</a>
        <a href="producto.html">Productos</a>
        <a href="contacto.html">Contacto</a>
      
    </nav>

    <div class="contenido">
        <h2>Contáctanos</h2>
        <p>Estamos aquí para atenderte. Puedes visitarnos o llamarnos a través de la siguiente información de contacto:</p>

        <div class="contact-info">
            <h3>Teléfono</h3>
            <p><strong>Teléfono:</strong> +52 8180921084</p>

            <h3>Ubicación</h3>
            <p><strong>Dirección:</strong> Calle Av.Angeles y Miguel #151, Colonia Punta Diamante Sector Angeles.</p>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3592.4500888082634!2d-100.59692282476819!3d25.788721277334908!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x86629d002295a485%3A0x9be49d6e266a6101!2sPanader%C3%ADa%20y%20Pasteler%C3%ADa%20Dayane!5e0!3m2!1ses-419!2smx!4v1729698444442!5m2!1ses-419!2smx" 
             width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Panadería y Pastelería Dayane. Todos los derechos reservados</p>
        <a href="Términos y Condiciones.html">Términos y Condiciones</a>
    </footer>

</body>
</html>