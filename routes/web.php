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
use App\Models\User;




// Ruta para insertar datos desde los archivos JSON
Route::get('/recuperar-datos', [PanaderiaDB::class, 'recuperarBD']);

Route::get('/mostrar/{nom_tabla}', [PanaderiaDB::class, 'mostrarDatos']);


Route::get('/login', [AuthController::class, 'showLogin'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


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

Route::get('/otros', fn() => view('otros'))->name('otros');
Route::get('/otros.html', fn() => redirect('/otros'));

Route::get('/contacto', fn() => view('contacto'))->name('contacto');
Route::get('/contacto.html', fn() => redirect('/contacto'));

Route::get('/Términos y Condiciones', fn() => view('Términos y Condiciones'))->name('Términos y Condiciones');
Route::get('/Términos y Condiciones.html', fn() => redirect('/Términos y Condiciones'));    



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

    // CLIENTE: ver mis cotizaciones
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

    Route::get('/mis-cotizaciones/{cotizacion}/editar', [CotizacionClienteController::class, 'edit'])
    ->name('cliente.cotizaciones.edit');

Route::put('/mis-cotizaciones/{cotizacion}', [CotizacionClienteController::class, 'update'])
    ->name('cliente.cotizaciones.update');


    
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



// ==========================
// ADMIN: Seleccionar cliente
// ==========================
Route::middleware(['auth'])->group(function () {

    // Vista con la lista de clientes
    Route::get('/admin/clientes/seleccionar', function () {
        $u = Auth::user();
        abort_unless($u && $u->role === 'admin', 403);

        $clientes = User::where('role', 'cliente')
            ->orderBy('name')
            ->get();

        return view('admin.clientes.seleccionar', compact('clientes'));
    })->name('admin.clientes.seleccionar');

    // Mostrar panel del cliente con cliente_id (ADMIN O CLIENTE)
    Route::get('/cliente/panel', [CotizacionClienteController::class, 'panel'])
        ->name('cliente.panel');
});

// =========================
// MÓDULO: Mis pedidos cliente
// =========================
Route::middleware('auth')->prefix('cliente')->group(function () {

    // Listado de pedidos
    Route::get('/mis-pedidos', [PedidoController::class, 'index'])
        ->name('cliente.pedidos.index');

    // Ver detalle de un pedido
    Route::get('/mis-pedidos/{pedido}', [PedidoController::class, 'show'])
        ->name('cliente.pedidos.show');
});
Route::get('/admin/pedidos/por-empleado', 
    [EmpleadoController::class, 'pedidosIndex']
)->middleware('auth')->name('admin.pedidos.porEmpleado');

// Mostrar formulario de restaurar contraseña
Route::get('/restablecer', function () {
    return view('auth.reset-simple');
})->name('password.request');

// Guardar nueva contraseña
Route::post('/restablecer', function (Illuminate\Http\Request $request) {
    $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required', 'confirmed', 'min:6']
    ]);

    $user = \App\Models\User::where('email', $request->email)->first();

    if (!$user) {
        return back()->withErrors(['email' => 'No existe un usuario con ese correo.']);
    }

    $user->password = \Illuminate\Support\Facades\Hash::make($request->password);
    $user->save();

    return redirect()->route('login.form')->with('status', 'Contraseña actualizada correctamente.');
})->name('password.update');

use App\Models\Producto;

Route::get('/panes_dulces', function () {
   
    $productos = Producto::where('id_subcategoria', 1)->get();

    return view('panes_dulces', compact('productos'));
})->name('panes_dulces');

Route::get('/panes_salados', function () {
   
    $productos = Producto::where('id_subcategoria', 2)->get();

    return view('panes_salados', compact('productos'));
})->name('panes_salados');


Route::get('/coca', function () {
   
    $productos = Producto::where('id_subcategoria', 10)->get();

    return view('coca', compact('productos'));
})->name('coca');

Route::get ('/hidratantes', function () {
   
    $productos = Producto::where('id_subcategoria', 11)->get();

    return view('hidratantes', compact('productos'));
})->name('hidratantes');

Route::get ('/leche', function () {
   
    $productos = Producto::where('id_subcategoria', 9)->get();

    return view('leche', compact('productos'));
})->name('leche');