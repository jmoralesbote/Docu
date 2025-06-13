<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SolicitudDocumentos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SolicitudocController extends Controller
{
    public function indexAltaSolicitud(){
        return view('solicitudoc.indexAltaSolicitud');
    }

    public function AltaSolicitud(Request $request)
    {
        $request->validate([
            'tipo_documento' => 'required|string|max:50',
            'comentario' => 'nullable|string|max:255',
            'fecha_solicitud' => 'required|date',
        ]);

        try {
            $solicitud = new SolicitudDocumentos();
            $solicitud->tipo_documento = $request->tipo_documento;
            $solicitud->comentario = $request->comentario;
            $solicitud->fecha_solicitud = $request->fecha_solicitud;
            $solicitud->estado = 'PENDIENTE';
            $solicitud->usuario_id = Auth::id();

            $solicitud->save();

            return response()->json(['message' => 'Solicitud enviada correctamente.'], 200);
        } catch (QueryException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Ocurrió un error inesperado al guardar la solicitud.',
            ], 500);
        }
    }

    public function indexListarSolicitud(){
        return view('solicitudoc.indexListarSolicitud');
    }

    public function indexAltaEntrega($solicitud_id){
        $solicitud =SolicitudDocumentos::findOrFail($solicitud_id);
        return view('solicitudoc.indexAltaEntrega', [
            'comentario' => $solicitud->comentario,
            'solicitud_id' => $solicitud->id
        ]);
    }

    public function AltaEntrega(Request $request)
    {
        $request->validate([
            'archivo_respuesta' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,png|max:10240', // 10MB máx
            'comentario_respuesta' => 'nullable|string|max:255',
            'solicitud_id' => 'required|exists:solicitudes_documentos,id',
        ]);

        try {
            // Buscar la solicitud
            $solicitud = SolicitudDocumentos::findOrFail($request->solicitud_id);

            // Guardar el archivo
            $archivo = $request->file('archivo_respuesta');
            $rutaArchivo = $archivo->store('entregas', 'public');

            // Actualizar la solicitud
            $solicitud->archivo_respuesta = $rutaArchivo;
            $solicitud->nombre_archivo = $archivo->getClientOriginalName();
            $solicitud->comentario_s = $request->comentario_respuesta;
            $solicitud->fecha_revisado = now();
            $solicitud->revisado_por = Auth::id();
            $solicitud->estado = 'ATENDIDA';
            $solicitud->save();

            return response()->json(['message' => 'Documento enviado correctamente.'], 200);
        } catch (QueryException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Ocurrió un error inesperado al guardar la solicitud.',
            ], 500);
        }
    }

    public function indexListarEntrega(){
        return view('solicitudoc.indexListarEntrega');
    }

}
