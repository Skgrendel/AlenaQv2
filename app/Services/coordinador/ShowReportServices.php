<?php

namespace App\Services\coordinador;

use App\Models\comercio;
use App\Models\surtigas;
use App\Models\reportes;
use App\Models\ubicacion;
use App\Models\vs_anomalias;

class ShowReportServices
{
    public function ShowReport(string $id)
    {
        $data = reportes::find($id);
        $ubicacion = ubicacion::where('id', $data->ubicacions_id)->first();
        $ciclo = surtigas::where('id', $data->surtigas_id)->first();
        $imagenes = json_decode($data->imagenes);
        $anomalias = json_decode($data->anomalia);
        // Obtener los nombres de las anomalías como un array
        $anomaliasNamesArray = vs_anomalias::whereIn('id', $anomalias)->pluck('nombre')->toArray();
        $anomaliasNames = implode(', ', $anomaliasNamesArray);

        return [
            'info' => [
                'id' => $data->id,
                'contrato' => $data->dbSurtigas->contrato,
                'medidor' => $data->dbSurtigas->medidor,
                'direccion' => $ubicacion->direccion,
                'ciclo' => $data->dbSurtigas->ciclo,
                'cliente' => $data->dbSurtigas->cliente,
                'comercios' => $data->report_comercio->vs_comercio->nombre,
                'comercionovedad' => $data->report_comercio->nuevo_comercio,
                'medidoranomalia' => $data->report_comercio->medidor_anomalia,
                'nombrecomercio' => $data->report_comercio->nombre_comercio,
                'anomalias' => $anomaliasNames,
                'imposibilidad' => $data->vs_imposibilidad->nombre,
                'lectura' => $data->lectura,
                'observaciones' => $data->observaciones,
                'comentarios' => $data->comentarios,
                'estado' => $ciclo->estado_servicio
            ],
            'imagenes' => $imagenes,
            'video' => $data->video,

        ];
    }
}
