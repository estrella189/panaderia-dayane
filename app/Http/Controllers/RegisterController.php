<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; // Necesario para autenticar al usuario

class RegisterController extends Controller
{
    // Mostrar el formulario de registro
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Método de registro
    public function register(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',  // Asegurarse de que el email sea único
            'password' => 'required|min:6|confirmed',  // La contraseña debe tener al menos 6 caracteres y estar confirmada
        ]);

        // Crear el usuario en la base de datos
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Encriptar la contraseña
        ]);

        // Iniciar sesión automáticamente después de registrarse
        Auth::login($user);  // Esto hará que el usuario esté autenticado

        // Redirigir al usuario al login con un mensaje de éxito
        return redirect('/login')->with('success', 'Usuario registrado correctamente');
    }
}
