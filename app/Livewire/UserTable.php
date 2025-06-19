<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class UserTable extends DataTableComponent
{
    protected $model = User::class;

    protected $listeners = [
        'eliminarUsuarioEvent' => 'eliminarUsuarioHandler'
    ];

    public function builder(): Builder
    {
        return User::query()
            ->select(['id', 'username', 'user_nombre', 'user_paterno', 'user_materno', 'email', 'user_status', 'created_at', 'updated_at'])
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
                ->collapseOnTablet(),
            Column::make('Nombre completo', 'user_nombre')
                ->label(fn($row) => $row->user_nombre . ' ' . $row->user_paterno . ' ' . $row->user_materno)
                ->searchable(function(Builder $query, $searchTerm) {
                    $query->where(function($q) use ($searchTerm) {
                        $q->where('user_nombre', 'like', "%{$searchTerm}%")
                        ->orWhere('user_paterno', 'like', "%{$searchTerm}%")
                        ->orWhere('user_materno', 'like', "%{$searchTerm}%")
                        ->orWhere(
                            DB::raw("CONCAT(user_nombre, ' ', user_paterno, ' ', user_materno)"),
                            'like',
                            "%{$searchTerm}%"
                        );
                    });
                }),
            Column::make("Email", "email")
                ->collapseOnTablet(),
            Column::make("ESTATUS", "user_status")
                ->format(function($value, $row) {
                    $color = $row->user_status === 'ACTIVO' ? '#22c55e' : '#ef4444'; // verde y rojo de Tailwind
                    return '<span style="background:'.$color.';color:white;padding:4px 8px;border-radius:4px;display:inline-block;">'.$row->user_status.'</span>';
                })
                ->html()
                ->collapseOnTablet(),    
            Column::make("Created at", "created_at")
                ->hideIf(true),
            Column::make("Updated at", "updated_at")
                ->hideIf(true),
            Column::make("Acciones")
                ->label(fn($row, Column $column) => view('livewire.usuarios.usuarios-list-acciones')->with('user', $row))
                ->collapseOnTablet(),
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
