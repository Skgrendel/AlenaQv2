<?php

namespace App\Livewire;

use App\Models\surtigas;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class PendientesSurtugasDatatable extends DataTableComponent
{
    protected $model = surtigas::class;
    public ?string $searchPlaceholder = 'Buscar por Contrato';
    public ?int $searchFilterDebounce = 500;
    public string $defaultSortDirection = 'desc';

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setColumnSelectStatus(false);
        $this->setTableAttributes([
            'class' => 'table table-bordered custom-table',
        ]);
    }

    public function filters(): array
    {
        return [
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
                        $builder->where('ciclo', $value);
                    }
                }),
        ];
    }

    public function builder(): Builder
    {
        return surtigas::query()
            ->where('estado', 1)
            ->where('personals_id', 0)
            ->orderBy('ciclo', 'asc')
            ->orderBy('contrato', 'asc');
    }

    public function columns(): array
    {
        return [
            Column::make("Contrato", "contrato")
                ->searchable(),
            Column::make("Cliente", "cliente")
                ->collapseOnMobile(),
            Column::make("Direccion", "direccion")
                ->collapseOnMobile(),
            Column::make("Barrio", "barrio")
                ->sortable(),
            Column::make("Ciclo", "ciclo")
                ->sortable(),
            Column::make("Estado", "estado")
                ->format(
                    fn($value) => '<span class="badge badge-danger">Pendiente</span>'
                )
                ->html()
                ->collapseOnMobile(),
            Column::make('Acciones', 'id')
                ->format(
                    fn($value, $row, Column $column) => view('surtigas.pendientes.actions', [
                        'id' => $value,
                        'contrato' => $row->contrato,
                        'ciclo' => $row->ciclo,
                    ])
                ),
        ];
    }
}
