<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoDocumento;
use Illuminate\Support\Facades\DB;


class TipoDocumentosController extends Controller
{
    public function catalogoTiposDocumento()
    {
        return response()->json(
        DB::table('cat_tipos_documentos')->select('id', 'nombre')->get()
    );
    }
}
