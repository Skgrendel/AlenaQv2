<?php

namespace App\Services\reporte;

use App\Models\comercio;
use App\Models\surtigas;
use App\Models\reportes;
use App\Models\ubicacion;
use App\Models\vs_anomalias;
use App\Models\vs_comercios;
use App\Models\vs_imposibilidad;

class EditReportServices
{
    public function EditReport(string $id)
    {
        $data = reportes::find($id);
        $data->load('report_comercio', 'report_ubicacion', 'vs_imposibilidad');
        $ubicacion = ubicacion::where('id', $data->ubicacions_id)->first();
        $ciclo = surtigas::where('id', $data->surtigas_id)->first();
        $comerciosIds = comercio::where('id', $data->comercios_id)->first();
        $src = 'https://www.google.com/maps/place/' . $ciclo->latitud . ',' . $ciclo->longitud;
        $comercios = vs_comercios::pluck('nombre', 'id');
        $anomalias = vs_anomalias::pluck('nombre', 'id');
        $imposibilidad = vs_imposibilidad::pluck('nombre', 'id');
        $imagenes = json_decode($data->imagenes);
        $anomaliasId = json_decode($data->anomalia);
        // Obtener los nombres de las anomalías como un array
        $anomaliasNamesArray = vs_anomalias::whereIn('id',$anomaliasId)->pluck('nombre')->toArray();
        $anomaliasNames = implode(', ', $anomaliasNamesArray);

        return [
            'info' => [
                'ubicacion' => $ubicacion,
                'ciclo' => $ciclo,
                'comercio' => $comerciosIds,
                'anomaliasid' => $anomaliasId,
                'reporte' => $data,
                'estado' => $ciclo->estado,
                'anomalias'=> $anomaliasNames,
                'imposibilidad'=>$data->vs_imposibilidad->nombre,
                'medidoranomalia'=>$data->report_comercio->medidor_anomalia,
                'comercios'=>$data->report_comercio->vs_comercio->nombre,
                'comentarios'=>$data->comentarios,
                'lectura'=>$data->lectura
            ],
            'location' => [
                'link' => $src,
            ],
            'comercios' => $comercios,
            'anomalias' => $anomalias,
            'imposibilidad' => $imposibilidad,
            'imagenes' => $imagenes,
            'video' => $data->video,

        ];
    }
}
