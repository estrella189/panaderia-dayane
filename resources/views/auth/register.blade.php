<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Panadería</title>
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
        .register-container {
            background-color: white;
            padding: 2.5rem;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(139, 107, 61, 0.15);
            width: 100%;
            max-width: 450px;
            text-align: center;
        }
        h2 {
            color: #5c3a21;
            margin-bottom: 1.5rem;
            font-weight: 600;
            border-bottom: 2px solid #e8d5b5;
            padding-bottom: 0.75rem;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 0.75rem 1.25rem;
            margin-bottom: 1.5rem;
            border: 1px solid #c3e6cb;
            border-radius: 6px;
            font-size: 0.95rem;
            text-align: left;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            padding: 0.75rem 1.25rem;
            margin-bottom: 1.5rem;
            border: 1px solid #f5c6cb;
            border-radius: 6px;
            font-size: 0.95rem;
            text-align: left;
        }
        .form-group { margin-bottom: 1.25rem; text-align: left; }
        label { display: block; margin-bottom: 0.5rem; font-weight: 500; color: #5c3a21; }
        input, select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #e0d6c2;
            border-radius: 6px;
            background-color: #fff;
            transition: all 0.3s ease;
            color: #5c3a21;
            font-size: 1rem;
        }
        input:focus, select:focus {
            border-color: #8b6b3d;
            box-shadow: 0 0 0 0.25rem rgba(139, 107, 61, 0.2);
            outline: none;
        }
        .error-text { color: #9b2c2c; font-size: 0.9rem; margin-top: 0.4rem; }
        button {
            background-color: #6b8e23;
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
            margin-top: 1rem;
        }
        button:hover {
            background-color: #5c7a1f;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(107, 142, 35, 0.3);
        }
        @media (max-width: 480px) {
            .register-container { padding: 1.5rem; margin: 1rem; }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Crear Cuenta</h2>

        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert-danger">
                <strong>Revisa los campos:</strong>
                <ul style="margin: 0.5rem 0 0 1rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label for="name">Nombre:</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required placeholder="Ingrese su nombre">
                @error('name') <div class="error-text">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="email">Correo electrónico:</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required placeholder="Ingrese su correo">
                @error('email') <div class="error-text">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input id="password" type="password" name="password" required placeholder="Cree una contraseña">
                @error('password') <div class="error-text">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmar Contraseña:</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required placeholder="Repita su contraseña">
            </div>

            <!-- Selección de Rol -->
            <div class="form-group">
                <label for="role">Rol:</label>
                <select id="role" name="role" required>
                    <option value="cliente" {{ old('role','cliente')==='cliente' ? 'selected' : '' }}>Cliente</option>
                    <option value="empleado" {{ old('role')==='empleado' ? 'selected' : '' }}>Empleado</option>

                    {{-- Solo mostrar "Administrador" si quien registra es un admin --}}
                    @auth
                        @if(auth()->user()->isAdmin())
                            <option value="admin" {{ old('role')==='admin' ? 'selected' : '' }}>Administrador</option>
                        @endif
                    @endauth
                </select>
                @error('role') <div class="error-text">{{ $message }}</div> @enderror
            </div>

            <button type="submit">Registrarse</button>
        </form>
    </div>
</body>
</html>
