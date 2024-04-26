<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DireccionesController extends Controller
{
    public function index()
    {
        return view('agentes.busqueda');
    }

}
