<?php

namespace App\Livewire;

use App\Exports\ReportExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\reportes;
use App\Models\vs_anomalias;

class ConfirmadosDatatable extends DataTableComponent
{
    protected $model = reportes::class;
    public ?int $searchFilterDebounce = 500;
    public string $defaultSortDirection = 'desc';
    public ?string $defaultSortColumn = 'created_at';


    public function configure(): void
    {
        $this->setPrimaryKey('id')->setTableRowUrl(function ($row) {
            return route('auditorias.show', ['auditoria' => $row]);
        });
        $this->setColumnSelectStatus(false);
        $this->setTableAttributes([
            'class' => 'table table-bordered  custom-table',
        ]);
        // $this->setConfigurableAreas([
        //     'before-toolbar' => 'livewire.reportes-zip-header',
        // ]);
    }

    public function bulkActions(): array
    {
        return [
            'export' => 'Exportar a Excel',
        ];
    }

    public function export()
    {
        $users = $this->getSelected();

        $this->clearSelected();

        $date = now()->format('Y-m-d H:i:s');

        return Excel::download(new ReportExport($users), $date . '.xlsx');
    }

    public function filters(): array
    {
        return [
            // Aquí es donde agregas otro filtro
            SelectFilter::make('Anomalias')
                ->options([
                    '' => 'All',
                    '1' => 'Sin anomalias',
                    '2' => 'Bypass',
                    '3' => 'Medidor con sellos manipulados',
                    '4' => 'Medidor con digitos desalineados',
                    '5' => 'Medidor sin talco',
                    '6' => 'Medidor enterrado',
                    '7' => 'Conexión directa',
                    '8' => 'Medidor frenado',
                    '9' => 'Medidor gira hacia atrás',
                    '10' => 'Medidor fuera de ruta',
                    '11' => 'Medidor trocado',
                    '12' => 'Inactivo y en Consumo',
                    '13' => 'Medidor no encontrado',
                    '14' => 'Medidor no concuerda con el contrato',
                ])
                ->filter(function (Builder $builder, $value) {
                    if ($value === '1') {
                        $builder->whereJsonContains('reportes.anomalia', '8');
                    } elseif ($value === '2') {
                        $builder->whereJsonContains('reportes.anomalia', '9');
                    } elseif ($value === '3') {
                        $builder->whereJsonContains('reportes.anomalia', '10');
                    } elseif ($value === '4') {
                        $builder->whereJsonContains('reportes.anomalia', '11');
                    } elseif ($value === '5') {
                        $builder->whereJsonContains('reportes.anomalia', '12');
                    } elseif ($value === '6') {
                        $builder->whereJsonContains('reportes.anomalia', '13');
                    } elseif ($value === '7') {
                        $builder->whereJsonContains('reportes.anomalia', '14');
                    } elseif ($value === '8') {
                        $builder->whereJsonContains('reportes.anomalia', '15');
                    } elseif ($value === '9') {
                        $builder->whereJsonContains('reportes.anomalia', '16');
                    } elseif ($value === '10') {
                        $builder->whereJsonContains('reportes.anomalia', '17');
                    } elseif ($value === '11') {
                        $builder->whereJsonContains('reportes.anomalia', '18');
                    } elseif ($value === '12') {
                        $builder->whereJsonContains('reportes.anomalia', '63');
                    } elseif ($value === '13') {
                        $builder->whereJsonContains('reportes.anomalia', '67');
                    } elseif ($value === '14') {
                        $builder->whereJsonContains('reportes.anomalia', '68');
                    } elseif ($value === '15') {
                        $builder->whereJsonContains('reportes.anomalia', '71');
                    } elseif ($value === '16') {
                        $builder->whereJsonContains('reportes.anomalia', '72');
                    } elseif ($value === '17') {
                        $builder->whereJsonContains('reportes.anomalia', '73');
                    } elseif ($value === '18') {
                        $builder->whereJsonContains('reportes.anomalia', '74');
                    }
                }),
            SelectFilter::make('Ciclos')
                ->options([
                    '' => 'All',
                    '1001' => '1001',
                    '1002' => '1002',
                    '1003' => '1003',
                    '1004' => '1004',
                    '1005' => '1005',
                    '1006' => '1006',
                    '1007' => '1007',
                    '1008' => '1008',
                    '1009' => '1009',
                    '1010' => '1010',
                    '1011' => '1011',
                    '1012' => '1012',
                    '1051' => '1051',
                    '1101' => '1101',
                    '1144' => '1144',
                    '1161' => '1161',
                    '1162' => '1162',
                    '1163' => '1163',
                    '1191' => '1191',
                    '1221' => '1221',
                    '1231' => '1231',
                    '1271' => '1271',
                    '1272' => '1272',
                    '1274' => '1274',
                    '2002' => '2002',
                    '2004' => '2004',
                    '2006' => '2006',
                    '2007' => '2007',
                    '2341' => '2341',
                    '4001' => '4001',
                    '4002' => '4002',
                    '4003' => '4003',
                    '4004' => '4004',
                    '4101' => '4101',
                    '4153' => '4153',
                    '4231' => '4231',
                    '4232' => '4232',
                    '4261' => '4261',
                ])
                ->filter(function (Builder $builder, $value) {
                    if (!empty($value)) {
                        $builder->where('dbSurtigas.ciclo', $value);
                    }
                }),
        ];
    }
    public function builder(): Builder
    {
        return reportes::query()
            ->where('reportes.confirmado', '1')
            ->where('reportes.revisado', '1');
    }

