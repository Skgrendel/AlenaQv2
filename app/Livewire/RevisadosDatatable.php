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
        'Sin Anomalias' => 'Sin Anomalias',
        'Bypass' => 'Bypass',
        'Medidor con sellos manipulados' => 'Medidor con sellos manipulados',
        'Medidor con digitos desalineados' => 'Medidor con digitos desalineados',
        'Medidor sin talco' => 'Medidor sin talco',
        'Medidor enterrado' => 'Medidor enterrado',
        'Conexión directa' => 'Conexión directa',
        'Medidor frenado' => 'Medidor frenado',
        'Medidor gira hacia atrás' => 'Medidor gira hacia atrás',
        'Medidor No encontrado' => 'Medidor No encontrado',
        'Medidor No Concuerda con el contrato' => 'Medidor No Concuerda con el contrato',
        'Medidor trocado' => 'Medidor trocado',
        'Inactivo y en Consumo' => 'Inactivo y en Consumo',
        'Inspección y revisión' => 'Inspección y revisión',
        'Posible fuga' => 'Posible fuga',
        'Pendiente de Retiro / Revisión' => 'Pendiente de Retiro / Revisión',
        'Medidor con doble local Comercial' => 'Medidor con doble local Comercial',
    ])
    ->filter(function (Builder $builder, $value) {
        if (!empty($value)) {
            $builder->whereJsonContains('reportes.anomalia', $value);
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
            ->where('reportes.revisado', '1')
            ->where('reportes.confirmado', '0')
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
            Column::make("Comercio", "report_comercio.vs_comercio.nombre")
                ->collapseAlways(),
            Column::make('Ciclos', 'dbSurtigas.ciclo'),
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
            Column::make("Estado", "revisado")
                ->format(
                    fn($value) => $value == 1 ? '<span class="badge badge-success">Auditado</span>' : 'No Revisado'
                )
                ->html()
                ->collapseOnMobile(),
            Column::make("Fecha", "created_at")
                ->format(fn($value) => $value->format('d/M/Y'))
                ->collapseOnMobile(),
            Column::make('Acciones', 'id')
                ->format(
                    fn($value, $row, Column $column) => view('auditoria.actions', compact('value'))
                ),
        ];
    }
}
