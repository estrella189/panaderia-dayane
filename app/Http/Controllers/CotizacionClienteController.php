<?php

namespace App\Http\Controllers;

use App\Models\Cotizacion;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CotizacionClienteController extends Controller
{
    public function panel(Request $request)
    {
        $user = Auth::user();

        // ADMIN viendo panel de cliente
        if ($user->role === 'admin') {
            $clienteId = $request->cliente_id;

            if (!$clienteId) {
                return redirect()
                    ->route('admin.clientes.seleccionar')
                    ->with('error', 'Selecciona un cliente.');
            }
        } else {
            // Cliente normal
            $clienteId = $user->id;
        }

        // Datos del cliente
        $pendientes = Cotizacion::where('id_cliente', $clienteId)
            ->where('estado','pendiente')
            ->count();

        $cotizadas = Cotizacion::where('id_cliente', $clienteId)
            ->where('estado','cotizado')
            ->count();

        $ultimas = Cotizacion::with(['producto','pedido'])
            ->where('id_cliente',$clienteId)
            ->orderByDesc('created_at')
            ->get();

        $pedidos = Pedido::where('id_cliente', $clienteId)
            ->orderByDesc('created_at')
            ->get();

        // ADMIN → Vista especial de SOLO LISTAS
        if ($user->role === 'admin') {
            return view('admin.clientes.panel',
                compact('pendientes','cotizadas','ultimas','pedidos'));
        }

        // CLIENTE → Vista normal
        return view('cliente.inicio',
            compact('pendientes','cotizadas','ultimas','pedidos'));
    }

    public function index(Request $request)
    {
        $cotizaciones = Cotizacion::with(['producto','pedido'])
            ->where('id_cliente', Auth::id())
            ->orderByDesc('created_at')
            ->paginate(12);

        return view('cliente.cotizaciones.index', compact('cotizaciones'));
    }

    public function show(Cotizacion $cotizacion)
    {
        if ($cotizacion->id_cliente !== Auth::id()) abort(403);

        $cotizacion->load(['producto','pedido']);

        return view('cliente.cotizaciones.show', compact('cotizacion'));
    }

    public function confirmarPedido(Request $request, Cotizacion $cotizacion)
    {
        if ($cotizacion->id_cliente !== Auth::id()) abort(403);

        if ($cotizacion->estado !== 'cotizado' || is_null($cotizacion->precio)) {
            return back()->with('error', 'Aún no ha sido cotizada por el administrador.');
        }

        if ($cotizacion->pedido) {
            return back()->with('ok', 'Este pedido ya fue creado.');
        }

        DB::transaction(function () use ($cotizacion) {
            Pedido::create([
                'id_cliente'   => $cotizacion->id_cliente,
                'id_cotizacion'=> $cotizacion->id,
                'estado'       => 'pendiente',
            ]);
        });

        return redirect()->route('cliente.cotizaciones.index')->with('ok', 'Pedido creado correctamente.');
    }
    public function edit(Cotizacion $cotizacion)
{
    if ($cotizacion->id_cliente !== Auth::id()) {
        abort(403);
    }

    if ($cotizacion->pedido) {
        return redirect()
            ->route('cliente.cotizaciones.show', $cotizacion->id)
            ->with('error', 'Esta cotización ya tiene un pedido asociado y no se puede editar.');
    }

    $cotizacion->load('producto');

    return view('cliente.cotizaciones.edit', compact('cotizacion'));
}

public function update(Request $request, Cotizacion $cotizacion)
{
    if ($cotizacion->id_cliente !== Auth::id()) {
        abort(403);
    }

    if ($cotizacion->pedido) {
        return redirect()
            ->route('cliente.cotizaciones.show', $cotizacion->id)
            ->with('error', 'Esta cotización ya tiene un pedido asociado y no se puede editar.');
    }

    $validated = $request->validate([
        'mensaje' => 'required|string|max:500',
    ]);

    $cotizacion->update([
        'mensaje' => $validated['mensaje'],
        'estado'  => 'pendiente',
        'precio'  => null,
    ]);

    return redirect()
        ->route('cliente.cotizaciones.show', $cotizacion->id)
        ->with('ok', 'La cotización se actualizó. El administrador la revisará nuevamente.');
}

}
