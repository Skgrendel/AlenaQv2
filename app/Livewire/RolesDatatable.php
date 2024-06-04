<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Role;

class RolesDatatable extends DataTableComponent
{
    protected $model = Role::class;
    public ?string $searchPlaceholder = 'Buscar';
    public ?int $searchFilterDebounce = 500;
    public string $defaultSortDirection = 'asc';

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setColumnSelectStatus(false);
        $this->setPerPage(10);
        $this->setConfigurableAreas([
            'toolbar-left-end' => 'admin.roles.drop',
        ]);
      
    }


    public function columns(): array
    {

        return [
            Column::make("ID", "id")
                ->sortable(),
            Column::make("Nombre del Rol", "name")
                ->sortable(),
            Column::make('Acciones', 'id')
                ->format(
                    fn ($value, $row, Column $column) => view('admin.roles.actions', compact('value'))
                ),
        ];
    }
}
