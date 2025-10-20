<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\PedidoItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    // Crea un pedido desde la tarjeta (usa producto_nombre de tus vistas)
    public function crearRapido(Request $request)
    {
        $data = $request->validate([
            'producto_nombre' => ['required','string','max:150'],
            'cantidad'       => ['required','integer','min:1'],
            'fecha_entrega'  => ['nullable','date','after_or_equal:today'],
            'mensaje_pastel' => ['nullable','string','max:255'],
            'tamano'         => ['nullable','string','max:50'],
            'sabor'          => ['nullable','string','max:50'],
        ]);

        return DB::transaction(function () use ($data) {
            $pedido = Pedido::create([
                'user_id'       => Auth::id(),
                'fecha_entrega' => $data['fecha_entrega'] ?? null,
                'notas'         => $data['mensaje_pastel'] ?? null,
                'estado'        => 'pendiente',
                'total'         => 0,
            ]);

            PedidoItem::create([
                'pedido_id'      => $pedido->id,
                'producto_id'    => null,         // sin tabla productos
                'cantidad'       => (int)$data['cantidad'],
                'precio_unit'    => 0,            // si luego agregas precios, actualiza aquí
                'personalizacion'=> [
                    'nombre' => $data['producto_nombre'],
                    'tamano' => $data['tamano'] ?? null,
                    'sabor'  => $data['sabor']  ?? null,
                ],
            ]);

            // total = suma(cantidad * precio_unit)
            $total = $pedido->items()->sum(DB::raw('cantidad * precio_unit'));
            $pedido->update(['total' => $total]);

            return redirect()
                ->route('pedidos.show', $pedido)
                ->with('ok', '¡Tu pedido se creó con éxito! Estado: pendiente.');
        });
    }

    public function index()
    {
        $pedidos = Pedido::where('user_id', Auth::id())
            ->latest()->paginate(10);

        return view('pedidos.index', compact('pedidos'));
    }

    public function show(Pedido $pedido)
    {
        abort_if($pedido->user_id !== Auth::id(), 403);
        $pedido->load('items');
        return view('pedidos.show', compact('pedido'));
    }
}
