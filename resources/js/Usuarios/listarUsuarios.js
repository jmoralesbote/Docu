document.addEventListener('alpine:init', () => {

    window.addEventListener('swal:confirm', event => {
        // Si event.detail es un array, toma el primer elemento
        const detail = Array.isArray(event.detail) ? event.detail[0] : event.detail;

        Swal.fire({
            icon: detail.type,
            title: detail.message,
            text: detail.text,
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                window.dispatchEvent(new CustomEvent('eliminarUsuarioEvent', { detail: [detail.id_user] }));
            }
        });
    });
});

window.addEventListener('swal:success', event => {
    Swal.fire({
        icon: 'success',
        title: '¡Listo!',
        text: event.detail.message,
        timer: 1500,
        showConfirmButton: false
    });
});