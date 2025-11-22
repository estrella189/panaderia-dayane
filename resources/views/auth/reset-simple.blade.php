<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer contraseña</title>
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

        .reset-container {
            background-color: #ffffff;
            padding: 2.5rem;
            border-radius: 12px;
            width: 100%;
            max-width: 430px;
            box-shadow: 0 6px 25px rgba(139, 94, 60, 0.18);
            animation: fadeIn 0.3s ease-in-out;
        }

        h2 {
            text-align: center;
            color: #5c3a21;
            font-weight: 600;
            margin-bottom: 1.5rem;
            border-bottom: 2px solid #e8d5b5;
            padding-bottom: 0.75rem;
        }

        label {
            display: block;
            font-weight: 500;
            color: #5c3a21;
            margin-bottom: 0.5rem;
        }

        input {
            width: 100%;
            padding: 0.75rem 1rem;
            margin-bottom: 1.25rem;
            border: 1px solid #e0d6c2;
            border-radius: 6px;
            background-color: #fff;
            transition: all 0.3s ease;
            color: #5c3a21;
            font-size: 1rem;
        }

        input:focus {
            border-color: #8b6b3d;
            box-shadow: 0 0 0 0.25rem rgba(139, 94, 60, 0.25);
            outline: none;
        }

        button {
            width: 100%;
            background-color: #8b6b3d;
            border: none;
            padding: 0.85rem 1.5rem;
            color: white;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: 0.3s ease;
            letter-spacing: 0.7px;
            margin-top: 0.5rem;
        }

        button:hover {
            background-color: #7a5c3a;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(139, 94, 60, 0.3);
        }

        p {
            margin: 0;
            font-size: 0.9rem;
        }

        .success {
            color: #2b8a3e;
            background: #e6f4ea;
            padding: 0.75rem;
            border-radius: 6px;
            margin-bottom: 1.25rem;
            text-align: center;
        }

        .error {
            color: #c0392b;
            margin-top: -0.5rem;
            margin-bottom: 1rem;
            font-size: 0.88rem;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <div class="reset-container">

        <h2>Restablecer contraseña</h2>

        @if (session('status'))
            <div class="success">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <label for="email">Correo electrónico</label>
            <input type="email" name="email" placeholder="Ingrese su correo" required>

            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="password">Nueva contraseña</label>
            <input type="password" name="password" placeholder="Ingrese su nueva contraseña" required>

            <label for="password_confirmation">Confirmar contraseña</label>
            <input type="password" name="password_confirmation" placeholder="Confirme su contraseña" required>

            <button type="submit">Actualizar contraseña</button>
        </form>

    </div>

</body>
</html>
