<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="icono.png" type="image/png">
    <title>Inicio</title>
    <style>
        body {
            margin: 0;
            font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        /* Header Section */
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

        /* Hero Section */
        .hero {
            background-image: url('portada.jpg');
            background-size: cover;
            background-position: center;
            height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            box-shadow: inset 0 0 0 1000px rgba(0, 0, 0, 0.3);
        }

        .hero h2 {
            font-size: 48px;
            margin: 0;
        }

        .hero p {
            font-size: 24px;
            margin: 10px 0;
        }

        .hero button {
            background-color: #e9c46a;
            color: #333;
            border: none;
            padding: 12px 24px;
            font-size: 18px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .hero button:hover {
            background-color: #f4a261;
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

        @media (max-width: 768px) {
            .header h1 {
                font-size: 20px;
            }

            .nav a {
                font-size: 13px;
                padding: 10px;
            }

            .hero h2 {
                font-size: 32px;
            }

            .hero p {
                font-size: 18px;
            }

            .hero button {
                font-size: 16px;
                padding: 10px 20px;
            }

            footer p {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>

    <!-- Encabezado -->
    <header class="header">
        <h1>
            <img src="pastel.png" alt="Pastel">
            Panadería y Pastelería Dayane
            <img src="icono.png" alt="Icono">
        </h1>
    </header>

    <!-- Barra de navegación -->
    <nav class="nav">
        <a href="index.html">Inicio</a>
        <a href="Nosotros.html">Nosotros</a>
        <a href="Mision y Vision.html">Misión y Visión</a>
        <a href="productos.html">Productos</a>
        <a href="contacto.html">Contacto</a>
    </nav>

    <!-- Contenido principal -->
    <main>
        <section class="hero">
            <div>
                <h2>Descubre el sabor de la tradición</h2>
                <p>Productos horneados con pasión y calidad.</p>
                <button>Conócenos más</button>
            </div>
        </section>
    </main>

    <!-- Pie de página -->
    <footer>
        <p>&copy; 2024 Panadería y Pastelería Dayane. Todos los derechos reservados.</p>
        <a href="Términos y Condiciones.html">Términos y Condiciones</a>
    </footer>

</body>
</html>
