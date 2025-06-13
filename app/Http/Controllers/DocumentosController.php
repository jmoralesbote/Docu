<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Documentos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;

class DocumentosController extends Controller
{
    public function indexAltaDocumentos(){
        return view('documentos.indexAltaDocumentos');
    }

    public function AltaDocumentos(Request $request){
        $request->validate([
            'nombre' => 'required|string|max:100',
            'tipo' => 'required|string|max:50',
            'fecha_documento' => 'required|date',
            'archivo' => 'required|file',
            'descripcion' => 'nullable|string',
        ]);

        try {
            $rutaArchivo = $request->file('archivo')->store('documentos', 'public');

            $documento = new Documentos();
            $documento->nombre = $request->nombre;
            $documento->tipo = $request->tipo;
            $documento->fecha_documento = $request->fecha_documento;
            $documento->archivo = $rutaArchivo; // Guarda la ruta relativa
            $documento->descripcion = $request->descripcion;
            $documento->estado = 'Activo';
            $documento->user_id = Auth::id(); // Usuario autenticado
            $documento->nombre_original = $request->file('archivo')->getClientOriginalName();
            $documento->save();

            return response()->json(['message' => 'Documento subido exitosamente.'], 200);
        } catch (QueryException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Ocurrió un error inesperado al guardar el documento.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function indexEditarDocumentos($id){
        $documento = Documentos::findOrFail($id);
        return view('documentos.indexEditarDocumentos', compact('documento'));
    }

    public function EditarDocumentos(Request $request)
{
    $request->validate([
        'id_documento' => 'required|exists:documentos,id',
        'nombre' => 'required|string|max:100',
        'tipo' => 'required|string|max:50',
        'fecha_documento' => 'required|date',
        'archivo' => 'nullable|file',
        'descripcion' => 'nullable|string',
    ]);

    try {
        $documento = Documentos::findOrFail($request->id_documento);

        $documento->nombre = $request->nombre;
        $documento->tipo = $request->tipo;
        $documento->fecha_documento = $request->fecha_documento;
        $documento->descripcion = $request->descripcion;

        if ($request->hasFile('archivo')) {
            // Elimina el archivo anterior si existe
            if ($documento->archivo && \Storage::disk('public')->exists($documento->archivo)) {
                \Storage::disk('public')->delete($documento->archivo);
            }
            $rutaArchivo = $request->file('archivo')->store('documentos', 'public');
            $documento->archivo = $rutaArchivo;
            $documento->nombre_original = $request->file('archivo')->getClientOriginalName();
        }

        $documento->save();

        return response()->json(['status' => 'success', 'message' => 'Documento actualizado exitosamente.'], 200);
    } catch (QueryException $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Ocurrió un error inesperado al actualizar el documento.',
            'error' => $e->getMessage(),
        ], 500);
    }
}

    public function indexListarDocumentos(){
        return view('documentos.indexListarDocumentos');
    }

    public function descargar($id)
    {
        $documento = Documentos::findOrFail($id);
        $ruta = 'public/' . $documento->archivo;
        if (!Storage::exists($ruta)) {
            abort(404);
        }
        return Storage::download($ruta, $documento->nombre_original);
    }

    public function indexDetalleDocumentos($id)
    {
        $documento = Documentos::with('usuario')->findOrFail($id);
        return view('documentos.indexDetalleDocumentos', compact('documento'));
    }
}
