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
            ->where('estado', 'pendiente')
            ->count();

        $cotizadas = Cotizacion::where('id_cliente', $clienteId)
            ->where('estado', 'cotizado')
            ->count();

        $ultimas = Cotizacion::with(['producto', 'pedido'])
            ->where('id_cliente', $clienteId)
            ->orderByDesc('created_at')
            ->get();

        $pedidos = Pedido::where('id_cliente', $clienteId)
            ->orderByDesc('created_at')
            ->get();

        // ADMIN → Vista especial
        if ($user->role === 'admin') {
            return view('admin.clientes.panel',
                compact('pendientes', 'cotizadas', 'ultimas', 'pedidos'));
        }

        // CLIENTE → Vista normal
        return view('cliente.inicio',
            compact('pendientes', 'cotizadas', 'ultimas', 'pedidos'));
    }

    public function index(Request $request)
    {
        $cotizaciones = Cotizacion::with(['producto', 'pedido'])
            ->where('id_cliente', Auth::id())
            ->orderByDesc('created_at')
            ->paginate(12);

        return view('cliente.cotizaciones.index', compact('cotizaciones'));
    }

    public function show(Cotizacion $cotizacion)
    {
        if ($cotizacion->id_cliente !== Auth::id()) {
            abort(403);
        }

        $cotizacion->load(['producto', 'pedido']);

        return view('cliente.cotizaciones.show', compact('cotizacion'));
    }

    public function confirmarPedido(Request $request, Cotizacion $cotizacion)
    {
        if ($cotizacion->id_cliente !== Auth::id()) {
            abort(403);
        }

        if ($cotizacion->estado !== 'cotizado' || is_null($cotizacion->precio)) {
            return back()->with('error', 'Aún no ha sido cotizada por el administrador.');
        }

        if ($cotizacion->pedido) {
            return back()->with('ok', 'Este pedido ya fue creado.');
        }

        DB::transaction(function () use ($cotizacion) {
            Pedido::create([
                'id_cliente'    => $cotizacion->id_cliente,
                'id_cotizacion' => $cotizacion->id,
                'estado'        => 'pendiente',
            ]);
        });

        return redirect()
            ->route('cliente.cotizaciones.index')
            ->with('ok', 'Pedido creado correctamente.');
    }

    public function edit(Cotizacion $cotizacion)
    {
        if ($cotizacion->id_cliente !== Auth::id()) {
            abort(403);
        }

        // Si ya tiene pedido, no se puede editar
        if ($cotizacion->pedido) {
            return redirect()
                ->route('cliente.cotizaciones.show', $cotizacion->id)
                ->with('error', 'Esta cotización ya tiene un pedido asociado y no se puede editar.');
        }

        $cotizacion->load('producto');

        // 👇 EXTRAEMOS LOS DATOS DESDE "detalles"
        $datos = [
            'cantidad'      => null,
            'fecha_entrega' => null,
            'tamano'        => null,
            'sabor'         => null,
            'mensaje'       => null,
        ];

        if (!empty($cotizacion->detalles)) {
            $partes = explode(' | ', $cotizacion->detalles);

            foreach ($partes as $parte) {
                $parte = trim($parte);

                if (strpos($parte, 'Cantidad: ') === 0) {
                    $datos['cantidad'] = trim(substr($parte, strlen('Cantidad: ')));
                } elseif (strpos($parte, 'Fecha entrega: ') === 0) {
                    $datos['fecha_entrega'] = trim(substr($parte, strlen('Fecha entrega: ')));
                } elseif (strpos($parte, 'Tamaño: ') === 0) {
                    $datos['tamano'] = trim(substr($parte, strlen('Tamaño: ')));
                } elseif (strpos($parte, 'Sabor: ') === 0) {
                    $datos['sabor'] = trim(substr($parte, strlen('Sabor: ')));
                } elseif (strpos($parte, 'Mensaje: ') === 0) {
                    $datos['mensaje'] = trim(substr($parte, strlen('Mensaje: ')));
                }
            }
        }

        return view('cliente.cotizaciones.edit', compact('cotizacion', 'datos'));
    }

    public function update(Request $request, Cotizacion $cotizacion)
    {
        if ($cotizacion->id_cliente !== Auth::id()) {
            abort(403);
        }

        // Seguridad extra: si ya hay pedido asociado, no permitir cambios
        if ($cotizacion->pedido) {
            return redirect()
                ->route('cliente.cotizaciones.show', $cotizacion->id)
                ->with('error', 'Esta cotización ya tiene un pedido asociado y no se puede editar.');
        }

        // Validamos los campos del formulario
        $request->validate([
            'cantidad'      => 'required|integer|min:1',
            'tamano'        => 'required|string',
            'sabor'         => 'required|string',
            'fecha_entrega' => 'required|date',
            'detalles'      => 'nullable|string',
        ]);

        // Mensaje opcional
        $mensaje = $request->detalles;

        // Reconstruimos el texto para la columna "detalles"
        $detalles = "Cantidad: {$request->cantidad} | Fecha entrega: {$request->fecha_entrega} | Tamaño: {$request->tamano} | Sabor: {$request->sabor}";

        if (!empty($mensaje)) {
            $detalles .= " | Mensaje: {$mensaje}";
        }

        // Solo columnas que existen
        $cotizacion->detalles = $detalles;
        $cotizacion->estado   = 'pendiente';
        $cotizacion->precio   = null;

        $cotizacion->save();

        return redirect()
            ->route('cliente.cotizaciones.show', $cotizacion->id)
            ->with('ok', 'Cotización actualizada y enviada de nuevo para revisión.');
    }
}
