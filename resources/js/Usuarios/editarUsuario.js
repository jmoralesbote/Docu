// ^ ———————————————————————————————————————————————————————
// ^ ✧･ﾟ: *✧･ﾟ:*     Sección de Funciones     *:･ﾟ✧*:･ﾟ✧
// ^ ———————————————————————————————————————————————————————

// RESTRICCIÓN DE ENTRADAS //

const mostrarError = (mensaje) => {
    Swal.fire({
        icon: "error",
        title: "¡Error!",
        text: mensaje,
    });
};

const soloLetras = (input) => {
    input.addEventListener("input", () => {
        input.value = input.value
            .replace(/^\s+/g, "")
            .replace(/[^a-zA-ZÁÉÍÓÚáéíóúÑñ\s]/g, "")
            .replace(/\s{2,}/g, " ");
    });
};

const soloUsername = (input) => {
    input.addEventListener("input", () => {
        input.value = input.value
            .replace(/^\s+/g, "")
            .replace(/[^a-zA-Z0-9_]/g, "");
    });
};

// VALIDACIONES DE ENVIO //

const fncValidarNombreCompleto = () => {
    const campos = [
        { name: "user_nombre", label: "El nombre", obligatorio: true, max: 100 },
        { name: "user_paterno", label: "El apellido paterno", obligatorio: true, max: 50 },
        { name: "user_materno", label: "El apellido materno", obligatorio: false, max: 50 }
    ];

    const regexSoloLetras = /^[A-Za-zÁÉÍÓÚÑáéíóúñ\s]+$/;

    for (const campo of campos) {
        const input = document.querySelector(`[name='${campo.name}']`);
        const valor = input.value.trim();

        if (campo.obligatorio && valor === "") {
            mostrarError(`${campo.label} no puede estar vacío.`);
            return true;
        }

        if (valor !== "" && !regexSoloLetras.test(valor)) {
            mostrarError(`${campo.label} solo puede contener letras.`);
            return true;
        }

        if (valor.length > campo.max) {
            mostrarError(`${campo.label} no puede tener más de ${campo.max} caracteres.`);
            return true;
        }
    }

    return false;
};

const fncValidarUsername = () => {
    const username = document.querySelector("[name='username']");
    const valor = username.value.trim();

    if (valor === "") {
        mostrarError("El nombre de usuario no puede estar vacío.");
        return true;
    }
    if (valor.length > 15) {
        mostrarError(
            "El nombre de usuario no puede tener más de 15 caracteres."
        );
        return true;
    }
    return false;
};

const fncValidarEmail = () => {
    const email = document.querySelector("[name='email']");
    const valor = email.value.trim();

    const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (valor === "") {
        mostrarError("El correo electrónico no puede estar vacío.");
        return true;
    }

    if (!regexEmail.test(valor)) {
        mostrarError("El correo electrónico no es válido.");
        return true;
    }

    if (valor.length > 100) {
        mostrarError("El correo electrónico no puede tener mas de 100 caracteres.");
        return true;
    }

    return false;
};

const fncValidarContraseña = () => {
    const password = document.querySelector("[name='password']");
    const valor = password.value.trim();

    // Solo validar si el usuario escribió algo
    if (valor === "") {
        // No hay contraseña nueva, no validar nada
        return false;
    }

    if (valor.length < 6) {
        mostrarError("La contraseña debe tener al menos 6 caracteres.");
        return true;
    }

    if (valor.length > 50) {
        mostrarError("La contraseña no puede tener más de 50 caracteres.");
        return true;
    }

    if (!/[A-Z]/.test(valor)) {
        mostrarError("La contraseña debe contener al menos una letra mayúscula.");
        return true;
    }

    if (!/[a-z]/.test(valor)) {
        mostrarError("La contraseña debe contener al menos una letra minúscula.");
        return true;
    }

    if (!/\d/.test(valor)) {
        mostrarError("La contraseña debe contener al menos un número.");
        return true;
    }

    return false;
};

const enviarFormularioUsuarios = () => {
    const formulario = document.getElementById("frm_usuarios");
    const btnGuardar = document.getElementById("btn-guardar");
    const btnCancelar = document.getElementById("btn-cancelar");
    const spinner = document.getElementById("spinner-global");

    const guardarFormulario = () => {

        if (
            fncValidarNombreCompleto() ||
            fncValidarUsername() ||
            fncValidarEmail() ||
            fncValidarContraseña()
        ) {
            return;
        }

        const formData = new FormData(formulario);

        btnGuardar.disabled = true;
        btnCancelar.disabled = true;
        spinner.style.display = "flex";

        axios.post("/EditarUsuarios", formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        })
            .then((response) => {

                btnGuardar.removeEventListener("click", guardarFormulario);

                spinner.style.display = "none";

                if (response.status === 200) {
                    Swal.fire({
                        title: "¡Actualizado!",
                        text: response.data.message,
                        icon: "success",
                        timer: 2000,
                        showConfirmButton: false,
                    });

                    setTimeout(() => {
                        window.location.href = "/indexListarUsuarios";
                    }, 2500);
                } else {
                    throw new Error("Error en la respuesta del servidor.");
                }
            })
            .catch((error) => {
                spinner.style.display = "none";

                let mensajeError = "Ocurrió un error al procesar la solicitud.";
                if (error.response && error.response.status === 400 && error.response.data.message) {
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

// ^ ———————————————————————————————————————————————————————
// ^ ✧･ﾟ: *✧･ﾟ:*     Sección de Eventos     *:･ﾟ✧*:･ﾟ✧
// ^ ———————————————————————————————————————————————————————

document.addEventListener("DOMContentLoaded", enviarFormularioUsuarios);
// Aplicarlo a los inputs de nombre, paterno y materno
soloLetras(document.querySelector('[name="user_nombre"]'));
soloLetras(document.querySelector('[name="user_paterno"]'));
soloLetras(document.querySelector('[name="user_materno"]'));
soloUsername(document.querySelector('[name="username"]'));