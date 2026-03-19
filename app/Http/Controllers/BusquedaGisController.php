<?php

namespace App\Http\Controllers;

use App\Services\coordinador\DataGisServices;
use Illuminate\Http\Request;

class BusquedaGisController extends Controller
{
    protected $gisService;

    public function __construct()
    {
        $this->gisService = new DataGisServices();
    }

    /**
     * Mostrar la página de búsqueda
     */
    public function index()
    {
        return view('busqueda.index');
    }

    /**
     * Buscar información del GIS
     */
    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required|string|min:1'
        ]);

        $search = $request->input('search');

        try {
            // Buscar en el servicio GIS
            $result = $this->gisService->DataGisubicacion($search);

            return response()->json([
                'success' => true,
                'data' => $result
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al consultar el servicio GIS: ' . $e->getMessage()
            ], 500);
        }
    }
}
