<?php

namespace App\Http\Controllers;

use App\Models\Cotizacion;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CotizacionClienteController extends Controller

{
 public function panel()
{
    $clienteId  = Auth::id();

    $pendientes = Cotizacion::where('id_cliente',$clienteId)
                    ->where('estado','pendiente')->count();

    $cotizadas  = Cotizacion::where('id_cliente',$clienteId)
                    ->where('estado','cotizado')->count();

    $ultimas    = Cotizacion::with(['producto','pedido'])
                    ->where('id_cliente',$clienteId)
                    ->latest()->take(5)->get();

    // usa la vista que corresponda: cliente.inicio o cliente.panel
    return view('cliente.inicio', compact('pendientes','cotizadas','ultimas'));
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

        // Solo se puede confirmar si ya está cotizada y con precio
        if ($cotizacion->estado !== 'cotizado' || is_null($cotizacion->precio)) {
            return back()->with('error', 'Aún no ha sido cotizada por el administrador.');
        }

        // Evitar duplicados: si ya existe pedido para esta cotización, no crear otro
        if ($cotizacion->pedido) {
            return back()->with('ok', 'Este pedido ya fue creado.');
        }

        DB::transaction(function () use ($cotizacion) {
            Pedido::create([
                'id_cliente'   => $cotizacion->id_cliente,
                'id_cotizacion'=> $cotizacion->id,
                'estado'       => 'pendiente', // según tu enum
            ]);

            // Si quieres marcar la cotización como "aceptada", agrega otro estado en tu enum.
            // $cotizacion->update(['estado' => 'aceptada']);
        });

        return redirect()->route('cliente.cotizaciones.index')->with('ok', 'Pedido creado correctamente.');
    }
}
