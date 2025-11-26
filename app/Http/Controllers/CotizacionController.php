<?php

namespace App\Http\Controllers;

use App\Models\Cotizacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RespuestaCotizacion;
use Illuminate\Support\Facades\DB;

class CotizacionController extends Controller
{
    /**
     * Cliente crea una cotización.
     * Acepta producto_id o producto_nombre (lo resuelve a id).
     */
    public function store(Request $request)
    {
      $data = $request->validate([
    'producto_id'     => ['nullable','integer','exists:productos,id'],
    'producto_nombre' => ['nullable','string','max:150'],
    'cantidad'        => ['nullable','integer','min:1'],
    'fecha_entrega' => ['required','date','after_or_equal:today'],
    'mensaje_pastel'  => ['nullable','string','max:255'],
    'tamano'          => ['nullable','string','max:50'],
    'sabor'           => ['nullable','string','max:50'],
    'detalles'        => ['nullable','string','max:2000'],
    ], [
        'fecha_entrega.after_or_equal' => 'La fecha de entrega debe ser hoy o una fecha futura.',
    ]);


        // Resolver id_producto si solo mandaron nombre (útil para tu página estática de pasteles)
        $productoId = $data['producto_id'] ?? null;

        if (!$productoId && !empty($data['producto_nombre'])) {
            $producto = \App\Models\Producto::where('nombre', $data['producto_nombre'])->first();
            if ($producto) {
                $productoId = $producto->id;
            } else {
                // Si no existe, puedes abortar o crear un "producto genérico". Aquí abortamos con mensaje claro.
                return back()->with('error', 'No se encontró el producto "'.$data['producto_nombre'].'". Verifica el catálogo.');
            }
        }

        if (!$productoId) {
            return back()->with('error', 'Falta el producto a cotizar.');
        }

        // Construimos "detalles" legibles con lo que venga
        $partes = [];
        if (!empty($data['detalles']))         $partes[] = $data['detalles'];
        if (!empty($data['cantidad']))         $partes[] = "Cantidad: ".$data['cantidad'];
        if (!empty($data['fecha_entrega']))    $partes[] = "Fecha entrega: ".$data['fecha_entrega'];
        if (!empty($data['tamano']))           $partes[] = "Tamaño: ".$data['tamano'];
        if (!empty($data['sabor']))            $partes[] = "Sabor: ".$data['sabor'];
        if (!empty($data['mensaje_pastel']))   $partes[] = "Mensaje: ".$data['mensaje_pastel'];

        $detalles = trim(implode(' | ', $partes));

        Cotizacion::create([
            'id_cliente' => Auth::id(),
            'id_producto'=> $productoId,
            'detalles'   => $detalles ?: null,
            'precio'     => null,
            'estado'     => 'pendiente',
        ]);

        return back()->with('ok', '¡Solicitud de cotización enviada! Te avisaremos cuando el admin responda.');
    }

    // ADMIN: listado
    public function index()
    {
        $user = Auth::user();
        if ($user->role !== 'admin') abort(403);

        $cotizaciones = Cotizacion::with(['cliente','producto'])
            ->orderByRaw("FIELD(estado,'pendiente','cotizado')")
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('admin.cotizaciones.index', compact('cotizaciones'));
    }

    // ADMIN: detalle
    public function show(Cotizacion $cotizacion)
    {
        $user = Auth::user();
        if ($user->role !== 'admin') abort(403);

        $cotizacion->load(['cliente','producto']);
        return view('admin.cotizaciones.show', compact('cotizacion'));
    }

 public function responder(Request $request, Cotizacion $cotizacion)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Solo administradores');
        }

        $data = $request->validate([
            'precio'          => ['required','numeric','min:0'],
            'respuesta_extra' => ['nullable','string','max:1000'],
        ]);

        DB::transaction(function () use ($cotizacion, $data) {
            // 1) Actualizar la cotización principal
            $cotizacion->update([
                'precio' => $data['precio'],
                'estado' => 'cotizado',
            ]);

            // 2) Insertar registro en respuesta_cotizacion
            RespuestaCotizacion::create([
                'cotizacion_id'  => $cotizacion->id,
                'admin_id'       => Auth::id(),
                'precio_total'   => $data['precio'],
                'mensaje_admin'  => $data['respuesta_extra'] ?? null,
                'fecha_respuesta'=> now(),
            ]);
        });

        return redirect()
            ->route('admin.cotizaciones.show', $cotizacion)
            ->with('ok', 'Cotización enviada correctamente.');
    }
    // CLIENTE: ver mis cotizaciones (opcional)
    public function misCotizaciones()
    {
        $cotizaciones = Cotizacion::with('producto')
            ->where('id_cliente', Auth::id())
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('cotizaciones.mias', compact('cotizaciones'));
    }
}
