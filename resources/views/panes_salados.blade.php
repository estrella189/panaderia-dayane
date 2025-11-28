<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('icono.png') }}" type="image/png">
    <title>Panes salados</title>

    <style>
        :root{
            --cafe-header:#8b5e3c;
            --cafe-nav:#a97e5a;
            --bg:#f4f1ea;
            --card-bg:#ffffff;
            --card-border:#e3d4c2;
            --texto:#4b3828;
            --precio:#d95c18;
        }

        body{
            margin:0;
            font-family:'Trebuchet MS','Lucida Sans Unicode','Lucida Grande','Lucida Sans',Arial,sans-serif;
            background:var(--bg);
            color:var(--texto);
        }

        /* HEADER */
        header{
            background:var(--cafe-header);
            color:#fff;
            padding:22px 10px;
            display:flex;
            justify-content:center;
            align-items:center;
            gap:12px;
            text-align:center;
            box-shadow:0 4px 12px rgba(0,0,0,.15);
        }

        header img{width:52px}

        header h1{
            margin:0;
            font-size:28px;
            letter-spacing:.5px;
        }

        /* NAV */
        nav{
            background:var(--cafe-nav);
            padding:10px 0;
            text-align:center;
            box-shadow:0 3px 8px rgba(0,0,0,.12);
        }

        nav a{
            color:#fff;
            text-decoration:none;
            font-size:18px;
            padding:8px 18px;
            font-weight:bold;
        }

        /* CONTENEDOR */
        main{
            max-width:1200px;
            margin:0 auto 40px;
            padding:20px 16px 40px;
        }

        .description{
            text-align:center;
            font-size:18px;
            margin:15px 0 25px;
        }

        /* GRID */
        section.products{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
            gap:22px;
        }

        .product-card{
            background:var(--card-bg);
            border-radius:18px;
            overflow:hidden;
            box-shadow:0 6px 18px rgba(0,0,0,.10);
            border:1px solid var(--card-border);
            display:flex;
            flex-direction:column;
        }

        .product-card img{
            width:100%;
            height:230px;
            object-fit:cover;
        }

        .info{
            padding:14px 12px 16px;
            text-align:center;
            border-top:1px solid var(--card-border);
        }

        .name{
            margin:0 0 6px;
            font-size:18px;
            font-weight:bold;
            color:var(--cafe-header);
        }

        .price{
            margin:0;
            font-size:18px;
            font-weight:bold;
            color:var(--precio);
        }

        @media (max-width:600px){
            header h1{font-size:22px}
            .description{font-size:16px}
        }
    </style>
</head>
<body>

<header>
    <img src="{{ asset('pastel.png') }}" alt="Pan">
    <h1>Panes Salados - Dayane</h1>
    <img src="{{ asset('icono.png') }}" alt="Icono">
</header>

<nav>
    <a href="{{ route('producto') }}">Productos</a>
</nav>

<main>
    <div class="description">
        "¡Atrévete a probar la perfección en cada bocado!  
        Nuestros panes salados son el toque delicioso que tu día necesita. 🥖❤️"
    </div>

    <section class="products">

        @forelse($productos as $producto)
            <article class="product-card">
                <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}">

                <div class="info">
                    <p class="name">{{ $producto->nombre }}</p>

                    @if(!is_null($producto->precio))
                        <p class="price">${{ $producto->precio }}</p>
                    @endif
                </div>
            </article>
        @empty
            <p style="grid-column:1/-1;text-align:center;">
                No hay panes salados registrados.
            </p>
        @endforelse

    </section>
</main>

</body>
</html>
