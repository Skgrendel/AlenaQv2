<?php

namespace App\Services\reporte;

use App\Models\comercio;
use App\Models\dbssurtigas;
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
        $ubicacion = ubicacion::where('id',$data->ubicacions_id)->first();
        $ciclo = dbssurtigas::where('contrato',$data->contrato)->first();
        $comerciosIds = comercio::where('id',$data->comercios_id)->first();
        $src = 'https://www.google.com/maps/place/' . $ciclo->latitud . ',' . $ciclo->longitud;
        $comercios = vs_comercios::pluck('nombre', 'id');
        $anomalias = vs_anomalias::pluck('nombre', 'id');
        $imposibilidad = vs_imposibilidad::pluck('nombre', 'id');
        $imagenes = json_decode($data->imagenes);
        $anomaliasId = json_decode($data->anomalia);

        return [
            'info' => [
                'id'=>$data->id,
                'contrato' => $data->contrato,
                'medidor' => $data->medidor,
                'direccion' => $ubicacion->direccion,
                'ciclo' => $ciclo->ciclo,
                'cliente' => $ciclo->cliente,
                'comerciosid' => $comerciosIds->tipo_comercio,
                'comercionovedad'=> $comerciosIds->nuevo_comercio,
                'medidoranomalia'=>$comerciosIds->medidor_anomalia,
                'nombrecomercio'=>$comerciosIds->nombre_comercio,
                'anomaliasid' => $anomaliasId,
                'imposibilidadid' =>$data->imposibilidad,
                'lectura' => $data->lectura,
                'observaciones' =>$data->observaciones,
            ],
            'location' =>[
                'link'=> $src,
            ],
            'comercios' => $comercios,
            'anomalias' => $anomalias,
            'imposibilidad' => $imposibilidad,
            'imagenes' => $imagenes,
            'video' =>$data->video,

        ];
    }
}