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
use Illuminate\Support\Facades\DB;



class AuditoriaDatatable extends DataTableComponent
{
    protected $model = reportes::class;
    public ?int $searchFilterDebounce = 500;
    public string $defaultSortDirection = 'Asc';
    public ?string $defaultSortColumn = 'created_at';


    public function configure(): void
    {
        $this->setPrimaryKey('id')->setTableRowUrl(function ($row) {
            return route('auditorias.show', ['auditoria' => $row]);
        });
        $this->setColumnSelectStatus(false);
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
        // Traes las anomalías desde tu vista
    $anomalias = DB::table('vs_anomalias')
        ->orderBy('nombre')
        ->pluck('nombre', 'nombre') // clave = id, valor = nombre
        ->toArray();
        return [
            SelectFilter::make('Anomalias')
    ->options($anomalias)
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
            ->with(['personal', 'report_comercio', 'dbSurtigas'])
            ->where('reportes.estado', 6)
            ->where('reportes.revisado', 0);
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
            Column::make('Ciclos', 'dbSurtigas.ciclo'),
            Column::make("Estado", "revisado")
                ->format(
                    fn($value) => $value == 0 || $value === null ? '<span class="badge badge-warning">Pendiente por auditar</span>' : 'No Revisado'
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
