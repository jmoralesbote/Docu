document.addEventListener('alpine:init', () => {
    console.log('Alpine está inicializado');

    window.addEventListener('swal:confirm', event => {
        // Si event.detail es un array, toma el primer elemento
        const detail = Array.isArray(event.detail) ? event.detail[0] : event.detail;
        console.log('Evento swal:confirm recibido', detail);

        Swal.fire({
            icon: detail.type,
            title: detail.message,
            text: detail.text,
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            console.log('Resultado del SweetAlert:', result);
            if (result.isConfirmed) {
                console.log('Disparando eliminarUsuarioEvent con id:', detail.id_user);
                window.dispatchEvent(new CustomEvent('eliminarUsuarioEvent', { detail: [detail.id_user] }));
            }
        });
    });
});

window.addEventListener('swal:success', event => {
    console.log('Evento swal:success recibido', event.detail);
    Swal.fire({
        icon: 'success',
        title: '¡Listo!',
        text: event.detail.message,
        timer: 1500,
        showConfirmButton: false
    });
});