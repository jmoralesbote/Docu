{{-- filepath: resources/views/documentos/parciales/DetalleDocumentos.blade.php --}}
<div class="bg-gray-900 rounded-xl shadow-lg border border-purple-700 max-w-2xl mx-auto overflow-hidden">
    <div class="bg-purple-800 px-6 py-4 sm:px-8 sm:py-6">
        <h2 class="text-xl sm:text-2xl font-bold text-white flex items-center gap-2">
            <i class="fas fa-file-alt"></i> Detalle del Documento
        </h2>
    </div>
    <div class="p-4 sm:p-8 space-y-4 sm:space-y-6">
        <div>
            <span class="block text-xs sm:text-sm text-gray-400">Nombre del Documento</span>
            <span class="text-base sm:text-lg text-white font-semibold break-words">{{ $documento->nombre }}</span>
        </div>
        <div>
            <span class="block text-xs sm:text-sm text-gray-400">Tipo de Documento</span>
            <span class="inline-block bg-purple-700 text-white px-2 sm:px-3 py-1 rounded-full text-xs font-semibold">{{ $documento->tipo }}</span>
        </div>
        <div>
            <span class="block text-xs sm:text-sm text-gray-400">Fecha del Documento</span>
            <span class="text-white">{{ $documento->fecha_documento }}</span>
        </div>
        <div>
            <span class="block text-xs sm:text-sm text-gray-400">Estado</span>
            <span class="inline-block px-2 sm:px-3 py-1 rounded-full text-xs font-semibold
                {{ $documento->estado === 'ACTIVO' ? 'bg-green-700 text-green-200' : 'bg-red-700 text-red-200' }}">
                {{ $documento->estado }}
            </span>
        </div>
        <div>
            <span class="block text-xs sm:text-sm text-gray-400">Subido por</span>
            <span class="text-white break-words">{{ $documento->usuario->user_nombre ?? 'N/A' }}</span>
        </div>
        <div>
            <span class="block text-xs sm:text-sm text-gray-400">Descripción</span>
            <div class="text-gray-200 bg-gray-800 rounded p-2 min-h-[48px] break-words">{{ $documento->descripcion ?? 'Sin descripción' }}</div>
        </div>
        <div>
            <span class="block text-xs sm:text-sm text-gray-400">Archivo</span>
            <a href="{{ asset('storage/' . $documento->archivo) }}" target="_blank"
               class="inline-flex items-center gap-2 bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-3 sm:px-4 rounded shadow mt-1 break-all">
                <i class="fas fa-download"></i> {{ $documento->nombre_original }}
            </a>
        </div>
    </div>
</div>