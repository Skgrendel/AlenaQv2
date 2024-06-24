<?php

namespace App\Services\reporte;

use App\Models\comercio;
use App\Models\surtigas;
use App\Models\reportes;
use App\Models\ubicacion;
use App\Models\vs_anomalias;
use App\Models\vs_comercios;
use App\Models\vs_imposibilidad;

class ShowReportServices
{
    public function ShowReport(string $id)
    {
        $data = reportes::find($id)->dd;
        $ubicacion = ubicacion::where('id',$data->ubicacions_id)->first();
        $comerciosIds = comercio::where('id',$data->comercios_id)->first();
        $comercios = vs_comercios::pluck('nombre', 'id');
        $anomalias = vs_anomalias::pluck('nombre', 'id');
        $imposibilidad = vs_imposibilidad::pluck('nombre', 'id');
        $imagenes = json_decode($data->imagenes);
        $anomaliasId = json_decode($data->anomalia);

        return [
            'info' => [
                'id'=>$data->id,
                'contrato' => $data->dbSurtigas->contrato,
                'medidor' => $data->dbSurtigas->medidor,
                'direccion' => $ubicacion->direccion,
                'ciclo' => $data->dbSurtigas->ciclo,
                'cliente' => $data->dbSurtigas->cliente,
                'comerciosid' => $comerciosIds->tipo_comercio,
                'comercionovedad'=> $comerciosIds->nuevo_comercio,
                'medidoranomalia'=>$comerciosIds->medidor_anomalia,
                'nombrecomercio'=>$comerciosIds->nombre_comercio,
                'anomaliasid' => $anomaliasId,
                'imposibilidadid' =>$data->imposibilidad,
                'lectura' => $data->lectura,
                'observaciones' =>$data->observaciones,
                'estado' => $data->estado
            ],
            'comercios' => $comercios,
            'anomalias' => $anomalias,
            'imposibilidad' => $imposibilidad,
            'imagenes' => $imagenes,
            'video' =>$data->video,

        ];
    }
}
