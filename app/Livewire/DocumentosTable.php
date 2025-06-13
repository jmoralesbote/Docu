<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Documentos;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class DocumentosTable extends DataTableComponent
{
    protected $model = Documentos::class;

    protected $listeners = [
        'eliminarDocumentoEvent' => 'eliminarDocumentoHandler'
    ];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        return Documentos::query()->nombreUsuario();
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->hideIf(true),
            Column::make("Nombre", "nombre")
                ->sortable()
                ->searchable(),
            Column::make("Descripción", "descripcion")
            ->hideIf(true),
            Column::make("Tipo de Documento", "tipo")
                ->sortable()
                ->searchable(),
            Column::make("Fecha de subida", "fecha_documento")
                ->format(fn($value) => Carbon::parse($value)->format('d/m/Y'))
                ->collapseOnTablet(),
            Column::make("Ruta", "archivo")
            ->hideIf(true),
            Column::make("Estado", "estado"),
            Column::make("Usuario que subió", "user_id")
                ->format(fn($value, $column, $row) => $column->nombre_usuario)
                ->collapseOnTablet(),
            Column::make("Created at", "created_at")
                ->hideIf(true),
            Column::make("Updated at", "updated_at")
                ->hideIf(true),
            Column::make("Ver/Descargar")
                ->label(fn($row, Column $column) => view('livewire.documentos.documentos-list-vd')->with('documento', $row))
                ->collapseOnTablet(),
            Column::make("Detalles")
                ->label(fn($row, Column $column) => view('livewire.documentos.documentos-list-detalles')->with('documento', $row))
                ->collapseOnTablet(),
            Column::make("Acciones")
                ->label(fn($row, Column $column) => view('livewire.documentos.documentos-list-acciones')->with('documento', $row))
                ->collapseOnTablet(),
            
            
        ];
    }

    public function confirmarEliminacion($id)
    {
        $this->dispatch('swal:confirm', [
            'type' => 'warning',
            'message' => '¿Está seguro que quiere eliminar el documento?',
            'text' => 'Si se elimina el documento, no podrá recuperarlo.',
            'id_documento' => $id
        ]);
    }

    public function eliminarDocumentoHandler($id)
    {
        $documento = Documentos::find($id);
        if ($documento) {
            $documento->estado = 'BAJA';
            $documento->save();
            $this->dispatch('swal:success', [
                'message' => 'Documento eliminado correctamente.'
            ]);
        }
    }
}
