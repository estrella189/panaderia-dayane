<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  
use App\Models\productos;
use App\Models\categorias;
use Illuminate\Support\Facades\Route;


class ProductoController extends Controller
{
    public function __construct()
    {
        // Proteger TODO el CRUD para solo ADMIN (sin tocar Kernel)
        $this->middleware(function ($request, $next) {
            /** @var \App\Models\User|null $u */
            $u = Auth::user();
            if (!Auth::check() || !$u || $u->role !== 'admin') {
                abort(403);
            }
            return $next($request);
        });
    }

    // Listar productos
    public function index()
    {
        $productos = productos::with('categoria')->get();
        return view('productos.index', compact('productos'));
    }

    // Form crear
    public function create()
    {
        $categorias = categorias::all();
        return view('productos.create', compact('categorias'));
    }

    // Guardar
    public function store(Request $request)
    {
        $request->validate([
            'Nombre'      => 'required|string|max:255',
            'Descripcion' => 'nullable|string',
            'Precio'      => 'required|numeric',
            'Stock'       => 'required|integer',
            'IdCategoria' => 'required|exists:categorias,IdCategoria',
        ]);

        productos::create($request->all());

        return redirect()->route('productos.index')
            ->with('success', 'Producto agregado correctamente.');
    }

    // Form editar
    public function edit($id)
    {
        $producto   = productos::findOrFail($id);
        $categorias = categorias::all();
        return view('productos.edit', compact('producto', 'categorias'));
    }

    // Actualizar
    public function update(Request $request, $id)
    {
        $request->validate([
            'Nombre'      => 'required|string|max:255',
            'Descripcion' => 'nullable|string',
            'Precio'      => 'required|numeric',
            'Stock'       => 'required|integer',
            'IdCategoria' => 'required|exists:categorias,IdCategoria',
        ]);

        $producto = productos::findOrFail($id);
        $producto->update($request->all());

        return redirect()->route('productos.index')
            ->with('success', 'Producto actualizado correctamente.');
    }

    // Eliminar
    public function destroy($id)
    {
        $producto = productos::findOrFail($id);
        $producto->delete();

        return redirect()->route('productos.index')
            ->with('success', 'Producto eliminado correctamente.');
    }
}
