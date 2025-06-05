{{-- filepath: resources/views/livewire/documentos/documentos-list-vd.blade.php --}}
<div class="flex items-center gap-2">
    @php
        // Usar nombre_original si existe, si no, usar el nombre del archivo guardado
        $nombreParaVerificar = $documento->nombre_original ?? $documento->archivo;
        $esPdf = \Illuminate\Support\Str::endsWith(strtolower(trim($nombreParaVerificar)), '.pdf');
    @endphp
    @if($esPdf)
        <a href="{{ asset('storage/' . $documento->archivo) }}"
           target="_blank"
           class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-purple-600 text-white shadow hover:shadow-lg hover:-translate-y-1 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-purple-300"
           title="Ver documento">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zm-8 4.5A4.5 4.5 0 1 1 8 3.5a4.5 4.5 0 0 1 0 9zm0-1A3.5 3.5 0 1 0 8 4.5a3.5 3.5 0 0 0 0 7z"/>
            </svg>
        </a>
    @endif
    <a href="{{ route('documentos.descargar', $documento->id) }}"
       class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-blue-600 text-white shadow hover:shadow-lg hover:-translate-y-1 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-300"
       title="Descargar documento">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5A1.5 1.5 0 0 0 2.5 14h11a1.5 1.5 0 0 0 1.5-1.5V10.4a.5.5 0 0 1 1 0v2.1A2.5 2.5 0 0 1 13.5 15h-11A2.5 2.5 0 0 1 0 12.5V10.4a.5.5 0 0 1 .5-.5z"/>
            <path d="M7.646 10.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 9.293V1.5a.5.5 0 0 0-1 0v7.793L5.354 7.146a.5.5 0 1 0-.708.708l3 3z"/>
        </svg>
    </a>
</div>