<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="icono.png" type="image/png">
    <title>Inicio - Panadería y Pastelería Dayane</title>
    <style>
        body {
            margin: 0;
            font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        /* Header Section */
        .header {
            background-color: #8b5e3c;
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
            align-items: center;
        }

        .header h1 img {
            width: 60px;
            height: auto;
            margin-right: 10px;
            vertical-align: middle;
        }

        /* Navigation Bar */
        .nav {
            background-color: #a97e5a;
            padding: 10px 0;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            align-items: center;
            gap: 5px;
        }

        .nav a {
            text-decoration: none;
            color: #fff;
            padding: 12px 20px;
            font-size: 18px;
            transition: background-color 0.3s;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .nav a:hover {
            background-color: #8b5e3c;
        }

        /* Login Button Style */
        .nav .login {
            border-radius: 10px;
            padding: 10px 18px;
            font-weight: bold;
        }

        .nav .login:hover {
            background-color: #7a4f31;
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
            position: relative;
        }

        .hero-content {
            z-index: 2;
        }

        .hero h2 {
            font-size: 48px;
            margin: 0;
        }

        .hero p {
            font-size: 24px;
            margin: 10px 0 20px;
        }

        .hero .btn {
            display: inline-block;
            background-color: #e9c46a;
            color: #333;
            border: none;
            padding: 12px 24px;
            font-size: 18px;
            cursor: pointer;
            border-radius: 5px;
            transition: all 0.3s;
            text-decoration: none;
            font-weight: bold;
        }

        .hero .btn:hover {
            background-color: #f4a261;
            transform: translateY(-2px);
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

        /* Responsive */
        @media (max-width: 768px) {
            .header h1 {
                font-size: 24px;
            }

            .nav a {
                font-size: 15px;
                padding: 10px;
            }

            .hero h2 {
                font-size: 32px;
            }

            .hero p {
                font-size: 18px;
            }

            .hero .btn {
                font-size: 16px;
                padding: 10px 20px;
            }

           
            footer {
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
        <a href="index">Inicio</a>
        <a href="Nosotros">Nosotros</a>
        <a href="Mision y Vision">Misión y Visión</a>
        <a href="productos">Productos</a>
        <a href="contacto">Contacto</a>

        <!-- 👤 Botón de inicio de sesión con emoji -->
        <a href="{{ route('login') }}" class="login">
            👤 Iniciar sesión
        </a>
    </nav>

    <!-- Contenido principal -->
    <main>
        <section class="hero">
            <div class="hero-content">
                <h2>Descubre el sabor de la tradición</h2>
                <p>Productos horneados con pasión y calidad.</p>
                <a href="Nosotros" class="btn">Conócenos más</a>
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

