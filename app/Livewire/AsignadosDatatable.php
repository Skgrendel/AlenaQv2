<?php

namespace App\Livewire;

use App\Exports\ReportExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Dbssurtigas;
use Illuminate\Support\Facades\Auth;

class AsignadosDatatable extends DataTableComponent
{
    protected $model = Dbssurtigas::class;
    public ?string $searchPlaceholder = 'Buscar por Contrato';
    public ?int $searchFilterDebounce = 500;
    public string $defaultSortDirection = 'desc';


    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setColumnSelectStatus(false);
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
                        $builder->where('Dbssurtigas.estado', '1');
                    } elseif ($value === '2') {
                        $builder->where('Dbssurtigas.estado', '0');
                    }
                }),
        ];
    }

    public function builder(): Builder
    {
        $user = Auth::user();
        $personalId = $user->personals_id;

        return Dbssurtigas::query()->where('Dbssurtigas.personals_id', $personalId);
    }

    public function columns(): array
    {
        return [
            Column::make("Contrato", "contrato")
            ->searchable(),
            Column::make("Direccion", "direccion")
            ->collapseOnMobile(),
            Column::make("Ciclo", "ciclo")
            ->collapseOnMobile(),
            Column::make("Estado", "estado")
                ->format(
                    fn ($value) => $value == 0 ? '<span class="badge badge-success">Revisado</span>' : '<span class="badge badge-warning">Pendiente</span>'
                )
                ->html()
                ->collapseOnMobile(),
                Column::make('Acciones', 'contrato')
                ->format(
                    fn ($value, $row, Column $column) => view('agentes.asignados.actions', compact('value'))
                ),
        ];
    }
}
