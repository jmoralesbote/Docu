<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\SolicitudDocumentos;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class EntregaTable extends DataTableComponent
{
    protected $model = SolicitudDocumentos::class;
    protected $listeners = [
        'rechazarSolicitud' => 'rechazarSolicitud'
    ];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->hideIf(true),
            Column::make("Solicitante", "usuario_id")
                ->format(function($value, $row) {
                    return $row->usuario ? $row->usuario->user_nombre : '';
                }),
            Column::make("Documento", "tipo_documento")
                ->collapseOnTablet(),
            Column::make("Fecha de Solicitud", "fecha_solicitud")
                ->sortable()
                ->format(fn($value) => Carbon::parse($value)->format('d/m/Y'))
                ->collapseOnTablet(),
            Column::make("Comentario", "comentario")
                ->format(function($value) {
                    return '<div style="max-width:220px; white-space:pre-line; word-break:break-word;">'.e($value).'</div>';
                })
                ->html()
                ->collapseOnTablet(),
            Column::make("Estado", "estado")
                ->format(function($value) {
                    $color = match ($value) {
                        'PENDIENTE' => '#f59e42',   // naranja
                        'ATENDIDA'  => '#22c55e',   // verde
                        'RECHAZADO' => '#ef4444',   // rojo
                    };
                    return '<span style="background:'.$color.';color:white;padding:4px 8px;border-radius:4px;display:inline-block;">'.$value.'</span>';
                })
                ->html(),
            Column::make("Archivo Enviado", "nombre_archivo")
            ->collapseOnTablet(),
            Column::make("Created at", "created_at")
            ->hideIf(true),
            Column::make("Updated at", "updated_at")
            ->hideIf(true),
            Column::make("Acciones")
                ->label(fn($row, Column $column) => view('livewire.solicitudoc.documentos-list-acciones')->with('documento', $row))
                ->collapseOnTablet(),
        ];
    }

    public function confirmarRechazo($id)
    {
        $this->dispatch('swal:rechazar', [
            'id_documento' => $id,
            'message' => '¿Estás seguro de rechazar esta solicitud?',
            'text' => 'Puedes agregar un motivo de rechazo.',
        ]);
    }

    public function rechazarSolicitud($id, $motivo)
    {
        $solicitud = SolicitudDocumentos::find($id);
        if ($solicitud) {
            $solicitud->estado = 'RECHAZADO';
            $solicitud->comentario_s = $motivo;
            $solicitud->revisado_por = Auth::id();
            $solicitud->fecha_revisado = now();
            $solicitud->save();

            $this->dispatch('swal:success', [
                'message' => 'Solicitud rechazada correctamente.'
            ]);
        }
    }
}
