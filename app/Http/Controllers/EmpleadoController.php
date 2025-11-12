<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pedido;

class EmpleadoController extends Controller
{
    /**
     * PANEL PRINCIPAL DEL EMPLEADO
     */
    public function panel(Request $request)
    {
        $u = Auth::user();

        // Solo empleado o admin pueden entrar
        if (!$u || !in_array($u->role, ['empleado', 'admin'])) {
            abort(403, 'No tienes permiso.');
        }

        $estado = $request->query('estado');

        // Cliente (users) + Cotización con su Producto
        $pedidos = Pedido::with(['cliente', 'cotizacion.producto'])
            ->when($estado, fn($q) => $q->where('estado', $estado))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('empleado.panel', compact('pedidos', 'estado'));
    }

    /**
     * LISTA COMPLETA DE PEDIDOS
     */
    public function pedidosIndex(Request $request)
    {
        $user = Auth::user();

        if (!$user || !in_array($user->role, ['empleado', 'admin'])) {
            abort(403, 'No tienes permiso para acceder.');
        }

        $estado = $request->get('estado');

        $pedidos = Pedido::with(['cliente', 'cotizacion.producto'])
            ->when($estado, fn($q) => $q->where('estado', $estado))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('empleado.pedidos.index', compact('pedidos', 'estado'));
    }

    /**
     * VER DETALLE DE UN PEDIDO
     */
    public function pedidosShow(Pedido $pedido)
    {
        $user = Auth::user();

        if (!$user || !in_array($user->role, ['empleado', 'admin'])) {
            abort(403, 'No tienes permiso.');
        }

        // Carga relaciones si no están ya cargadas (incluye producto)
        $pedido->loadMissing(['cliente', 'cotizacion.producto']);

        return view('empleado.pedidos.show', compact('pedido'));
    }

    /**
     * ACTUALIZAR ESTADO (Entregado / Cancelado)
     */
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

        // Actualizar el estado del pedido
        $pedido->estado = $data['estado'];
        $pedido->save();

        return back()->with('ok', 'Pedido marcado como: ' . ucfirst($data['estado']));
    }
}
