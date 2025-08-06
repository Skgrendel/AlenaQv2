<?php

namespace App\Services\reporte;

use App\Models\surtigas;
use App\Models\vs_anomalias;
use App\Models\vs_comercios;
use App\Models\vs_imposibilidad;
use App\Models\vs_marca_medidor;
use App\Models\vs_marca_regulador;
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
        $marca_regulador = vs_marca_regulador::pluck('nombre', 'id');
        $tipo_presion = vs_tipo_regulador::pluck('nombre', 'id');
        $descripcion_medidor = ["No hay Medidor","G-1.6","G-4","G10","G16","G-2.5","G-16","G-6","AL-425","AL-1000","AC-630","AC-250","AL-800","MR-8","MR-10","MR-12"];
        $alertas = ["Sin Alertas","Exceso de Capacidad","Retro Flujo","Posible fuga intera","Fuga Pequeña Const 7 Dias","Bateria Baja","CAU 01","CAU 02","CAU 03","CAU 04"];

        return [
            'info' => [
                'db_Surtigas' => $data,
            ],
            'location' => [
                'link' => $src,
            ],
            'alertas' => $alertas,
            'anomalias' => $anomalias,
            'comercios' => $comercios,
            'imposibilidad' => $imposibilidad,
            'marca_medidor' => $marca_medidor,
            'marca_regulador' => $marca_regulador,
            'tipo_presion' => $tipo_presion,
            'descripcion_medidor' => $descripcion_medidor ?? 'Sin datos',
        ];
    }
}
