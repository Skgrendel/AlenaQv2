<?php

namespace App\Http\Controllers;

class AsignadosController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function Asignados()
    {
        return view('agentes.asignados.index');
    }

    public function Entregados()
    {
        return view('auditoria.entregado');
    }
}
