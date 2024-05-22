<?php

namespace App\Services;

use App\Models\reportes;
use App\Models\vs_anomalias;
use App\Models\vs_comercios;
use App\Models\vs_imposibilidad;

class EditReportServices
{
    public function EditReport(string $id)
    {
        $data = reportes::find($id);
        $anomalias = vs_anomalias::pluck('nombre', 'id');
        $comercios = vs_comercios::pluck('nombre', 'id');
        $imposibilidad = vs_imposibilidad::pluck('nombre', 'id');
        $imagenes = json_decode($data->imagenes);
        $anomaliasIds = json_decode($data->anomalia);

        return [
            'info' => [
                'contrato' => $data->contrato,
                'medidor' => $data->medidor,
                'direccion' => $data->direccion,
                'ciclo' => $data->ciclo,
                'cliente' => $data->cliente,
            ],
            'anomalias' => $anomalias,
            'comercios' => $comercios,
            'imposibilidad' => $imposibilidad,
            'imagenes' => $imagenes,
            'anomaliasIds' => $anomaliasIds
        ];
    }
}
