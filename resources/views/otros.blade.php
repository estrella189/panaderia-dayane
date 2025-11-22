<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="icono.png" type="image/png">
    <title>Otros </title>
    <style>
        body {
            margin: 0;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

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
            vertical-align: middle;
        }

        
        nav {
            background-color: #a97e5a;
            padding: 10px 0;
            text-align: center;
        }

        nav a {
            text-decoration: none;
            color: #fff;
            padding: 12px 20px;
            font-size: 18px;
            margin: 0 10px;
            display: block;
        }
        /* Product Grid */
        section.products {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .product-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .product-card:hover {
            transform: scale(1.05);
        }

        .product-card img {     
        margin: 0 auto; /* Centra horizontalmente */
        width: 300px; /* Ajusta el tamaño */
        height: auto; /* Mantiene las proporciones originales */
        border-radius: 8px; /* Añade bordes ligeramente redondeados */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra para destacarla */
       }

        .product-card h3 {
            color: #D2691E;
            margin: 10px 0;
        }

        .product-card .price {
            font-weight: bold;
            color: #d95c18;
            font-size: 18px;
            margin: 10px 0;
        }
        @media(max-width: 768px) {
            header h1 {
                font-size: 20px;
            }
            
        }

    </style>
</head>
<body>
    
    <!-- Header -->
    <header>
        <h1>
            <img src="pastel.png" alt="Pastel">
            Panadería y Pastelería Dayane
            <img src="icono.png" alt="Icono">
        </h1>
    </header>
    <nav class="nav">
        <a href="producto.html">Productos</a>
    </nav>

    <main>
      <!-- otros -->
        <section id="Otros" class="products">
            <div class="product-card Otros">
                <img src="pay.jpg" alt="Pay de queso">
                <h3>Pay de queso</h3>
                <p class="price">$45</p>
            </div>
        </section>
        
    </main>


</body>
</html> 