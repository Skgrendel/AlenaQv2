<?php

namespace App\Exports;

use App\Models\surtigas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SurtugasPendientesExport implements FromCollection, WithHeadings, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return surtigas::where('estado', 1)
            ->where('personals_id', 0)
            ->select('id', 'contrato', 'cliente', 'direccion', 'barrio', 'medidor', 'ciclo', 'estado_servicio', 'tipo_medidor')
            ->orderBy('ciclo', 'asc')
            ->orderBy('contrato', 'asc')
            ->get();
    }

    /**
     * Encabezados del Excel
     */
    public function headings(): array
    {
        return [
            'ID',
            'Contrato',
            'Cliente',
            'Dirección',
            'Barrio',
            'Medidor',
            'Ciclo',
            'Estado Servicio',
            'Tipo Medidor',
        ];
    }

    /**
     * Estilos del Excel
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Estilo para la fila de encabezados
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => '4472C4']],
                'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
            ],
        ];
    }
}
