<?php

use App\Http\Controllers\PanaderiaDB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\ClienteController;



// Ruta para insertar datos desde los archivos JSON
Route::get('/recuperar-datos', [PanaderiaDB::class, 'recuperarBD']);

Route::get('/mostrar/{nom_tabla}', [PanaderiaDB::class, 'mostrarDatos']);


Route::get('/login', [AuthController::class, 'showLogin'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/admin/dashboard', function () {
    /** @var \App\Models\User|null $u */
    $u = Auth::user();
    abort_unless($u && $u->isAdmin(), 403);
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::get('/empleado/panel', function () {
    /** @var \App\Models\User|null $u */
    $u = Auth::user();
    abort_unless($u && $u->isEmpleado(), 403);
    return view('empleado.panel');
})->name('empleado.panel');

Route::get('/cliente/inicio', function () {
    /** @var \App\Models\User|null $u */
    $u = Auth::user();
    abort_unless($u && $u->isCliente(), 403);
    return view('cliente.inicio');
})->name('cliente.inicio');




Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::get('/index', function () {
    return view('index');
});

Route::get('/Nosotros', function () {
    return view('Nosotros');
});

Route::get('/Mision y Vision', function () {
    return view('Mision y Vision');
});

Route::get('/producto', function () {
    return view('producto');
});

Route::get('/panes_dulces', function () {
    return view('panes_dulces');
});

Route::get('/panes_salados', function () {
    return view('panes_salados');
});

Route::get('/otros', function () {
    return view('otros');
});
Route::get('/contacto', function () {
    return view('contacto');
});




Route::get('/admin/dashboard', function () {
    abort_unless(Auth::check() && Auth::user()?->role === 'admin', 403);
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::resource('productos', ProductoController::class)->names('productos');


Route::middleware(['auth', 'can:view-empleado-panel'])->group(function () {
    Route::get('/empleado', [EmpleadoController::class, 'panel'])->name('empleado.panel');
});

Route::middleware(['auth', 'can:view-cliente-panel'])->group(function () {
    Route::get('/cliente', [ClienteController::class, 'panel'])->name('cliente.inicio');
});
