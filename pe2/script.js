// Para cambiar entre el inicio de sesión o el mensaje de sesión ya iniciada
window.addEventListener('DOMContentLoaded', (event) => {
    const loginForm = document.getElementById('login-form');
    const userInfo = document.getElementById('usuario-info');

    if (userInfo.textContent.trim() !== '') { // Verificar si hay contenido en userInfo
        loginForm.style.display = 'none';
        userInfo.style.display = 'block';
    }
});

// Para esconder la contraseña
document.addEventListener("DOMContentLoaded", function() {
    var passwordField = document.getElementById("passw");
    passwordField.setAttribute("type", "password");
});