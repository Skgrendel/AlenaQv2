<?php

namespace App\Services\reporte;

use App\Models\comercio;
use App\Models\surtigas;
use App\Models\reportes;
use App\Models\ubicacion;
use App\Models\vs_anomalias;
use App\Models\vs_comercios;
use App\Models\vs_imposibilidad;
use App\Models\vs_tipo_regulador;

class ShowReportServices
{
    public function ShowReport(string $id)
    {
        $data = reportes::find($id);
        $ubicacion = ubicacion::where('id',$data->ubicacions_id)->first();
        $comerciosIds = comercio::where('id',$data->comercios_id)->first();
        $comercios = vs_comercios::pluck('nombre', 'id');
        $anomalias = vs_anomalias::pluck('nombre', 'id');
        $imposibilidad = vs_imposibilidad::pluck('nombre', 'id');
        $tipo_presion = vs_tipo_regulador::pluck('nombre', 'id');
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
                'anomalias' => json_decode($data->anomalia),
                'imposibilidad' =>$data->imposibilidad,
                'tipo regulador' => $data->tipo_regulador,
                'marca de medidor' => $data->marca_medidor,
                'marca de regulador' => $data->marca_regulador,
                'lectura' => $data->lectura,
                'observaciones' =>$data->observaciones,
                'estado' => $data->estado
            ],
            'tipo presion' => $tipo_presion,
            'comercios' => $comercios,
            'anomalias' => $anomalias,
            'imposibilidad' => $imposibilidad,
            'imagenes' => json_decode($data->imagenes),

        ];
    }
}
