<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class SolicitudDocumentos extends Model
{
    use HasFactory;

    protected $table = 'solicitudes_documentos';
    protected $guarded = [''];

    public function usuario(){
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function revisor(){
        return $this->belongsTo(User::class, 'revisado_por');
    }
}
