<form action="{{ route('AltaSolicitud') }}" method="POST" class="space-y-4" id="frm_solicitud_documento">
    @csrf

    <div class="border border-gray-600 p-4 rounded-lg">
        <h3 class="text-lg font-semibold mb-2">Datos de la solicitud</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm mb-2" for="tipo_documento">Tipo de documento</label>
                <select name="tipo_documento" id="tipo_documento" class="w-full rounded p-2 text-black" required>
                    <option value="">Selecciona un tipo</option>
                    <!-- Opciones se llenan por JS -->
                </select>
            </div>
            <div>
                <label class="block text-sm mb-2" for="fecha_solicitud">Fecha de solicitud</label>
                <input type="date" name="fecha_solicitud" id="fecha_solicitud" class="w-full rounded p-2 text-black bg-gray-200" readonly>
            </div>
        </div>
        <div class="mt-4">
            <label class="block text-sm mb-2" for="comentario">Comentario o motivo (opcional)</label>
            <textarea name="comentario" id="comentario" rows="3" class="w-full rounded p-2 text-black" placeholder="Explica por qué solicitas el documento"></textarea>
        </div>
    </div>

    <div class="flex justify-end space-x-4 mt-6">
        <button
            type="button"
            id="btn-cancelar-solicitud"
            class="flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-5 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 ease-in-out"
        >
            <i class="fas fa-times-circle"></i> Cancelar
        </button>
        <button
            type="button"
            id="btn-guardar-solicitud"
            class="flex items-center gap-2 bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-5 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 ease-in-out"
        >
            <i class="fas fa-paper-plane"></i> Solicitar
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