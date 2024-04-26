<?php

namespace App\Http\Controllers;


use App\Models\reportes;
use Illuminate\Http\Request;

class FuntionController extends Controller
{
    public function BuscarContrato($id)
    {
        $contrato = reportes::where('contrato', $id)->first(); // Busca el contrato con ese id


        if ($contrato) {
            $src = $contrato->latitud . ',' . $contrato->longitud;
            return response()->json(['src' => $src, 'contrato' => $contrato]); // Si el contrato existe, devuelve sus datos como JSON
        } else {
            return response()->json(['error' => 'Contrato no encontrado'], 404); // Si no existe, devuelve un error
        }
    }
}