    public function columns(): array
    {
        return [
            Column::make("Nombres", "personal.nombres")
                ->collapseAlways(),
            Column::make("Apellidos", "personal.apellidos")
                ->collapseAlways(),
            Column::make("Contrato", "dbSurtigas.contrato")
                ->collapseOnMobile()
                ->searchable(),
            Column::make("Lectura", "lectura")
                ->collapseOnMobile(),
            Column::make("Medidor", "dbSurtigas.medidor")
                ->collapseOnMobile()
                ->searchable(),
            Column::make("Anomalia", "anomalia")
                ->format(function ($value) {
                    $anomalias = json_decode($value); // Decodifica el JSON
                    $nombres = [];
                    foreach ($anomalias as $nombre) {
                        if ($anomalias) {
                            $nombres[] = $nombre; // Agrega el nombre a la lista
                        }
                    }
                    return implode(', ', $nombres); // Devuelve los nombres como una cadena separada por comas
                })
                ->collapseOnMobile(),
            Column::make("Direccion", "report_ubicacion.direccion")
                ->collapseAlways(),
            Column::make("Comercio", "report_comercio.nombre_comercio")
                ->collapseAlways(),
            Column::make('Ciclos', 'dbSurtigas.ciclo')
                ->searchable(),
            column::make('Alertas', 'cau')
                ->format(function ($value) {
                    $texto = trim($value);

                    if (strtolower($texto) === 'sin alertas') {
                        return '<span class="badge bg-success">Sin Alertas</span>';
                    } else {
                        return '<span class="badge bg-danger">' . e($texto) . '</span>';
                    }
                })
                ->Html() // muy importante para que se renderice el HTML
                ->collapseOnMobile(),
            Column::make("Estado", "confirmado")
                ->format(
                    fn($value) => $value == 1 ? '<span class="badge badge-success">Entregados</span>' : 'No Revisado'
                )
                ->html()
                ->collapseOnMobile(),
            Column::make("Fecha", "created_at")
                ->format(fn($value) => $value->format('d/M/Y'))
                ->collapseOnMobile(),
            Column::make('Acciones', 'id')
                ->unclickable()
                ->format(
                    fn($value, $row, Column $column) => view('auditoria.actions', compact('value'))
                ),
        ];
    }
}
