<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Documentos extends Model
{
    use HasFactory;
    protected $table = 'documentos';
    protected $guarded = [];
    
    public function scopeNombreUsuario($query)
    {
        return $query
            ->join('users', 'users.id', '=', 'documentos.user_id')
            ->select('documentos.*', 'users.user_nombre as nombre_usuario');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
