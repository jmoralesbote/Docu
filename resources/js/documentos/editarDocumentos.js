// Función para obtener los tipos de documento desde el backend
async function obtenerTiposDocumento() {
    try {
        const response = await axios.get('/catalogo-tipos-documento');
        return response.data;
    } catch (error) {
        console.error('Error al obtener el catálogo de tipos de documento:', error);
        return [];
    }
}

// Función para cargar los tipos en el select y seleccionar el valor guardado
function cargarTiposEnSelect(tipos, valorActual, selectId = 'tipo') {
    const select = document.getElementById(selectId);
    if (!select) return;
    select.innerHTML = '<option value="">Selecciona un tipo</option>';
    tipos.forEach(tipo => {
        const option = document.createElement('option');
        option.value = tipo.nombre;
        option.textContent = tipo.nombre;
        if (tipo.nombre === valorActual) {
            option.selected = true;
        }
        select.appendChild(option);
    });
}

// Validaciones para editar documento
const mostrarError = (mensaje) => {
    Swal.fire({
        icon: "error",
        title: "¡Error!",
        text: mensaje,
    });
};

const fncValidarDocumentoEditar = () => {
    const nombre = document.getElementById('nombre').value.trim();
    const tipo = document.getElementById('tipo').value;
    const fecha = document.getElementById('fecha_documento').value;
    const archivo = document.getElementById('archivo').files[0];
    const maxSize = 5 * 1024 * 1024;

    if (nombre === "") {
        mostrarError("El nombre del documento no puede estar vacío.");
        return true;
    }
    if (nombre.length > 100) {
        mostrarError("El nombre del documento no puede tener más de 100 caracteres.");
        return true;
    }
    if (tipo === "") {
        mostrarError("Debes seleccionar un tipo de documento.");
        return true;
    }
    if (fecha === "") {
        mostrarError("La fecha del documento no puede estar vacía.");
        return true;
    }
    // El archivo es opcional en editar, pero si se selecciona, validar tamaño
    if (archivo && archivo.size > maxSize) {
        mostrarError("El archivo no debe superar los 5MB.");
        return true;
    }
    return false;
};

// Envío del formulario por Axios
const enviarFormularioEditarDocumentos = () => {
    const formulario = document.getElementById("frm_editar_documentos");
    const btnGuardar = document.getElementById("btn-guardar-editar");
    const btnCancelar = document.getElementById("btn-cancelar-editar");
    const spinner = document.getElementById("spinner-global");

    const guardarFormulario = () => {
        if (fncValidarDocumentoEditar()) {
            return;
        }

        const formData = new FormData(formulario);

        btnGuardar.disabled = true;
        btnCancelar.disabled = true;
        if (spinner) spinner.style.display = "flex";

        axios.post("/EditarDocumentos", formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            }
        })
            .then((response) => {
                if (spinner) spinner.style.display = "none";
                if (response.data.status === "success") {
                    Swal.fire({
                        title: "¡Actualizado!",
                        text: response.data.message,
                        icon: "success",
                        timer: 2000,
                        showConfirmButton: false,
                    });
                    setTimeout(() => {
                        window.location.href = "/indexListarDocumentos";
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
        window.location.reload();
    };

    btnGuardar.addEventListener("click", guardarFormulario);
    btnCancelar.addEventListener("click", cancelarFormulario);
};

// Carga inicial
document.addEventListener("DOMContentLoaded", async () => {
    const select = document.getElementById('tipo');
    const valorActual = select ? select.getAttribute('data-valor') : '';
    const tipos = await obtenerTiposDocumento();
    cargarTiposEnSelect(tipos, valorActual);

    // Inicializar eventos del formulario
    enviarFormularioEditarDocumentos();
});

document.addEventListener("DOMContentLoaded", () => {
    const inputArchivo = document.getElementById('archivo');
    const archivoNombre = document.getElementById('archivo-nombre');
    if (inputArchivo && archivoNombre) {
        inputArchivo.addEventListener('change', function() {
            archivoNombre.textContent = inputArchivo.files.length > 0
                ? inputArchivo.files[0].name
                : 'Ningún archivo seleccionado';
        });
    }
});