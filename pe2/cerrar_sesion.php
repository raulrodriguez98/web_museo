<?php
session_start(); // Iniciar la sesión para poder destruirla

session_destroy(); // Destruir todas las variables de sesión

// Redireccionar al usuario a la página principal (index.php)
header("Location: index.php");
exit(); // Detener la ejecución del script después de la redirección
?>