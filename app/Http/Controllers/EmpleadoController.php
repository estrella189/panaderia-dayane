<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pedido;
use App\Models\User;

class EmpleadoController extends Controller
{
    /**
     * PANEL DEL EMPLEADO
     */
    public function panel(Request $request)
    {
        $u = Auth::user();

        if (!$u || !in_array($u->role, ['empleado', 'admin'])) {
            abort(403);
        }

        $estado = $request->query('estado');

        $pedidos = Pedido::with(['cliente','cotizacion.producto'])
            ->when($u->role === 'admin', fn($q) =>
                $q->whereIn('estado',['entregado','cancelado'])
            )
            ->when($estado && $estado !== 'todos', fn($q) =>
                $q->where('estado',$estado)
            )
            ->latest()
            ->paginate(10);

        return view('empleado.panel', compact('pedidos','estado'));
    }


    /**
     * LISTADO GENERAL (admin ve filtro por empleado)
     */
    public function pedidosIndex(Request $request)
    {
        $user = Auth::user();

        if (!$user || !in_array($user->role,['empleado','admin'])) {
            abort(403);
        }

        $estado     = $request->get('estado');
        $empleadoId = $request->get('empleado_id');

        $empleados = $user->role === 'admin'
            ? User::where('role','empleado')->orderBy('name')->get()
            : collect();

        $pedidos = Pedido::with(['cliente','cotizacion.producto','empleado'])
            ->when($user->role === 'admin', fn($q) =>
                $q->whereIn('estado',['entregado','cancelado'])
            )
            ->when($estado && $estado !== 'todos', fn($q) =>
                $q->where('estado',$estado)
            )
            ->when($user->role === 'admin' && $empleadoId, fn($q) =>
                $q->where('id_empleado',$empleadoId)
            )
            ->latest()
            ->paginate(10);

        return view('empleado.pedidos.index', compact(
            'pedidos','estado','empleados','empleadoId'
        ));
    }


    /**
     * DETALLE
     */
    public function pedidosShow(Pedido $pedido)
    {
        $user = Auth::user();

        if (!$user || !in_array($user->role,['empleado','admin'])) {
            abort(403);
        }

        if ($user->role === 'admin' && !in_array($pedido->estado,['entregado','cancelado'])) {
            abort(403);
        }

        $pedido->loadMissing(['cliente','cotizacion.producto','empleado']);

        return view('empleado.pedidos.show', compact('pedido'));
    }


    /**
     * ACTUALIZAR ESTADO
     */
    public function pedidosUpdateEstado(Request $request, Pedido $pedido)
    {
        $user = Auth::user();

        if (!$user || !in_array($user->role,['empleado','admin'])) {
            abort(403);
        }

        $data = $request->validate([
            'estado' => 'required|in:entregado,cancelado',
        ]);

        if (in_array($pedido->estado,['entregado','cancelado'])) {
            return back()->with('error','Este pedido ya está cerrado.');
        }

        $pedido->estado      = $data['estado'];
        $pedido->id_empleado = $user->id; // 👈 AQUI GUARDAMOS QUIEN LO MARCÓ
        $pedido->save();

        return back()->with('ok','Pedido marcado como: '.ucfirst($data['estado']));
    }
}
