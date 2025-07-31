<?php

namespace App\Services\reporte;

use App\Models\comercio;
use App\Models\surtigas;
use App\Models\reportes;
use App\Models\ubicacion;
use App\Models\vs_anomalias;
use App\Models\vs_comercios;
use App\Models\vs_imposibilidad;
use App\Models\vs_marca_medidor;
use App\Models\vs_marca_regulador;
use App\Models\vs_tipo_regulador;

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
        $tipo_presion = vs_tipo_regulador::pluck('nombre', 'id');
        $marca_medidor = vs_marca_medidor::pluck('nombre', 'id');
        $marca_regulador = vs_marca_regulador::pluck('nombre', 'id');
        $imagenes = json_decode($data->imagenes);
        $anomaliasId = json_decode($data->anomalia);
        $descripcion = [
            "G-1.6",
            "G-4",
            "G10",
            "G16",
            "G-2.5",
            "G-16",
            "G-6",
            "AL-425",
            "AL-1000",
            "AC-630",
            "AC-250",
            "AL-800",
            "MR-8",
            "MR-10",
            "MR-12"
        ];

        // Obtener los nombres de las anomalías como un array


        return [
            'info' => [
                'ubicacion' => $ubicacion,
                'ciclo' => $ciclo,
                'comercio' => $comerciosIds,
                'anomaliasid' => $anomaliasId,
                'reporte' => $data,
                'estado' => $ciclo->estado_servicio,
                'anomalias' => $anomaliasId,
                'imposibilidad' => $data->imposibilidad,
                'marca de medidor' => $data->marca_medidor,
                'marca de regulador' => $data->marca_regulador,
                'alerta' => $data->cau,
                'tipo presion' => $data->tipo_presion,
                'medidoranomalia' => $data->report_comercio->medidor_anomalia,
                'comercios' => $data->report_comercio->tipo_comercio,
                'comentarios' => $data->comentarios,
                'lectura' => $data->lectura,
                'contrato' => $ciclo->contrato,
                'medidor' => $ciclo->medidor,
                'descripcion_medidor' => $data->descripcion_medidor ?? 'Sin datos',
                'alertas' => $data->cau,
            ],
            'location' => [
                'link' => $src,
            ],
            'marca de medidor' => $marca_medidor,
            'marca de regulador' => $marca_regulador,
            'tipo presion' => $tipo_presion,
            'comercios' => $comercios,
            'anomalias' => $anomalias,
            'imposibilidad' => $imposibilidad,
            'descripcion' => $descripcion,
            'imagenes' => $imagenes,
            'video' => $data->video,
            'data' => [
                'db_Surtigas' => $ciclo
            ]

        ];
    }
}
