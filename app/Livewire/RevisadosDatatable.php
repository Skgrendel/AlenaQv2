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

class RevisadosDatatable extends DataTableComponent
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
        $this->setPerPageAccepted([10, 25, 50, 100]);
        $this->setPageName('revisados');
        $this->setTableAttributes([
            'class' => 'table table-bordered custom-table',
        ]);
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
                        $builder->whereJsonContains('reportes.anomalia', '67');
                    }
                }),
                SelectFilter::make('Ciclos')
                ->options([
                    '' => 'All',
                    '1' => '2001',
                    '2' => '2002',
                    '3' => '2003',
                    '4' => '2004',
                    '5' => '2005',
                    '6' => '2006',
                    '7' => '2007',
                    '8' => '2008',

                ])
                ->filter(function (Builder $builder, $value) {
                    if ($value === '1') {
                        $builder->where('dbSurtigas.ciclo', '2001');
                    } elseif ($value === '2') {
                        $builder->where('dbSurtigas.ciclo', '2002');
                    } elseif ($value === '3') {
                        $builder->where('dbSurtigas.ciclo', '2003');
                    } elseif ($value === '4') {
                        $builder->where('dbSurtigas.ciclo', '2004');
                    } elseif ($value === '5') {
                        $builder->where('dbSurtigas.ciclo', '2005');
                    } elseif ($value === '6') {
                        $builder->where('dbSurtigas.ciclo', '2006');
                    } elseif ($value === '7') {
                        $builder->where('dbSurtigas.ciclo', '2007');
                    } elseif ($value === '8') {
                        $builder->where('dbSurtigas.ciclo', '2008');
                    }
                }),
        ];
    }
    public function builder(): Builder
    {
        return reportes::query()
            ->where('reportes.revisado','1')
            ->where('reportes.confirmado','0')
            ->with(['personal', 'report_comercio', 'dbSurtigas']);
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
            Column::make("Anomalia", "anomalia")
                ->format(function ($value) {
                    $ids = json_decode($value); // Decodifica el JSON
                    $nombres = [];
                    foreach ($ids as $id) {
                        $anomalia = vs_anomalias::find($id); // Busca la Anomalia por ID
                        if ($anomalia) {
                            $nombres[] = $anomalia->nombre; // Agrega el nombre a la lista
                        }
                    }
                    return implode(', ', $nombres); // Devuelve los nombres como una cadena separada por comas
                })
                ->collapseOnMobile(),
            Column::make("Direccion", "report_ubicacion.direccion")
                ->collapseAlways(),
            Column::make("Comercio", "report_comercio.vs_comercio.nombre")
                ->collapseAlways(),
            Column::make('Ciclos', 'dbSurtigas.ciclo'),
            Column::make("Estado", "revisado")
                ->format(
                    fn ($value) => $value == 1 ? '<span class="badge badge-success">Auditado</span>' : 'No Revisado'
                )
                ->html()
                ->collapseOnMobile(),
            Column::make("Fecha", "created_at")
                ->format(fn ($value) => $value->format('d/M/Y'))
                ->collapseOnMobile(),
            Column::make('Acciones', 'id')
                ->format(
                    fn ($value, $row, Column $column) => view('auditoria.actions', compact('value'))
                ),
        ];
    }
}
