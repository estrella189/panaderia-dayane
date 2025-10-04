<?php

// app/Http/Controllers/EmpleadoController.php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class EmpleadoController extends Controller {
    public function panel() {
        return view('empleado.panel'); // tu vista con lista y botones Entregado/Cancelado
    }
}

