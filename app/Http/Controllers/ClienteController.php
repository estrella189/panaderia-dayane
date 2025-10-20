<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- IMPORTANTE

class ClienteController extends Controller
{
    public function panel()
    {
        $ultimo = Pedido::where('user_id', Auth::id())  // <- usa el facade
            ->latest('id')                              // explícita la columna
            ->first();

        return view('cliente.inicio', [
            'ultimoPedido' => $ultimo,
        ]);
    }
}

