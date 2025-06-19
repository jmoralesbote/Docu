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

// Función para cargar los tipos en el select
function cargarTiposEnSelect(tipos, selectId = 'tipo') {
    const select = document.getElementById(selectId);
    if (!select) return;
    select.innerHTML = '<option value="">Selecciona un tipo</option>';
    tipos.forEach(tipo => {
        const option = document.createElement('option');
        option.value = tipo.nombre; // O tipo.id si prefieres guardar el id
        option.textContent = tipo.nombre;
        select.appendChild(option);
    });
}

// Solo diseño visual del botón de archivo
const inputArchivo = document.getElementById('archivo');
const archivoNombre = document.getElementById('archivo-nombre');
if (inputArchivo && archivoNombre) {
    inputArchivo.addEventListener('change', function() {
        archivoNombre.textContent = inputArchivo.files.length > 0
            ? inputArchivo.files[0].name
            : 'Ningún archivo seleccionado';
    });
}

// VALIDACIONES

const mostrarError = (mensaje) => {
    Swal.fire({
        icon: "error",
        title: "¡Error!",
        text: mensaje,
    });
};

const fncValidarDocumento = () => {
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
    if (!archivo) {
        mostrarError("Debes seleccionar un archivo.");
        return true;
    }
    if (archivo.size > maxSize) {
        mostrarError("El archivo no debe superar los 5MB.");
        return true;
    }
    return false;
};

// ENVÍO DEL FORMULARIO

const enviarFormularioDocumentos = () => {
    const formulario = document.getElementById("frm_documentos");
    const btnGuardar = document.getElementById("btn-guardar");
    const btnCancelar = document.getElementById("btn-cancelar");
    const spinner = document.getElementById("spinner-global");
    const barraProgreso = document.getElementById('barra-progreso');

    const guardarFormulario = () => {
        if (fncValidarDocumento()) {
            return;
        }

        const formData = new FormData(formulario);

        btnGuardar.disabled = true;
        btnCancelar.disabled = true;
        spinner.style.display = "flex";

        axios.post("/AltaDocumentos", formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
            onUploadProgress: function(progressEvent) {
                barraProgreso.classList.remove('hidden');
                const porcentaje = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                barraProgreso.firstElementChild.style.width = porcentaje + '%';
            }
        })
            .then((response) => {
                btnGuardar.removeEventListener("click", guardarFormulario);
                spinner.style.display = "none";

                if (response.status === 200) {
                    Swal.fire({
                        title: "¡Guardado!",
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
                spinner.style.display = "none";
                let mensajeError = "Ocurrió un error al procesar la solicitud.";
                if (error.response && error.response.data && error.response.data.message) {
                    mensajeError = error.response.data.message;
                }
                Swal.fire("¡Error!", mensajeError, "error").then(() => {
                    btnGuardar.disabled = false;
                    btnCancelar.disabled = false;
                });
            })
            .finally(() => {
                barraProgreso.classList.add('hidden');
                barraProgreso.firstElementChild.style.width = '0%';
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

document.addEventListener("DOMContentLoaded", async () => {
    // Llenar el select de tipos de documento
    const tipos = await obtenerTiposDocumento();
    cargarTiposEnSelect(tipos);

    // Inicializar eventos del formulario
    enviarFormularioDocumentos();
});