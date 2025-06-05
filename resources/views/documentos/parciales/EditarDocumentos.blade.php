{{-- filepath: resources/views/documentos/parciales/EditarDocumentos.blade.php --}}
<form {{ route('EditarDocumentos') }}" method="POST" enctype="multipart/form-data" class="space-y-4"
    id="frm_editar_documentos">
    @csrf
    <input type="hidden" name="id_documento" id="id_documento" value="{{ $documento->id }}">
    <div class="border border-gray-600 p-4 rounded-lg">
        <h3 class="text-lg font-semibold mb-2">Editar Documento</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm mb-2" for="nombre">Nombre del Documento</label>
                <input type="text" name="nombre" id="nombre" class="w-full rounded p-2 text-black"
                    value="{{ $documento->nombre }}" required>
            </div>
            <div>
                <label class="block text-sm mb-2" for="tipo">Tipo de Documento</label>
                <select name="tipo" id="tipo" class="w-full rounded p-2 text-black" required data-valor="{{ $documento->tipo }}">
                    <option value="">Selecciona un tipo</option>
                </select>
            </div>
            <div>
                <label class="block text-sm mb-2" for="fecha_documento">Fecha del Documento</label>
                <input type="date" name="fecha_documento" id="fecha_documento" class="w-full rounded p-2 text-black"
                    value="{{ $documento->fecha_documento }}" required>
            </div>
            <div>
                <label class="block text-sm mb-2" for="archivo">Archivo (opcional, solo si deseas reemplazar)</label>
                <div class="flex items-center gap-2">
                    <label for="archivo" class="cursor-pointer bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-4 rounded shadow transition-all duration-300 ease-in-out flex items-center gap-2">
                        <i class="fas fa-upload"></i> Seleccionar archivo
                    </label>
                    <span id="archivo-nombre" class="text-gray-300 text-sm truncate">Ningún archivo seleccionado</span>
                </div>
                <input type="file" name="archivo" id="archivo" class="hidden">
                @if($documento->nombre_original)
                    <div class="text-xs text-gray-400 mt-1">Archivo actual: <span class="text-white">{{ $documento->nombre_original }}</span></div>
                @endif
            </div>
        </div>
        <div class="mt-4">
            <label class="block text-sm mb-2" for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" rows="3" class="w-full rounded p-2 text-black">{{ $documento->descripcion }}</textarea>
        </div>
    </div>

    <div class="flex justify-end space-x-4 mt-6">
        <button
            type="button"
            id="btn-cancelar-editar"
            class="flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-5 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 ease-in-out"
        >
            <i class="fas fa-times-circle"></i> Cancelar
        </button>

        <button
            type="button"
            id="btn-guardar-editar"
            class="flex items-center gap-2 bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-5 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 ease-in-out"
        >
            <i class="fas fa-save"></i> Guardar Cambios
        </button>
    </div>
</form>

<div id="spinner-global" style="display: none;"
    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="sk-chase">
        <div class="sk-chase-dot"></div>
        <div class="sk-chase-dot"></div>
        <div class="sk-chase-dot"></div>
        <div class="sk-chase-dot"></div>
        <div class="sk-chase-dot"></div>
        <div class="sk-chase-dot"></div>
    </div>
</div>