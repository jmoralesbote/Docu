<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;

class UserTable extends DataTableComponent
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->hideIf(true),
            Column::make("Nombre de usuario", "username")
                    ->sortable(),
            Column::make("Nombre", "user_nombre")
                ->sortable(),
            Column::make("Apellido Paterno", "user_paterno")
                ->sortable(),
            Column::make("Apellido Materno", "user_materno")
                ->sortable(),
            Column::make("Email", "email")
                ->sortable(),
            Column::make("ESTATUS", "user_status"),    
            Column::make("Created at", "created_at")
                ->hideIf(true),
            Column::make("Updated at", "updated_at")
                ->hideIf(true),
        ];
    }
}
