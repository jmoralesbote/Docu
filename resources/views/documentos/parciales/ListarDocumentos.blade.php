<div x-data x-on:eliminarDocumentoEvent.window="$wire.eliminarDocumentoHandler($event.detail[0])">
    @livewire('documentos-table')
</div>