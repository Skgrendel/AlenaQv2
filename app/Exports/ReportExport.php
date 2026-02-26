<?php

namespace App\Exports;

use App\Models\reportes;
use App\Models\vs_anomalias;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReportExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths, ShouldAutoSize, WithEvents
{
    protected $reporteIds;

    public function __construct($reporteIds)
    {
        $this->reporteIds = $reporteIds;
    }

    public function collection()
    {
        return Reportes::with(['report_comercio', 'report_ubicacion', 'vs_estado', 'vs_imposibilidad', 'personal'])
            ->whereIn('id', $this->reporteIds)
            ->get()
            ->map(function ($reporte) {
                $anomalias = json_decode($reporte->anomalia);

                return [
                    $reporte->personal->nombres . ' ' . $reporte->personal->apellidos,
                    $reporte->dbSurtigas->contrato,
                    $reporte->dbSurtigas->medidor,
                    $reporte->lectura,
                    $reporte->dbSurtigas->ciclo,
                    $reporte->dbSurtigas->direccion,
                    implode(', ', $anomalias),
                    $reporte->imposibilidad,
                    $reporte->report_comercio->tipo_comercio,
                    $reporte->tipo_presion,
                    $reporte->descripcion_medidor,
                    $reporte->marca_medidor,
                    $reporte->marca_regulador,
                    $reporte->cau,
                    $reporte->vs_estado->nombre,
                    $reporte->confirmado == 1 ? 'Confirmado' : ($reporte->confirmado == 2 ? 'No Confirmado' : 'No Revisado'),
                    $reporte->created_at->format('Y-m-d'),
                    $reporte->created_at->format('H:i:s'),
                    $reporte->updated_at->format('Y-m-d'),
                    $reporte->updated_at->format('H:i:s')

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
            'Revisión',
            'Fecha de Creación',
            'Hora de Creación',
            'Fecha de Actualización',
            'Hora de Actualización',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [ // Encabezado (fila 1)
                'font' => ['bold' => true, 'size' => 12],
                'alignment' => ['horizontal' => 'center'],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'D9EDF7'],
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ],
                ],
            ],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 15,
            'C' => 15,
            'D' => 10,
            'E' => 10,
            'F' => 30,
            'G' => 40,
            'H' => 25,
            'I' => 20,
            'J' => 20,
            'K' => 25,
            'L' => 20,
            'M' => 20,
            'N' => 20,
            'O' => 20,
            'P' => 18,
            'Q' => 18,
            'R' => 15,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();

                $sheet->getStyle("A1:{$highestColumn}{$highestRow}")->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '999999'],
                        ],
                    ],
                    'alignment' => [
                        'vertical' => 'center',
                    ],
                ]);
            },
        ];
    }
}

