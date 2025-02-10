<?php
session_start();

// Verificar si el usuario es administrador
if ($_SESSION['usuario_tipo'] !== 'admin') {
    header("Location: index.php");
    exit();
}

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

// Obtener el ID de la obra a eliminar
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Preparar la consulta SQL DELETE
        $stmt = $pdo->prepare("DELETE FROM obras WHERE id = :id");

        // Vincular el parámetro
        $stmt->bindParam(':id', $id);

        // Ejecutar la consulta
        $stmt->execute();

        // Redirigir a la página de lista de obras
        header("Location: lista_obras.php");
        exit();
    } catch(PDOException $e) {
        echo "Error al eliminar la obra: " . $e->getMessage();
    }
} else {
    echo "No se especificó el ID de la obra.";
}