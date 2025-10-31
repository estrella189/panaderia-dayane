<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="icono.png" type="image/png">
    <title>Misión y Visión</title>
    <style>
        body {
            margin: 0;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        /* Header */
        .header {
            background-color: #8b5e3c;
            color: #fff;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 36px;
            display: flex;
            align-items: center;
            gap: 10px; /* Espacio entre el icono y el texto */
        }

        .header h1 img {
            width: 60px;
            height: auto;
        }

        /* barra de navegacion */
        .nav {
            background-color: #a97e5a;
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
            background-color: #8b5e3c;
        }

        /* Estilo para las secciones de Misión y Visión */
        .section {
            text-align: center;
            margin: 40px auto;
            max-width: 80%;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .section-image {
            max-width: 500px;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .section-description {
            font-size: 20px;
            color: #333;
            margin-top: 15px;
            line-height: 1.6;
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

        /* Media Queries para dispositivos móviles */
        @media (max-width: 768px) {
            .header h1 {
                font-size: 20px;
            }

            .nav a {
                font-size: 13px;
                padding: 10px;
            }

            .section-description {
                font-size: 18px;
                padding: 0 10px;
            }
            .section-image{
                max-width: 100%;
            }

            .section {
                margin: 20px;
                max-width: 90%;
            }
            

            footer {
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

    <!-- barra de navegación -->
    <nav class="nav">
        <a href="index.html">Inicio</a>
        <a href="Nosotros.html">Nosotros</a>
        <a href="Mision y Vision.html">Misión y Visión</a>
        <a href="producto.html">Productos</a>
        <a href="contacto.html">Contacto</a>
    </nav>

    <!-- Misión y Visión -->
    <div class="section">
        <h2>Misión</h2>
        <img src="mision.jpeg" alt="Misión" class="section-image">
        <p class="section-description">Proporcionar productos de panadería y pastelería de la más alta calidad, utilizando ingredientes frescos y locales, mientras brindamos un servicio excepcional a nuestros clientes y fomentamos un ambiente cálido y acogedor.</p>
    </div>
    
    <div class="section">
        <h2>Visión</h2>
        <img src="vision.png" alt="Visión" class="section-image">
        <p class="section-description">Ser reconocidos como la panadería y pastelería preferida en la comunidad, comprometidos con la innovación, la calidad y la satisfacción del cliente.</p>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Panadería y Pastelería Dayane. Todos los derechos reservados.</p>
        <a href="Términos y Condiciones.html">Términos y Condiciones</a>
    </footer>
</body>
</html>
