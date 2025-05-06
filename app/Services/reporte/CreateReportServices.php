<?php

namespace App\Services\reporte;

use App\Models\surtigas;
use App\Models\vs_anomalias;
use App\Models\vs_comercios;
use App\Models\vs_imposibilidad;
use App\Models\vs_marca_medidor;
use App\Models\vs_tipo_regulador;

class CreateReportServices
{
    public function CreateReport(string $id)
    {
        $data = surtigas::where('contrato', $id)->first();
        $src = 'https://www.google.com/maps/place/' . $data->latitud . ',' . $data->longitud;
        $anomalias = vs_anomalias::pluck('nombre', 'id');
        $comercios = vs_comercios::pluck('nombre', 'id');
        $imposibilidad = vs_imposibilidad::pluck('nombre', 'id');
        $marca_medidor = vs_marca_medidor::pluck('nombre', 'id');
        $marca_regulador = vs_marca_medidor::pluck('nombre', 'id');
        $tipo_regulador = vs_tipo_regulador::pluck('nombre', 'id');

        return [
            'info' => [
                'db_Surtigas' => $data,
            ],
            'location' => [
                'link' => $src,
            ],
            'anomalias' => $anomalias,
            'comercios' => $comercios,
            'imposibilidad' => $imposibilidad,
            'marca_medidor' => $marca_medidor,
            'marca_regulador' => $marca_regulador,
            'tipo_regulador' => $tipo_regulador,
        ];
    }
}
