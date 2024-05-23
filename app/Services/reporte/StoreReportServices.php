<?php

namespace App\Services\reporte;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StoreReportServices
{
    public function StoreComercio(Request $request)
    {
        $comercios = [];
        $comercios['nuevo_comercio'] = $request->input('nuevo_comercio');
        $comercios['nombre_comercio'] = $request->input('nombre_comercio');
        $comercios['tipo_comercio'] = $request->input('tipo_comercio');
        $comercios['medidor_anomalia'] = $request->input('medidor_anomalia');

        return $comercios;
    }

    public function StoreUbicacion($request)
    {
        $latitud = $request->input('latitud');
        $longitud = $request->input('longitud');

        $response = Http::withoutVerifying()->get("https://revgeocode.search.hereapi.com/v1/revgeocode?apikey=auuOOORgqWd_T4DFf0onY2JlvMDhz4tP0G0o7fRYDRU&at=$latitud,$longitud&lang=es-ES");
        $data = $response->json();
        $direccion = $data['items'][0]['address']['label'];

        $ubicacion = [];
        $ubicacion['direccion'] = $direccion;
        $ubicacion['latitud'] = $latitud;
        $ubicacion['longitud'] = $longitud;

        return $ubicacion;
    }

    public function StoreReportes(Request $request, $foto, $id, $ubicacion, $comercio, $video)
    {

        $reportes = [];

        $AnomaliaJson = json_encode($request->anomalia);
        $reportes['anomalia'] = $AnomaliaJson;
        $reportes['personals_id'] = $id;
        $reportes['ubicacions_id'] = $ubicacion;
        $reportes['comercios_id'] = $comercio;
        $reportes['contrato'] = $request->input('contrato');
        $reportes['medidor'] = $request->input('medidor') ?? 0;
        $reportes['lectura'] = $request->input('lectura');
        $reportes['imposibilidad'] = $request->input('imposibilidad');
        $reportes['imagenes'] = json_encode($foto);
        $reportes['video'] = $video;

        return $reportes;
    }
}
