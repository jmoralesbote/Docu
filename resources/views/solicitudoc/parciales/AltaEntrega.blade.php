<form action="{{ route('AltaEntrega') }}" method="POST" id="frm_entrega_documento" class="space-y-4"
    enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="solicitud_id" value="{{ $solicitud_id }}">
    <div class="border border-gray-600 p-4 rounded-lg">
        <h3 class="text-lg font-semibold mb-2">Entrega de documento solicitado</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm mb-2" for="archivo_respuesta">Archivo a entregar</label>
                <input type="file" name="archivo_respuesta" id="archivo_respuesta"
                    class="w-full rounded p-2 text-black bg-gray-200" accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.png"
                    required>
                <div class="text-xs text-gray-400 mt-1" id="nombre-archivo">Ningún archivo seleccionado</div>
            </div>
        </div>
        <div class="mt-4">
            <label class="block text-sm mb-2" for="comentario_respuesta">Comentario de respuesta (opcional)</label>
            <textarea name="comentario_respuesta" id="comentario_respuesta" rows="3" class="w-full rounded p-2 text-black"
                placeholder="Agrega un comentario si lo deseas"></textarea>
        </div>
    </div>

    <div class="flex justify-end space-x-4 mt-6">
        <button type="button" id="btn-cancelar-entrega"
            class="flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-5 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 ease-in-out">
            <i class="fas fa-times-circle"></i> Cancelar
        </button>
        <button type="button" id="btn-guardar-entrega"
            class="flex items-center gap-2 bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-5 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 ease-in-out">
            <i class="fas fa-paper-plane"></i> Entregar
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

<script>
    // Mostrar nombre del archivo seleccionado
    document.addEventListener('DOMContentLoaded', () => {
        const inputArchivo = document.getElementById('archivo_respuesta');
        const nombreArchivo = document.getElementById('nombre-archivo');
        if (inputArchivo && nombreArchivo) {
            inputArchivo.addEventListener('change', function() {
                nombreArchivo.textContent = inputArchivo.files.length > 0 ?
                    inputArchivo.files[0].name :
                    'Ningún archivo seleccionado';
            });
        }
    });
</script>
