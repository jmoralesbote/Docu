@if($solicitud->archivo_respuesta)
        <a href="{{ asset('storage/' . $solicitud->archivo_respuesta) }}"
           download="{{ $solicitud->nombre_archivo }}"
           class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-blue-600 text-white shadow hover:shadow-lg hover:-translate-y-1 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-300"
           title="Descargar archivo de respuesta">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5A1.5 1.5 0 0 0 2.5 14h11a1.5 1.5 0 0 0 1.5-1.5V10.4a.5.5 0 0 1 1 0v2.1A2.5 2.5 0 0 1 13.5 15h-11A2.5 2.5 0 0 1 0 12.5V10.4a.5.5 0 0 1 .5-.5z"/>
                <path d="M7.646 10.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 9.293V1.5a.5.5 0 0 0-1 0v7.793L5.354 7.146a.5.5 0 1 0-.708.708l3 3z"/>
            </svg>
        </a>
@else

@endif