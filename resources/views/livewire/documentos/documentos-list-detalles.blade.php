{{-- filepath: resources/views/livewire/documentos/documentos-list-detalle.blade.php --}}
<a href="{{ route('indexDetalleDocumentos', $documento->id) }}"
   class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-blue-500 text-white shadow hover:shadow-lg hover:-translate-y-1 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-300"
   title="Ver detalle">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-text" viewBox="0 0 16 16">
            <path d="M5 7a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5A.5.5 0 0 1 5 7zm0 2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5A.5.5 0 0 1 5 9zm0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z"/>
            <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3.5-3V4a1 1 0 0 0 1 1h2.5L10.5 1.5z"/>
        </svg>
</a>