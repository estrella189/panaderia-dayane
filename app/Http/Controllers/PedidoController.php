<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\Producto;
use App\Models\Productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    public function __construct()
    {
        // Solo usuarios autenticados pueden hacer pedidos
        $this->middleware('auth');
    }

    /**
     * Método para crear pedidos rápidos desde la vista de pasteles
     */
    public function crearRapido(Request $request)
    {
        // Validación de los datos del formulario
        $data = $request->validate([
            'producto_nombre' => ['required', 'string', 'max:150'],
            'cantidad'        => ['required', 'integer', 'min:1'],
            'fecha_entrega'   => ['required', 'date'],
            'notas'           => ['nullable', 'string', 'max:500'],
            'tamanio'         => ['nullable', 'string', 'max:50'],
            'sabor'           => ['nullable', 'string', 'max:50'],
        ]);

        $user = $request->user();

        // Buscar el producto en la base de datos (opcional)
        $producto = Producto::where('nombre', $data['producto_nombre'])->first();
        $precio   = $producto->precio ?? 0;

        // Crear el pedido y su ítem dentro de una transacción
        return DB::transaction(function () use ($user, $data, $producto, $precio) {
            $subtotal = $precio * $data['cantidad'];

            // Crear el pedido principal
            $pedido = Pedido::create([
                'user_id'       => $user->id,
                'fecha_entrega' => $data['fecha_entrega'],
                'notas'         => $data['notas'] ?? null,
                'estado'        => 'pendiente',
                'total'         => $subtotal,
            ]);

            // Redirigir con mensaje de éxito
            return redirect()
                ->back()
                ->with('ok', '¡Tu pedido fue registrado exitosamente! #'.$pedido->id);
        });
    }

    /**
     * Método genérico para pedidos con producto_id (si en el futuro lo usas)
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'producto_id'   => ['required','integer','exists:productos,id'],
            'cantidad'      => ['required','integer','min:1'],
            'fecha_entrega' => ['required','date'],
            'notas'         => ['nullable','string','max:500'],
            'tamanio'       => ['nullable','string','max:50'],
            'sabor'         => ['nullable','string','max:50'],
        ]);

        $user = $request->user();
        $producto = Producto::findOrFail($data['producto_id']);
        $precio = $producto->precio ?? 0;

        return DB::transaction(function () use ($user, $data, $precio, $producto) {
            $subtotal = $precio * $data['cantidad'];

            $pedido = Pedido::create([
                'user_id'       => $user->id,
                'fecha_entrega' => $data['fecha_entrega'],
                'notas'         => $data['notas'] ?? null,
                'estado'        => 'pendiente',
                'total'         => $subtotal,
            ]);

            return redirect()
                ->back()
                ->with('ok', '¡Tu pedido fue registrado exitosamente! #'.$pedido->id);
        });
    }
    
}
