<?php

namespace App\Services\reporte;

use App\Models\comercio;
use App\Models\reportes;
use App\Models\ubicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ReportServices
{
    public function StoreComercio(Request $request)
    {
        $comercios = [];
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

        if (isset($data['items'])) {
            $direccion = $data['items'][0]['address']['label'];
        }else{
            $direccion = "";
        }

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
        $reportes['surtigas_id'] = $request->surtigas_id;
        $reportes['lectura'] = $request->input('lectura');
        $reportes['imposibilidad'] = $request->input('imposibilidad');
        $reportes['comentarios'] = $request->input('comentarios');
        $reportes['imagenes'] = json_encode($foto);
        if ($video){
            $reportes['video'] = $video;
        }

        return $reportes;
    }

    public function UpdateComercio(Request $request, $reporte)
    {

        $comercio = comercio::where('id', $reporte->comercios_id)->first();
        $comercio->update($request->all());
        return $comercio;
    }

    public function UpdateUbicacion($ubicacion, $reporte)
    {
        $ubicaciones = ubicacion::where('id', $reporte->ubicacions_id)->first();
        $ubicaciones->update($ubicacion);
        return $ubicaciones;
    }


}
