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
        'name'     => ['required', 'string'],
        'email'    => ['required','email'],
        'password' => ['required','string'],
    ]);

    // Buscar el usuario por email
    $user = \App\Models\User::where('email', $credentials['email'])->first();

    // Verificar credenciales
    if ($user && $user->name === $credentials['name'] && Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
        $request->session()->regenerate();

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
