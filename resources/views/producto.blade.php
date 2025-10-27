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
            border-radius: 20px;
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
         /* Submenú con <details> */
            .menu details {
            padding: 4px 10px;
            }

            .menu summary {
            list-style: none;           /* quita el triángulo por defecto */
            cursor: pointer;
            padding: 8px 10px;
            font-size: 14px;
            color: #0f0e0eda;
            display: flex;
           justify-content: center;  /* centra horizontalmente */
            align-items: center;      /* centra verticalmente */
            text-align: center;  
            }

            .menu summary::after {
            content: "▸";               /* flechita cerrada */
            font-size: 25px;
              margin-left: 20px; 
            }

            .menu details[open] summary::after {
            content: "▾";               /* flechita abierta */
            }

            .submenu {
            display: flex;
            flex-direction: column;
            margin-left: 10px;          /* sangría del submenú */
            border-left: 2px solid #a97e5a;
            }

            .submenu a {
            padding: 6px 10px;
            font-size: 13px;
            }

            /* Hover coherente con tu estilo */
            .menu a:hover, .submenu a:hover, .menu summary:hover {
            background-color: #8b5e3c;
            color: #fff;
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
         .menu details:hover > .submenu {
    /* visual: no fuerza open, pero deja el hover bonito */
    background: #fcf4f4;
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

        <!-- NUEVO: categoría con submenú -->
        <details>
            <summary>Repostería</summary>
            <div class="submenu">
                <a href="panes_dulces.html">Pan Dulce</a>
                <a href="panes_salados.html">Pan Salado</a>
                <a href="otros.html">Pay de queso</a>
    
            </div>
        </details>

        <!-- Categoría con submenú -->
        <details>
            <summary>Pasteles</summary>
            <div class="submenu">
                <a href="Rollos y Variedades.html">Rollos y Variedades</a>
                <a href="productos de temporada.html">Productos temporada</a>
                <a href="pasteles de chocolates.html">Pasteles de chocolate</a>
                <a href="Para Eventos.html">Para Eventos</a>
                <a href="pasteles de frutas.html">Pasteles de fruta</a>
            </div>
        </details>

            <!-- NUEVA Categoría Otros Productos -->
        <details>
            <summary>Otros Productos</summary>
            <div class="submenu">
                <a href="leche.html">Leche</a>
                <a href="coca.html">Coca-Cola y Refrescos</a>
                <a href="hidratantes.html">Hidratantes</a>
            </div>
        </details>

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
