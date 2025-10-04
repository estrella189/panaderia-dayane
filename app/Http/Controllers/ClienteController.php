<?php

// app/Http/Controllers/ClienteController.php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ClienteController extends Controller {
    public function panel() {
        return view('cliente.inicio'); // tu vista simple para cliente
    }
}
