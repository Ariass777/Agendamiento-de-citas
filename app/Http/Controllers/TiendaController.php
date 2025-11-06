<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TiendaController extends Controller
{
    public function index()
    {
        // Esto devolverá la vista que crearemos en el siguiente paso
        return view('tienda.index');
    }
}