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

use App\Http\Controllers\CotizacionController;




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

Route::get('/index', fn() => view('index'))->name('index');
Route::get('/index.html', fn() => redirect('/index'));

Route::get('/Nosotros', fn() => view('Nosotros'))->name('Nosotros');
Route::get('/Nosotros.html', fn() => redirect('/Nosotros'));

Route::get('Mision y Vision', fn() => view('Mision y Vision'))->name('Mision y Vision');
Route::get('Mision y Vision.html', fn() => redirect('/Mision y Vision'));

Route::get('/producto', fn() => view('producto'))->name('producto');
Route::get('/producto.html', fn() => redirect('/producto'));

Route::get('/panes_dulces',fn() => view('panes_dulces'))->name('panes_dulces');
Route::get('/panes_dulces.html', fn() => redirect('/panes_dulces'));

Route::get('/panes_salados', fn() => view('panes_salados'))->name('panes_salados');
Route::get('/panes_salados.html', fn() => redirect('/panes_salados'));

Route::get('/otros', fn() => view('otros'))->name('otros');
Route::get('/otros.html', fn() => redirect('/otros'));

Route::get('/contacto', fn() => view('contacto'))->name('contacto');
Route::get('/contacto.html', fn() => redirect('/contacto'));


Route::get('/admin/dashboard', function () {
    abort_unless(Auth::check() && Auth::user()?->role === 'admin', 403);
    return view('admin.dashboard');
})->name('admin.dashboard');


Route::get('/Rollos y Variedades', fn() => view('Rollos y Variedades'))->name('Rollos y Variedades');
Route::get('/Rollos y Variedades.html', fn() => redirect('/Rollos y Variedades'));

Route::get('/productos de temporada', fn() => view('productos de temporada'))->name('productos de temporada');
Route::get('/productos de temporada.html', fn() => redirect('/productos de temporada'));

Route::get('/pasteles de chocolate', fn() => view('pasteles de chocolate'))->name('pasteles de chocolate');
Route::get('/pasteles de chocolate.html', fn() => redirect('/pasteles de chocolate'));

Route::get('/Para Eventos', fn() => view('Para Eventos'))->name('Para Eventos');
Route::get('/Para Eventos.html', fn() => redirect('/Para Eventos'));

Route::get('/pasteles de frutas', fn() => view('pasteles de frutas'))->name('pasteles de frutas');
Route::get('/pasteles de frutas.html', fn() => redirect('/pasteles de frutas'));

Route::get('/leche', fn() => view('leche'))->name('leche');
Route::get('/leche.html', fn() => redirect('/leche'));

Route::get('/coca', fn() => view('coca'))->name('coca');
Route::get('/coca.html', fn() => redirect('/coca'));

Route::get('/hidratantes', fn() => view('hidratantes'))->name('hidratantes');
Route::get('/hidratantes.html', fn() => redirect('/hidratantes'));


use App\Http\Controllers\PedidoController;

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


// Cliente logueado puede ver las categorias de los pasteles
Route::middleware('auth')->group(function () {
    Route::get('/pasteles/{categoria}', [ProductoController::class, 'publicoPorCategoria'])
        ->name('productos.publico');
});



Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // DASHBOARD
    Route::get('/dashboard', function () {
        $user = Auth::user();
        if ($user->role !== 'admin') {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
    Route::get('/productos/create', [ProductoController::class, 'create'])->name('productos.create');
    Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
    Route::get('/productos/{producto}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
    Route::put('/productos/{producto}', [ProductoController::class, 'update'])->name('productos.update');
    Route::delete('/productos/{producto}', [ProductoController::class, 'destroy'])->name('productos.destroy');

});
// AJAX para obtener subcategorías según categoría
Route::get('/subcategorias/{id}', [ProductoController::class, 'getSubcategorias']);






Route::middleware(['auth'])->group(function () {
    // CLIENTE: enviar cotización
    Route::post('/cotizaciones', [CotizacionController::class, 'store'])
        ->name('cotizaciones.store');

    // (opcional) ver mis cotizaciones
    Route::get('/mis-cotizaciones', [CotizacionController::class, 'misCotizaciones'])
        ->name('cotizaciones.mias');
});
Route::get('/cotizaciones/{cotizacion}', [CotizacionController::class, 'show'])
    ->name('cotizaciones.show');


// ADMIN (solo lectura/respuesta)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/cotizaciones', [CotizacionController::class, 'index'])->name('cotizaciones.index');
    Route::get('/cotizaciones/{cotizacion}', [CotizacionController::class, 'show'])->name('cotizaciones.show');
    Route::post('/cotizaciones/{cotizacion}/responder', [CotizacionController::class, 'responder'])->name('cotizaciones.responder');
});

use App\Http\Controllers\CotizacionClienteController;

Route::middleware(['auth'])->group(function () {
    Route::get('/mis-cotizaciones', [CotizacionClienteController::class, 'index'])
        ->name('cliente.cotizaciones.index');

    Route::get('/mis-cotizaciones/{cotizacion}', [CotizacionClienteController::class, 'show'])
        ->name('cliente.cotizaciones.show');

    Route::post('/mis-cotizaciones/{cotizacion}/confirmar', [CotizacionClienteController::class, 'confirmarPedido'])
        ->name('cliente.cotizaciones.confirmar');
});


Route::middleware(['auth'])->prefix('empleado')->name('empleado.')->group(function () {
    Route::get('/', [EmpleadoController::class, 'panel'])->name('home'); // 👈 NUEVA
    Route::get('/panel', [EmpleadoController::class, 'panel'])->name('panel');

    Route::get('/pedidos', [EmpleadoController::class, 'pedidosIndex'])->name('pedidos.index');
    Route::get('/pedidos/{pedido}', [EmpleadoController::class, 'pedidosShow'])->name('pedidos.show');
    Route::patch('/pedidos/{pedido}/estado', [EmpleadoController::class, 'pedidosUpdateEstado'])->name('pedidos.estado');
});


Route::middleware(['auth'])->prefix('cliente')->name('cliente.')->group(function () {
    // /cliente  -> controlador que SÍ envía $pendientes, $cotizadas, $ultimas
    Route::get('/', [CotizacionClienteController::class,'panel'])->name('panel');

    // /cliente/panel -> compatibilidad, redirige a /cliente
    Route::get('/panel', fn () => redirect()->route('cliente.panel'));
});



