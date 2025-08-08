<?php

namespace App\Livewire;

use App\Models\configuraciones;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\surtigas;
use Illuminate\Support\Facades\Auth;

class AsignadosDatatable extends DataTableComponent
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
            // Aquí es donde agregas otro filtro
            SelectFilter::make('Estado')
                ->options([
                    '' => 'All',
                    '1' => 'Pendientes',
                    '2' => 'Revisados',
                ])
                ->filter(function (Builder $builder, $value) {
                    if ($value === '1') {
                        $builder->where('surtigas.estado', '1');
                    } elseif ($value === '2') {
                        $builder->where('surtigas.estado', '0');
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
        $user = Auth::user();
        $personalId = $user->personals_id;
        // Aquí puedes ajustar la consulta según tus necesidades
        // Por ejemplo, si quieres filtrar por el ID del personal del usuario autenticado:
      return surtigas::query()
            ->where('surtigas.personals_id', $personalId)
            ->with(['personal', 'report_comercio', 'dbSurtigas'])
            ->whereIn('estado', ['1']);
    }

    public function columns(): array
    {
        return [
            Column::make("Contrato", "contrato")
                ->searchable(),
            Column::make("Direccion", "direccion")
                ->collapseOnMobile(),
            Column::make("Barrio", "barrio")
                ->sortable(),
            Column::make("Ciclo", "ciclo")
                ->collapseOnMobile(),
            Column::make("Estado", "estado")
                ->format(
                    fn($value) => $value == 0 ? '<span class="badge badge-success">Registrado</span>' : '<span class="badge badge-warning">Pendiente</span>'
                )
                ->html()
                ->collapseOnMobile(),
            Column::make('Acciones', 'contrato')
                ->format(
                    fn($value, $row, Column $column) => view('agentes.asignados.actions', [
                        'value' => $value,
                        'estado' => $row->estado, // Suponiendo que "estado" es la columna que contiene el valor de estado
                        'contrato' => $row->contrato,
                    ])
                ),
        ];
    }
}
