<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pedido; // 🔹 Importa tu modelo de pedidos

class EmpleadoController extends Controller
{
  public function panel(Request $request)
    {
        // (opcional) sólo empleado o admin
        $u = Auth::user();
        if (!$u || !in_array($u->role, ['empleado','admin'])) {
            abort(403, 'No tienes permiso.');
        }

        $estado  = $request->query('estado');
        $pedidos = Pedido::when($estado, fn($q)=> $q->where('estado',$estado))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('empleado.panel', compact('pedidos','estado'));
    }

    // === MOSTRAR LISTA DE PEDIDOS ===
    public function pedidosIndex(Request $request)
    {
        // Solo empleados o admin pueden acceder
        $user = Auth::user();
        if (!$user || !in_array($user->role, ['empleado', 'admin'])) {
            abort(403, 'No tienes permiso para acceder.');
        }

        // Filtro opcional por estado
        $estado = $request->get('estado');

        $pedidos = Pedido::when($estado, function ($q) use ($estado) {
                $q->where('estado', $estado);
            })
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('empleado.pedidos.index', compact('pedidos', 'estado'));
    }

    // === VER DETALLE DE UN PEDIDO ===
    public function pedidosShow(Pedido $pedido)
    {
        $user = Auth::user();
        if (!$user || !in_array($user->role, ['empleado', 'admin'])) {
            abort(403, 'No tienes permiso.');
        }

        return view('empleado.pedidos.show', compact('pedido'));
    }

    // === ACTUALIZAR ESTADO (Entregado / Cancelado) ===
    public function pedidosUpdateEstado(Request $request, Pedido $pedido)
    {
        $user = Auth::user();
        if (!$user || !in_array($user->role, ['empleado', 'admin'])) {
            abort(403, 'No tienes permiso.');
        }

        // Validar el estado que llega
        $data = $request->validate([
            'estado' => 'required|in:entregado,cancelado',
        ]);

        // Evitar modificar pedidos cerrados
        if (in_array($pedido->estado, ['entregado', 'cancelado'])) {
            return back()->with('error', 'Este pedido ya está cerrado.');
        }

        $pedido->estado = $data['estado'];
        $pedido->save();

        return back()->with('ok', 'Pedido marcado como: ' . ucfirst($data['estado']));
    }
}
