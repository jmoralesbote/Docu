// Mostrar nombre del archivo seleccionado
function inicializarNombreArchivo() {
    const inputArchivo = document.getElementById('archivo_respuesta');
    const nombreArchivo = document.getElementById('nombre-archivo');
    if (inputArchivo && nombreArchivo) {
        inputArchivo.addEventListener('change', function() {
            nombreArchivo.textContent = inputArchivo.files.length > 0
                ? inputArchivo.files[0].name
                : 'Ningún archivo seleccionado';
        });
    }
}

// Validaciones para la entrega
const mostrarError = (mensaje) => {
    Swal.fire({
        icon: "error",
        title: "¡Error!",
        text: mensaje,
    });
};

const fncValidarEntrega = () => {
    const archivo = document.getElementById('archivo_respuesta').files[0];
    if (!archivo) {
        mostrarError("Debes seleccionar un archivo para entregar.");
        return true;
    }
    // Puedes agregar validaciones de tamaño o tipo aquí si lo deseas
    return false;
};

const enviarFormularioEntrega = () => {
    const formulario = document.getElementById("frm_entrega_documento");
    const btnGuardar = document.getElementById("btn-guardar-entrega");
    const btnCancelar = document.getElementById("btn-cancelar-entrega");
    const spinner = document.getElementById("spinner-global");

    const guardarFormulario = () => {
        if (fncValidarEntrega()) {
            return;
        }

        const formData = new FormData(formulario);

        btnGuardar.disabled = true;
        btnCancelar.disabled = true;
        if (spinner) spinner.style.display = "flex";

        axios.post("/AltaEntrega", formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            }
        })
            .then((response) => {
                if (spinner) spinner.style.display = "none";
                if (response.data.status === "success" || response.status === 200) {
                    Swal.fire({
                        title: "¡Documento entregado!",
                        text: response.data.message,
                        icon: "success",
                        timer: 2000,
                        showConfirmButton: false,
                    });
                    setTimeout(() => {
                        window.location.href = "/indexListarEntrega";
                    }, 2500);
                } else {
                    throw new Error("Error en la respuesta del servidor.");
                }
            })
            .catch((error) => {
                if (spinner) spinner.style.display = "none";
                let mensajeError = "Ocurrió un error al procesar la entrega.";
                if (error.response && error.response.data && error.response.data.message) {
                    mensajeError = error.response.data.message;
                }
                Swal.fire("¡Error!", mensajeError, "error").then(() => {
                    btnGuardar.disabled = false;
                    btnCancelar.disabled = false;
                });
            });
    };

    const cancelarFormulario = () => {
        formulario.reset();
        window.location.reload();
    };

    btnGuardar.addEventListener("click", guardarFormulario);
    btnCancelar.addEventListener("click", cancelarFormulario);
};

// Inicialización
document.addEventListener("DOMContentLoaded", () => {
    inicializarNombreArchivo();
    enviarFormularioEntrega();
});