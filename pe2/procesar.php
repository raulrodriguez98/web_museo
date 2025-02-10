<?php
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
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$email = $_POST['mail'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encriptar contraseña
$fecha_nac = $_POST['fecha_nac'];
$tipo_doc = $_POST['tipo_doc'];
$num_doc = $_POST['num_doc'];
$cod_postal = $_POST['cod_postal'];


try {
    // Preparar la consulta SQL
    $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, apellidos, email, password, fecha_nac, tipo_doc, num_doc, cod_postal) 
                           VALUES (:nombre, :apellidos, :mail, :password, :fecha_nac, :tipo_doc, :num_doc, :cod_postal)");

    // Vincular los parámetros
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':apellidos', $apellidos);
    $stmt->bindParam(':mail', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':fecha_nac', $fecha_nac);
    $stmt->bindParam(':tipo_doc', $tipo_doc);
    $stmt->bindParam(':num_doc', $num_doc);
    $stmt->bindParam(':cod_postal', $cod_postal);

    // Ejecutar la consulta
    $stmt->execute();

    // Redirigir a la página de éxito
    header("Location: exito_registro.php");
    exit(); // Para detener la ejecución del script
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}