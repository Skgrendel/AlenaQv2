<?php

namespace App\Services;

use App\Models\dbssurtigas;
use App\Models\vs_anomalias;
use App\Models\vs_comercios;
use App\Models\vs_imposibilidad;

class CreateReportServices
{
    public function CreateReport(string $id){
        $data = dbssurtigas::where('contrato', $id)->first();
        $src = 'https://www.google.com/maps/place/' . $data->latitud . ',' . $data->longitud;
        $anomalias = vs_anomalias::pluck('nombre', 'id');
        $comercios = vs_comercios::pluck('nombre', 'id');
        $imposibilidad = vs_imposibilidad::pluck('nombre', 'id');

        return[
            'info' => [
                'contrato'=> $data->contrato,
                'medidor' => $data->medidor,
                'direccion' => $data->direccion,
                'ciclo' => $data->ciclo,
                'cliente' => $data->cliente,
            ],
            'location' =>[
                'link'=> $src,
            ],
            'anomalias'=>$anomalias,
            'comercios'=>$comercios,
            'imposibilidad'=>$imposibilidad,
        ];
    }
}
