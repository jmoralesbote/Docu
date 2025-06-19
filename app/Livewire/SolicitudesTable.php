<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\SolicitudDocumentos;
use Carbon\Carbon;



class SolicitudesTable extends DataTableComponent
{
    protected $model = SolicitudDocumentos::class;

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
                        return $row->usuario ? $row->usuario->user_nombre : 'NO REVISADO';
                    })
                ->collapseOnTablet(),
            Column::make("Documento", "tipo_documento"),
            Column::make("Fecha Solicitud", "fecha_solicitud")
                ->format(fn($value) => Carbon::parse($value)->format('d/m/Y'))
                ->collapseOnTablet(),
            Column::make("Comentario", "comentario_s")
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
            Column::make("Revisado por", "revisado_por")
                ->format(function($value, $row) {
                    return $row->revisor ? $row->revisor->user_nombre : 'NO REVISADO';
                })
                ->collapseOnTablet(),
            Column::make("Revisado el", "fecha_revisado")
                ->format(fn($value) => $value ? Carbon::parse($value)->format('d/m/Y') : 'NO REVISADO')
                ->collapseOnTablet(),
            Column::make("Archivo Respuesta", "archivo_respuesta")
                ->hideiF(true)
                ->collapseOnTablet(),
            Column::make("Nombre archivo", "nombre_archivo")
                ->hideIf(true),
            Column::make("Respuesta")
                ->label(fn($row, $column) => view('livewire.solicitudoc.documentos-list-d')->with('solicitud', $row))
                ->collapseOnTablet(),
            Column::make("Created at", "created_at")
                ->hideIf(true),
            Column::make("Updated at", "updated_at")
                ->hideIf(true),
        ];
    }
}
