<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panadería y Pastelería Dayane')</title>
    
    <!-- Fuentes y estilos -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
    <style>
        :root {
            --primary:rgb(103, 63, 6);
            --secondary: #5c3a21;
            --cream: #fff9f0;
            --light-cream: #f8f4ec;
            --white: #ffffff;
            --gold: #d4af37;
            --pink: #f8bbd0;
            --shadow: 0 4px 24px rgba(92, 58, 33, 0.12);
        }
        
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--cream);
            color: var(--secondary);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: var(--white);
            padding: 1rem 0;
            box-shadow: var(--shadow);
        }
        
        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }
        
        .logo:hover {
            transform: scale(1.02);
        }
        
        .logo-icon {
            margin-right: 0.8rem;
            color: var(--gold);
            font-size: 2rem;
            position: relative;
        }
        
        .logo-icon::after {
            content: '🍰';
            position: absolute;
            font-size: 1rem;
            right: -5px;
            bottom: -5px;
            transform: rotate(15deg);
        }
        
        .auth-section {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        
    
        .container {
            flex: 1;
            max-width: 1200px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: var(--white);
            border-radius: 12px;
            box-shadow: var(--shadow);
            width: 90%;
        }
        
        footer {
            background: linear-gradient(135deg, var(--secondary), var(--primary));
            color: var(--white);
            padding: 1.5rem;
            text-align: center;
            margin-top: auto;
        }
        

        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
                padding: 1rem;
            }
            
            .logo {
                font-size: 1.5rem;
            }
            
            .container {
                padding: 1.5rem;
                margin: 1rem auto;
            }
        }
    </style>
</head>
<body>
    <!-- Header con logo -->
    <header>
        <div class="header-content">
            <a href="/" class="logo" style="text-decoration: none; color: inherit;">
                <div class="logo-icon">
                    <i class="fas fa-cookie-bite"></i>
                </div>
                <span>Panadería y Pastelería Dayane</span>
            </a>
            
    </header>

    <!-- Contenedor principal con el contenido de la página -->
    <main class="container">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <p>
                <span class="footer-icon">🥐</span>
                &copy; {{ date('Y') }} Panadería y Pastelería Dayane
                <span class="footer-icon">🍪</span>
            </p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>