// Opciones fijas para el select de tipo de documento
const tiposFijos = [
    { nombre: "OFICIO" },
    { nombre: "CIRCULAS" },
    { nombre: "CONSTANCIA" },
    { nombre: "OTRO" }
];

// Función para cargar los tipos en el select
function cargarTiposEnSelect(tipos = tiposFijos, selectId = 'tipo_documento') {
    const select = document.getElementById(selectId);
    if (!select) return;
    select.innerHTML = '<option value="">Selecciona un tipo</option>';
    tipos.forEach(tipo => {
        const option = document.createElement('option');
        option.value = tipo.nombre;
        option.textContent = tipo.nombre;
        select.appendChild(option);
    });
}

// Validaciones para la solicitud
const mostrarError = (mensaje) => {
    Swal.fire({
        icon: "error",
        title: "¡Error!",
        text: mensaje,
    });
};

const fncValidarSolicitud = () => {
    const tipo = document.getElementById('tipo_documento').value;
    if (tipo === "") {
        mostrarError("Debes seleccionar un tipo de documento.");
        return true;
    }
    return false;
};

const enviarFormularioSolicitud = () => {
    const formulario = document.getElementById("frm_solicitud_documento");
    const btnGuardar = document.getElementById("btn-guardar-solicitud");
    const btnCancelar = document.getElementById("btn-cancelar-solicitud");
    const spinner = document.getElementById("spinner-global");

    const guardarFormulario = () => {
        if (fncValidarSolicitud()) {
            return;
        }

        const formData = new FormData(formulario);

        btnGuardar.disabled = true;
        btnCancelar.disabled = true;
        if (spinner) spinner.style.display = "flex";

        axios.post("/AltaSolicitud", formData)
            .then((response) => {
                if (spinner) spinner.style.display = "none";
                if (response.status === 200) {
                    Swal.fire({
                        title: "¡Solicitud enviada!",
                        text: response.data.message,
                        icon: "success",
                        timer: 2000,
                        showConfirmButton: false,
                    });
                    setTimeout(() => {
                        window.location.href = "/indexListarSolicitud";
                    }, 2500);
                } else {
                    throw new Error("Error en la respuesta del servidor.");
                }
            })
            .catch((error) => {
                if (spinner) spinner.style.display = "none";
                let mensajeError = "Ocurrió un error al procesar la solicitud.";
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

// Sección de eventos
document.addEventListener("DOMContentLoaded", () => {
    cargarTiposEnSelect();
    // Poner la fecha actual en el campo y bloquear edición
    const fechaInput = document.getElementById('fecha_solicitud');
    if (fechaInput) {
        const fecha = new Date().toISOString().split('T')[0];
        fechaInput.value = fecha;
        fechaInput.readOnly = true;
    }
    enviarFormularioSolicitud();
});