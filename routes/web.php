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

Route::get('/Rollos y Variedades', function () {
    return view('Rollos y Variedades');
});
Route::get('/productos de temporada', function () {
    return view('productos de temporada');
});
Route::get('/pasteles de chocolate', function () {
    return view('pasteles de chocolate');
});
Route::get('/Para Eventos', function () {
    return view('Para Eventos');
});

Route::get('/pasteles de frutas', function () {
    return view('pasteles de frutas');
});


use App\Http\Controllers\PedidoController;

Route::get('/catalogo', [ProductoController::class, 'catalogo'])->name('catalogo');

// Crear pedido (SOLO logueados)
Route::post('/pedidos', [PedidoController::class, 'store'])
    ->middleware('auth')
    ->name('pedidos.store');


Route::middleware(['auth'])->group(function () {
  Route::post('/pedidos/crear-rapido', [PedidoController::class, 'crearRapido'])->name('pedidos.crear_rapido');
  Route::get('/mis-pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
  Route::get('/mis-pedidos/{pedido}', [PedidoController::class, 'show'])->name('pedidos.show');
});

// Catálogos por categoría
Route::get('/pasteles/{categoria}', [ProductoController::class, 'index'])
     ->name('productos.publico');

// Mis pedidos del cliente
Route::middleware('auth')->group(function () {
    Route::get('/mis-pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
    Route::get('/mis-pedidos/{pedido}', [PedidoController::class, 'show'])->name('pedidos.show');
});


// Cliente logueado puede ver chocolate/eventos/temporada
Route::middleware('auth')->group(function () {
    Route::get('/pasteles/{categoria}', [ProductoController::class, 'publicoPorCategoria'])
        ->name('productos.publico');
    Route::get('/catalogo', [ProductoController::class, 'catalogo'])
        ->name('catalogo');
});

// CRUD solo admin
Route::middleware(['auth','role:admin'])->group(function () {
    Route::get('/admin/productos', [ProductoController::class, 'index'])->name('productos.index');
    Route::get('/admin/productos/create', [ProductoController::class, 'create'])->name('productos.create');
    Route::post('/admin/productos', [ProductoController::class, 'store'])->name('productos.store');
    Route::get('/admin/productos/{id}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
    Route::put('/admin/productos/{id}', [ProductoController::class, 'update'])->name('productos.update');
    Route::delete('/admin/productos/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');
});
