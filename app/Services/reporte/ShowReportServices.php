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
        $ubicacion = ubicacion::where('id', $data->ubicacions_id)->first();
        $comerciosIds = comercio::where('id', $data->comercios_id)->first();
        $comercios = vs_comercios::pluck('nombre', 'id');
        $anomalias = vs_anomalias::pluck('nombre', 'id');
        $imposibilidad = vs_imposibilidad::pluck('nombre', 'id');
        $tipo_presion = vs_tipo_regulador::pluck('nombre', 'id');
        $descripcion = ["No hay Medidor", "G-1.6", "G-4", "G10", "G16", "G-2.5", "G-16", "G-6", "AL-425", "AL-1000", "AC-630", "AC-250", "AL-800", "MR-8", "MR-10", "MR-12"];
        $alertas = ["Sin Alertas", "Exceso de Capacidad", "Retro Flujo", "Posible fuga intera", "Fuga Pequeña Const 7 Dias", "Bateria Baja", "CAU 01", "CAU 02", "CAU 03", "CAU 04"];
        return [
            'info' => [
                'id' => $data->id,
                'contrato' => $data->dbSurtigas->contrato,
                'medidor' => $data->dbSurtigas->medidor,
                'direccion' => $ubicacion->direccion,
                'ciclo' => $data->dbSurtigas->ciclo,
                'cliente' => $data->dbSurtigas->cliente,
                'comerciosid' => $comerciosIds->tipo_comercio,
                'comercionovedad' => $comerciosIds->nuevo_comercio,
                'medidoranomalia' => $comerciosIds->medidor_anomalia,
                'nombrecomercio' => $comerciosIds->nombre_comercio,
                'anomalias' => json_decode($data->anomalia),
                'imposibilidad' => $data->imposibilidad,
                'tipo regulador' => $data->tipo_regulador,
                'marca de medidor' => $data->marca_medidor,
                'marca de regulador' => $data->marca_regulador,
                'lectura' => $data->lectura,
                'observaciones' => $data->observaciones,
                'estado' => $data->estado
            ],
            'descripcion_medidor' => $descripcion ?? 'Sin datos',
            'alertas' => $alertas ?? 'Sin datos',
            'tipo presion' => $tipo_presion,
            'comercios' => $comercios,
            'anomalias' => $anomalias,
            'imposibilidad' => $imposibilidad,
            'imagenes' => json_decode($data->imagenes),

        ];
    }
}
