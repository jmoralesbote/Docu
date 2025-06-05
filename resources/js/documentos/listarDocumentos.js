document.addEventListener('alpine:init', () => {
    window.addEventListener('swal:confirm', event => {
        const detail = Array.isArray(event.detail) ? event.detail[0] : event.detail;
        
        // Solo para documentos
        if (detail.id_documento) {
            Swal.fire({
                icon: detail.type,
                title: detail.message,
                text: detail.text,
                showCancelButton: true,
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.dispatchEvent(new CustomEvent('eliminarDocumentoEvent', { detail: [detail.id_documento] }));
                } else {
                }
            });
        } else {
        }
    });
});

window.addEventListener('swal:success', event => {
    console.log('swal:success event listener ejecutado');
    console.log('Evento swal:success recibido:', event.detail);
    Swal.fire({
        icon: 'success',
        title: '¡Listo!',
        text: event.detail.message,
        timer: 1500,
        showConfirmButton: false
    });
});