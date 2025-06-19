console.log('listarEntrega.js cargado');

document.addEventListener('alpine:init', () => {
    console.log('alpine:init escuchado');
    window.addEventListener('swal:rechazar', event => {
        console.log('Evento swal:rechazar recibido', event.detail);
        const detail = event.detail[0];
        console.log('detail.id_documento:', detail.id_documento);
        Swal.fire({
            icon: 'warning',
            title: detail.message,
            text: detail.text,
            input: 'textarea',
            inputLabel: 'Motivo del rechazo',
            inputPlaceholder: 'Escribe el motivo aquí...',
            showCancelButton: true,
            confirmButtonText: 'Sí, rechazar',
            cancelButtonText: 'Cancelar',
            inputValidator: (value) => {
                if (!value) {
                    return 'Debes escribir un motivo para rechazar.';
                }
            }
        }).then((result) => {
            console.log('Resultado SweetAlert:', result);
            if (result.isConfirmed) {
                console.log('Enviando a Livewire:', detail.id_documento, result.value);
                Livewire.dispatch('rechazarSolicitud', [detail.id_documento, result.value]);
            }
        });
    });

    window.addEventListener('swal:success', event => {
        console.log('Evento swal:success recibido', event.detail);
        Swal.fire({
            icon: 'success',
            title: '¡Rechazado!',
            text: event.detail.message,
            timer: 2000,
            showConfirmButton: false
        });
    });
});