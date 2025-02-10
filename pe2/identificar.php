<?php
session_start(); // Iniciar la sesión

// Configuración de la base de datos
$username = 'pwraulrodriguez';
$password = '23raulrodriguez24';
$host = 'localhost';
$dbname = 'dbraulrodriguez_pw2324';


try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}


// Obtener datos del formulario
$email = $_POST['email'];
$password = $_POST['passw'];


try {
    // Preparar la consulta SQL
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $usuario = $stmt->fetch();

    if ($usuario && password_verify($password, $usuario['password'])) {
        // Credenciales válidas, iniciar sesión
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nombre'] = $usuario['nombre'];
        $_SESSION['usuario_tipo'] = $usuario['tipo']; // Tipo de usuario

        if ($_SESSION['usuario_tipo'] === 'admin')
            header("Location: CRUD_admin.php"); // Redirigir administrador al panel de administrador
        else 
            header("Location: index.php"); // Redirigir a index.php
        exit();
    } else {
        // Credenciales inválidas, mostrar mensaje de error
        echo "Error: Correo electrónico o contraseña incorrectos.";
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}