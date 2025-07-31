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
        $anomalias = json_decode($data->anomalia, true); // Decodifica como array asociativo
        $anomaliasNames = is_array($anomalias) ? implode(', ', $anomalias) : '';

        return [
            'info' => [
                'id' => $data->id,
                'contrato' => $data->dbSurtigas->contrato,
                'medidor' => $data->dbSurtigas->medidor,
                'direccion' => $ubicacion->direccion,
                'ciclo' => $data->dbSurtigas->ciclo,
                'cliente' => $data->dbSurtigas->cliente,
                'comercios' => $data->report_comercio->tipo_comercio,
                'comercionovedad' => $data->report_comercio->nuevo_comercio,
                'medidoranomalia' => $data->report_comercio->medidor_anomalia,
                'nombrecomercio' => $data->report_comercio->nombre_comercio,
                'anomalias' => $anomaliasNames,
                'imposibilidad' => $data->imposibilidad,
                'tipo presion' => $data->tipo_presion,
                'marca de medidor' => is_string($data->marca_medidor) ? $data->marca_medidor : 'Sin datos',
                'marca de regulador' => is_string($data->marca_regulador) ? $data->marca_regulador : 'Sin datos',
                'alertas' => $data->cau,
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
