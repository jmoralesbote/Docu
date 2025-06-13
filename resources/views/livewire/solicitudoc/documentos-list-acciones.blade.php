@if(!in_array($documento->estado, ['ATENDIDA', 'RECHAZADO']))
<div class="flex items-center gap-2">
    <a href="{{ route('indexAltaEntrega', $documento->id) }}"
       class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-emerald-500 text-white shadow hover:shadow-lg hover:-translate-y-1 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-emerald-300"
       title="Entregar documento">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM6.97 11.03a.75.75 0 0 0 1.07 0l3.992-3.992a.75.75 0 1 0-1.06-1.06L7.5 9.44 5.53 7.47a.75.75 0 0 0-1.06 1.06l2.5 2.5z"/>
        </svg>
    </a>
    <button type="button"
        class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-red-600 text-white shadow hover:shadow-lg hover:-translate-y-1 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-red-300"
        wire:click="confirmarRechazo({{ $documento->id }})"
        title="Rechazar solicitud">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.646 4.646a.5.5 0 0 0 0 .708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646a.5.5 0 0 0-.708 0z"/>
        </svg>
    </button>
</div>
@endif