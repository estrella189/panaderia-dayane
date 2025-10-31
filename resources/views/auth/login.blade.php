<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Panadería</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f3e9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #5c3a21;
        }

        .login-container {
            background-color: white;
            padding: 2.5rem;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(139, 107, 61, 0.15);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h2 {
            color: #5c3a21;
            margin-bottom: 1.5rem;
            font-weight: 600;
            border-bottom: 2px solid #e8d5b5;
            padding-bottom: 0.75rem;
        }

        input {
            width: 100%;
            padding: 0.75rem 1rem;
            margin-bottom: 1rem;
            border: 1px solid #e0d6c2;
            border-radius: 6px;
            background-color: #fff;
            transition: all 0.3s ease;
            color: #5c3a21;
            font-size: 1rem;
        }

        input:focus {
            border-color: #8b6b3d;
            box-shadow: 0 0 0 0.25rem rgba(139, 107, 61, 0.2);
            outline: none;
        }

        button {
            background-color: #8b6b3d;
            border: none;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            font-size: 1rem;
            transition: all 0.3s ease;
            width: 100%;
            border-radius: 6px;
            color: white;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            cursor: pointer;
            margin-top: 0.5rem;
        }

        button:hover {
            background-color: #7a5c3a;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(139, 107, 61, 0.3);
        }

        .form-group {
            margin-bottom: 1.25rem;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #5c3a21;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 1.5rem;
                margin: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Inicio de Sesión</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="email" name="email" placeholder="Ingrese su correo" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" name="password" placeholder="Ingrese su contraseña" required>
            </div>
            <button type="submit">Iniciar sesión</button>
        </form>
    </div>
</body>
</html>

