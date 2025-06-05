<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;


class UserTable extends DataTableComponent
{
    protected $model = User::class;

    protected $listeners = [
        'eliminarUsuarioEvent' => 'eliminarUsuarioHandler'
    ];

    public function builder(): Builder
    {
        return User::query()
            ->where('user_status', 'ACTIVO') 
            ->orderBy('user_nombre', 'asc');

    }
    
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
            Column::make("Acciones")
                ->label(fn($row, Column $column) => view('livewire.usuarios.usuarios-list-acciones')->with('user', $row)),
        ];
    }

    public function confirmarEliminacion($id)
    {
        $this->dispatch('swal:confirm', [
            'type' => 'warning',
            'message' => 'Está seguro que quiere eliminar el registro?',
            'text' => 'Si se elimina el registro, no podrá recuperarlo!',
            'id_user' => $id // Cambia 'user' por 'id_user' para que coincida con tu JS
        ]);
    }   

    public function eliminarUsuarioHandler($id)
    {
        $usuario = User::find($id);
        if ($usuario) {
            $usuario->user_status = 'BAJA';
            $usuario->save();
            $this->dispatch('swal:success', [
                'message' => 'Usuario dado de baja correctamente.'
            ]);
        }
    }
}
