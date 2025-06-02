<div x-data x-on:eliminarUsuarioEvent.window="$wire.eliminarUsuarioHandler($event.detail[0])">
    @livewire('user-table')
</div>