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
    // Validar nombre, correo y contraseña
    $credentials = $request->validate([
        'email'    => ['required','email'],
        'password' => ['required','string'],
    ]);



  // Intentar iniciar sesión
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

        switch ($user->role) {
            case 'admin':
                return redirect()->intended(route('admin.dashboard'));
            case 'empleado':
                return redirect()->intended(route('empleado.panel'));
            default:
                return redirect()->intended(route('cliente.inicio'));
        }
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
