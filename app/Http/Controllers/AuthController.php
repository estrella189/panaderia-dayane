<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login'); // tu blade
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required','email'],
            'password' => ['required','string'],
            'role'     => ['required','in:admin,empleado,cliente'],
        ]);

        // Intento de autenticación sin rol
        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']], $request->boolean('remember'))) {
            $request->session()->regenerate();

           
           /** @var \App\Models\User $user */ 
             $user = Auth::user();

            // Seguridad extra: el rol seleccionado debe coincidir con el rol real
            if ($user->role !== $credentials['role']) {
                Auth::logout();
                return back()
                    ->withErrors(['role' => 'El rol seleccionado no coincide con tu cuenta.'])
                    ->onlyInput('email');
            }

            // Redirección por rol
            if ($user->isAdmin()) {
                return redirect()->intended('/admin/dashboard');
            }
            if ($user->isEmpleado()) {
                return redirect()->intended('/empleado/panel');
            }
            return redirect()->intended('/cliente/inicio');
        }

        return back()->withErrors([
            'email' => 'Credenciales inválidas.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
