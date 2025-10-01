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
       $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role'     => 'required|in:cliente,empleado,admin',
        ], [
            'name.required'      => 'El campo nombre es obligatorio.',
            'email.required'     => 'El campo correo electrónico es obligatorio.',
            'email.email'        => 'Ingresa un correo electrónico válido.',
            'email.unique'       => 'Usuario ya registrado.',         
            'password.required'  => 'La contraseña es obligatoria.',
            'password.min'       => 'La contraseña debe tener al menos :min caracteres.',
            'password.confirmed' => 'La confirmación de contraseña no coincide.',
            'role.required'      => 'Selecciona un rol.',
            'role.in'            => 'Rol inválido.',
        ]);
        // Crear el usuario en la base de datos
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
             'role'     => $request->role, // Encriptar la contraseña
        ]);

       
     // Redirigir al login con mensaje
        return redirect()
            ->route('login')
            ->with('success', 'Usuario registrado correctamente. Ahora puedes iniciar sesión.');
    }

    }

