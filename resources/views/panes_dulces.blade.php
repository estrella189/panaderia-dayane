<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="icono.png" type="image/png">
    <title>Panes dulces</title>
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

        /* barra de navegacion */
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

        .description{
            text-align: center;
            margin-inline: 10px 50px;
            font-size: 18px;
            color: #555;
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
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.2s;
        }

        .product-card:hover {
            transform: scale(1.05);
        }

        .product-card img {
            width: 100%;
            height: 300px;
            object-fit: cover;
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

        @media (max-width: 768px) {
            header h1 {
                font-size: 20px;
            }
            .description{
                font-size: 16px;
                margin-inline: 10px 30px;
            
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
        <!-- Descripción -->
        <div class="description">
            <p>"Endulza tu día con nuestros irresistibles panes dulces, recién horneados y llenos de sabor. <br>
                ¡Cada mordida es puro placer!" 🍯✨</p>
        </div>

        <!-- panes dulces -->
        <section id="dulce" class="products">
            <div class="product-card dulce">
                <img src="polvorones.jpg" alt="Polvorín Multicolores">
                <h3>Polvorín Multicolores</h3>
                <p class="price">$10</p>
            </div>
            <div class="product-card dulce">
                <img src="margaritas.jpg" alt="Margaritas">
                <h3>Margaritas</h3>
                <p class="price">$10</p>
            </div>
            <div class="product-card dulce">
                <img src="concha.jpg" alt="Concha">
                <h3>Concha</h3>
                <p class="price">$10</p>
            </div>
            <div class="product-card dulce">
                <img src="puro.jpg" alt="Puro">
                <h3>Puro</h3>
                <p class="price">$10</p>
            </div>
            <div class="product-card dulce">
                <img src="platano.jpg" alt="Platano">
                <h3>Platano</h3>
                <p class="price">$10</p>
            </div>
            <div class="product-card dulce">
                <img src="mantecada.jpg" alt="Mantecada">
                <h3>Mantecada</h3>
                <p class="price">$10</p>
            </div>
            <div class="product-card dulce">
                <img src="cuerno.jpg" alt="Cuerno">
                <h3>Cuerno</h3>
                <p class="price">$10</p>
            </div>
            <div class="product-card dulce">
                <img src="marranito.jpg" alt="Marranito">
                <h3>Marranito</h3>
                <p class="price">$10</p>
            </div>
            <div class="product-card dulce">
                <img src="ojo.jpg" alt="Ojo">
                <h3>Ojo</h3>
                <p class="price">$10</p>
            </div>
            <div class="product-card dulce">
                <img src="bisquet.jpg" alt="Bisquet">
                <h3>Bisquet</h3>
                <p class="price">$10</p>
            </div>
            <div class="product-card dulce">
                <img src="arracada.jpg" alt="Arracada">
                <h3>Arracada</h3>
                <p class="price">$10</p>
            </div>
            <div class="product-card dulce">
                <img src="dona_azucar.jpg" alt="Dona de azucar">
                <h3>Dona de azucar</h3>
                <p class="price">$10</p>
            </div>
            <div class="product-card dulce">
                <img src="Pierna.jpg" alt="Pierna">
                <h3>Pierna</h3>
                <p class="price">$12</p>
            </div>
            <div class="product-card dulce">
                <img src="roles_canela.jpg" alt="Roles de canela">
                <h3>Roles de canela</h3>
                <p class="price">$12</p>
            </div>
            <div class="product-card dulce">
                <img src="dona_rellena.jpg" alt="Dona rellena">
                <h3>Dona rellena</h3>
                <p class="price">$12</p>
            </div>
            <div class="product-card dulce">
                <img src="dona_de_chocolate.jpg" alt="Dona de chocolate">
                <h3>Dona de chocolate</h3>
                <p class="price">$12</p>
            </div>
            <div class="product-card dulce">
                <img src="yoyo.png" alt="Yoyo">
                <h3>Yoyo</h3>
                <p class="price">$12</p>
            </div>
            <div class="product-card dulce">
                <img src="rebanada.jpg" alt="Rebanada">
                <h3>Rebanada</h3>
                <p class="price">$12</p>
            </div>
            <div class="product-card dulce">
                <img src="rebanada_mantequilla.jpg" alt="Rebanada de mantequilla">
                <h3>Rebanada de mantequilla</h3>
                <p class="price">$12</p>
            </div>
            <div class="product-card dulce">
                <img src="empanadas.jpg" alt="Empanadas">
                <h3>Empanadas</h3>
                <p class="price">$12</p>
            </div>
            <div class="product-card dulce">
                <img src="caracol.jpg" alt="Caracol">
                <h3>Caracol</h3>
                <p class="price">$15</p>
            </div>
            <div class="product-card dulce">
                <img src="cono.jpg" alt="Cono">
                <h3>Cono</h3>
                <p class="price">$15</p>
            </div>
            <div class="product-card dulce">
                <img src="bronquitis.jpg" alt="Tronco">
                <h3>Tronco</h3>
                <p class="price">$15</p>
            </div>
        </section>
    </main>
</body>
</html>
