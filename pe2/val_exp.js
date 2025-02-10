// Obtén una referencia al botón "Enviar comentario"
const enviarComentarioButton = document.getElementById("envio");

enviarComentarioButton.addEventListener("click", function (event) {
    event.preventDefault(); // Prevenir el envío por defecto

    // Obtener el valor del comentario
    const comentarioInput = document.getElementById("text");
    const comentario = comentarioInput.value.trim(); // Eliminar espacios en blanco al inicio y final

    // Validaciones
    const longitudMinima = 10;
    const longitudMaxima = 500;
    const palabrasProhibidas = ["porno", "casino", "tonto"]; // Ejemplo de palabras prohibidas

    let errores = [];

    if (comentario.length < longitudMinima) {
        errores.push(`El comentario debe tener al menos ${longitudMinima} caracteres.`);
    } else if (comentario.length > longitudMaxima) {
        errores.push(`El comentario no puede superar los ${longitudMaxima} caracteres.`);
    }

    for (const palabra of palabrasProhibidas) {
        if (comentario.toLowerCase().includes(palabra.toLowerCase())) {
            errores.push("El comentario contiene palabras no permitidas.");
            break;
        }
    }

    // Mostrar errores o enviar formulario
    if (errores.length > 0) {
        alert(errores.join("\n"));
    } else {
        document.querySelector(".texto").submit(); // Envío del mensaje
    }
});