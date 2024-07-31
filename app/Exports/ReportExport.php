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
            $anomaliaIds = json_decode($reporte->anomalia);

            // Busca los nombres de las anomalías correspondientes a los IDs
            $anomaliaNombres = vs_anomalias::whereIn('id', $anomaliaIds)->pluck('nombre')->toArray();

            return [
                $reporte->personal->nombres,
                $reporte->personal->apellidos,
                $reporte->dbSurtigas->contrato,
                $reporte->dbSurtigas->medidor,
                $reporte->lectura,
                $reporte->report_ubicacion->direccion,
                implode(', ', $anomaliaNombres),
                $reporte->vs_imposibilidad->nombre,
                $reporte->report_comercio->vs_comercio->nombre,
                $reporte->vs_estado->nombre,
                $reporte->created_at->format('Y-m-d'),
                $reporte->created_at->format('H:i:s '),

            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nombres',
            'Apellidos',
            'Contrato',
            'Medidor',
            'Lectura',
            'Dirección',
            'Anomalía',
            'Imposibilidad',
            'Comercio',
            'Estado',
            'Fecha de Creación',
            'Hora de Creación',
        ];
    }
}
