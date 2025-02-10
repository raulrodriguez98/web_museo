<?php                   // Procesa los datos del formulario de crear_obra.php y los inserta en la base de datos
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

// Obtener datos del formulario
$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$fecha = $_POST['fecha'];
$imagen = $_POST['imagen'];
$epoca = $_POST['epoca'];
$tema = $_POST['tema'];

// Validación de datos (¡importante!)
// Aquí debes agregar validaciones para asegurarte de que los datos sean correctos y seguros.
// Por ejemplo, verificar que los campos no estén vacíos, que la fecha sea válida, etc.

try {
    // Preparar la consulta SQL
    $stmt = $pdo->prepare("INSERT INTO obras (titulo, autor, fecha, imagen, epoca, tema)
                           VALUES (:titulo, :autor, :fecha, :imagen, :epoca, :tema)");

    // Vincular los parámetros
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':autor', $autor);
    $stmt->bindParam(':fecha', $fecha);
    $stmt->bindParam(':imagen', $imagen);
    $stmt->bindParam(':epoca', $epoca);
    $stmt->bindParam(':tema', $tema);
    

    // Ejecutar la consulta
    $stmt->execute();

    // Redirigir al panel de administración
    header("Location: CRUD_admin.php");
    exit();
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}