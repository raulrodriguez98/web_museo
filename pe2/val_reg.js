
document.addEventListener("DOMContentLoaded", function() {
    var passwordField = document.getElementById("password");
    passwordField.setAttribute("type", "password");
});

document.getElementById("envio").addEventListener("click", function(event) {
    event.preventDefault(); // Prevenir el envío por defecto

    // Obtener valores de los campos
    let nombre = document.getElementById("nombre").value;
    let apellidos = document.getElementById("apellidos").value;
    let email = document.getElementById("mail").value;
    let password = document.getElementById("password").value;
    let fechaNac = document.getElementById("fecha_nac").value;
    let numDoc = document.getElementById("num_doc").value;
    let codPostal = document.getElementById("cod_postal").value;
    let checkTerminos = document.getElementById("check_term_conds").checked;

    // Validación de número de documento (DNI, pasaporte, NIE)
    let tipoDoc = document.getElementById("tipo_doc_selec").value; // Obtener el tipo de documento seleccionado
    let regexNumDoc;


    // Expresiones regulares para validación
    const regexEmail = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/; // Validación para el email
    const regexNombreApellidos = /^[a-zA-Z\s]+$/; // Validación para el nombre y apellidos
    const regexFechaNac = /^\d{4}-\d{2}-\d{2}$/; // Validación para la fecha
    const regexCodPostal = /^\d{5}$/; // Validación para el código postal

    let errores = [];

    // Según el tipo de documento, elegir la validación correspondiente
    switch (tipoDoc) {
        case "DNI":
            regexNumDoc = /^\d{8}[A-Z]$/; // DNI: 8 dígitos y una letra mayúscula
            break;
        case "Pasaporte":
            regexNumDoc = /^[A-Z]{3}\d{6}[A-Z]?$/; // Pasaporte: 3 letras mayúsculas, 6 dígitos y una letra mayúscula opcional
            break;
        case "NIE":
            regexNumDoc = /^[XYZ]\d{7}[A-Z]$/; // NIE: X, Y o Z, 7 dígitos y una letra mayúscula
            break;
        default:
            errores.push("Tipo de documento no válido."); // No hay un tipo de documento válido
            break;
    }

    // Validaciones
    if (!regexNombreApellidos.test(nombre)) {
        errores.push("El nombre solo debe contener letras y espacios.");
    }
    if (!regexNombreApellidos.test(apellidos)) {
        errores.push("Los apellidos solo deben contener letras y espacios.");
    }
    if (!regexEmail.test(email)) {
        errores.push("Por favor, ingrese un correo electrónico válido.");
    }
    if (!regexFechaNac.test(fechaNac)) {
        errores.push("La fecha de nacimiento debe tener el formato AAAA-MM-DD.");
    } else {
        const [year, month, day] = fechaNac.split('-').map(Number);

        // Validación de los valores del mes y día
        if (month < 1 || month > 12) {
            errores.push("El mes debe estar entre 01 y 12.");
        } else {
            const diasEnMes = [31, (year % 4 === 0 && year % 100 !== 0) || (year % 400 === 0) ? 29 : 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
            if (day < 1 || day > diasEnMes[month - 1]) {
                errores.push("El día no es válido para el mes y año proporcionados.");
            }
        }

        const fecha = new Date(year, month - 1, day);
        // 0 en el mes para representar en JavaScript el mes de enero
        const fechaMin = new Date(1894, 0, 1); // Fecha mínima permitida
        const fechaMax = new Date(); // Fecha máxima permitida (hoy)

        if (fecha < fechaMin || fecha > fechaMax) {
            errores.push("La fecha de nacimiento debe estar entre 1894-01-01 y hoy.");
        } else if (fecha.getFullYear() !== year || fecha.getMonth() + 1 !== month || fecha.getDate() !== day) {
            errores.push("La fecha de nacimiento no es válida.");
        }
    }

    if (password.length < 8) {
        errores.push("La contraseña debe tener al menos 8 caracteres.");
    }
    if (regexNumDoc && !regexNumDoc.test(numDoc)) {
        errores.push("El número de documento no es válido para el tipo seleccionado."); // Enviar error si no se corresponde a la validación del doumento
    }
    if (!regexFechaNac.test(fechaNac)) {
        errores.push("La fecha de nacimiento debe tener el formato AAAA-MM-DD.");
    }
    if (!regexCodPostal.test(codPostal)) {
        errores.push("El código postal debe tener 5 dígitos.");
    }
    if (!checkTerminos) {
        errores.push("Debe aceptar los términos y condiciones.");
    }

    // Mostrar errores o enviar formulario
    if (errores.length > 0) { // Si hay errores
        alert(errores.join("\n")); // Mostrar todos los errores en una alerta
    } else { // Si no hay errores proceder con la acción del form
        document.querySelector(".registro").submit(); // Enviar formulario si no hay errores
    }
});