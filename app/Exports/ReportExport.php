<?php

namespace App\Exports;

use App\Models\reportes;
use App\Models\vs_anomalias;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;


class ReportExport implements FromCollection,WithHeadings
{
    protected $reporteIds;

    public function __construct($reporteIds)
    {
        $this->reporteIds = $reporteIds;
    }

    public function collection()
    {
        return Reportes::with(['report_comercio','report_ubicacion', 'vs_estado','vs_imposibilidad','personal'])
        ->whereIn('id', $this->reporteIds)
        ->get()
        ->map(function ($reporte) {
            // Decodifica el JSON a un array de PHP
            $anomalias = json_decode($reporte->anomalia);



            return [
                $reporte->personal->nombres .' '. $reporte->personal->apellidos,
                $reporte->dbSurtigas->contrato,
                $reporte->dbSurtigas->medidor,
                $reporte->lectura,
                $reporte->dbSurtigas->ciclo,
                $reporte->dbSurtigas->direccion,
                implode(', ', $anomalias ),
                $reporte->imposibilidad,
                $reporte->report_comercio->tipo_comercio,
                $reporte->tipo_presion,
                $reporte->descripcion_medidor,
                $reporte->marca_medidor,
                $reporte->marca_regulador,
                $reporte->cau,
                $reporte->vs_estado->nombre,
                $reporte->created_at->format('Y-m-d'),
                $reporte->created_at->format('H:i:s '),

            ];
        });
    }

    public function headings(): array
    {
        return [
            'Asignado a',
            'Contrato',
            'Medidor',
            'Lectura',
            'Ciclo',
            'Dirección',
            'Anomalía',
            'Imposibilidad',
            'Comercio',
            'Tipo de Presión',
            'Descripción del Medidor',
            'Marca de Medidor',
            'Marca de Regulador',
            'Alerta CAU',
            'Estado',
            'Fecha de Creación',
            'Hora de Creación',
        ];
    }
}
