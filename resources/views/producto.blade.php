<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="icono.png" type="image/png">
    <title>Productos</title>
    <style>
        body {
            margin: 0;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        /* Header Section */
        header {
            background-color: #8b5e3c;
            color: #fff;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            margin: 0;
            font-size: 36px;
            display: flex;
            align-items: center;
        }

        header img {
            width: 60px;
            height: auto;
            margin-right: 10px;
            vertical-align: middle; /* Alinea las imágenes al centro del texto */
            
        }

        /* Navigation Bar */
        nav {
            background-color: #a97e5a;
            padding: 10px 0;
            text-align: center;
            position: relative;
        }

        nav a {
            text-decoration: none;
            color: #fff;
            padding: 12px 20px;
            font-size: 18px;
        }

        nav a:hover,
        nav a.active {
            background-color: #8b5e3c;
        }

        /* Checkbox oculto */
        .menu-toggle {
            display: none;
        }

        /* Icono de menú hamburguesa */
        .menu-toggle-label {
            font-size: 24px;
            cursor: pointer;
            color: #faf9f9;
            display: inline-block;
            padding: 12px 20px;
            margin-left: 10px;
            vertical-align: middle;
        }

        /* Estilos para el menú desplegable */
        .menu {
            display: none; /* Oculto inicialmente */
            flex-direction: column;
            position: absolute;
            top: 50px; /* Ajusta la posición justo debajo del ícono */
            right: 300px; /* Más cerca del icono de hamburguesa */
            background-color: #fcf4f4;
            border-radius: 8px;
            width: 300px; /* Tamaño reducido */
            padding: 5px 0;
            box-shadow: 0 4px 8px rgba(251, 246, 246, 0.974);
        }

        .menu a {
            color: #0f0e0eda;
            text-decoration: none;
            padding: 8px 10px; /* Tamaño reducido de los enlaces */
            font-size: 14px; /* Fuente más pequeña */
            display: block;
        }

        .menu a:hover {
            background-color: #8b5e3c;
        }

        /* Mostrar menú cuando el checkbox está marcado */
        .menu-toggle:checked + .menu-toggle-label + .menu {
            display: flex;
        }
        /* Diseño y centrado de la imagen colash */
        .colash-image {
        display: block;
        margin: 30px auto; /* Centra la imagen y le da un margen superior e inferior */
        max-width: 80%; /* Limita el ancho máximo de la imagen al 80% del contenedor */
        height: auto; /* Ajusta la altura proporcionalmente */
        border-radius: 8px; /* Opcional: redondea los bordes */
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2); /* Añade una sombra para darle profundidad */
    }

        /* Footer */
        footer {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
            margin-top: 100px;
        }

        footer p {
            margin: 0;
            font-size: 14px;
        }
            /* Media query para dispositivos móviles */
    @media (max-width: 768px) {
        header h1 {
            font-size: 20px; /* Reduce el tamaño de la fuente */
        }

        nav {
            padding: 5px 0; /* Reduce el padding del navbar */
        }

        nav a {
            font-size: 13px; /* Reduce el tamaño de fuente de los enlaces */
            padding: 10px; /* Ajusta el espacio */
        }

        .menu-toggle-label {
            font-size: 18px; /* Ajusta el tamaño del ícono de menú */
            padding: 5px 10px;
        }

        .menu {
            width: 30%; /* Amplía el menú desplegable */
            right: 5%; /* Centra mejor el menú */
        }

        .menu a {
            font-size: 14px; /* Reduce la fuente en el menú */
        }

        .colash-image {
            max-width: 100%; /* Imagen ocupa el 100% del ancho disponible */
            margin: 15px auto; /* Reduce los márgenes */
        }

        footer p, footer a {
            font-size: 12px; /* Ajusta el tamaño de fuente */
        }
    }


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
        <a href="productos.html">Productos</a>

        <!-- Menú hamburguesa -->
        <input type="checkbox" id="menu-toggle" class="menu-toggle">
        <label for="menu-toggle" class="menu-toggle-label">☰</label>
        <div class="menu">
            <a href="panes_dulces.html">Panes Dulces</a>
            <a href="panes_salados.html">Panes Salados</a>
            <a href="otros.html">Otros</a>
        </div>
    </nav>
    <img src="prodcts.webp" alt="colash" class="colash-image">

 

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Panadería y Pastelería Dayane. Todos los derechos reservados.</p>
        <a href="Términos y Condiciones.html">Términos y Condiciones</a>
    </footer>

</body>
</html>
