<?php
include 'header.php'; // Incluir el archivo del header
include 'footer.php'; // Incluir el archivo del footer
session_start();

// Configuración de la base de datos
$username = 'pwraulrodriguez';
$password = '23raulrodriguez24';
$host = 'localhost';
$dbname = 'dbraulrodriguez_pw2324';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Procesar el formulario si se envió Y el usuario está logueado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['usuario_id'])) {
    // Obtener el comentario
    $comentario = $_POST['comentario'];

    // Validación del comentario
    if (empty($comentario)) {
        $error = "El comentario no puede estar vacío.";
    } else {
        try {
            // Preparar la consulta SQL (con usuario_id)
            $stmt = $pdo->prepare("INSERT INTO comentarios (usuario_id, comentario) VALUES (:usuario_id, :comentario)");
            $stmt->bindParam(':usuario_id', $_SESSION['usuario_id']);
            $stmt->bindParam(':comentario', $comentario);
            $stmt->execute();

            // Redireccionar para evitar reenvío del formulario al recargar
            header("Location: experiencias.php");
            exit();
        } catch (PDOException $e) {
            $error = "Error al guardar el comentario: " . $e->getMessage();
        }
    }
}

// Obtener todos los comentarios
$stmt = $pdo->prepare("SELECT c.*, u.nombre AS nombre_usuario 
                       FROM comentarios c 
                       INNER JOIN usuarios u ON c.usuario_id = u.id 
                       ORDER BY c.fecha_com DESC");
$stmt->execute();
$comentarios = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Expericiencias</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="experiencias.css">
        <link rel="stylesheet" href="index.css">
    </head>

    <body>
        <header>
            <?php generarHeader(); ?>

            <!--Formulario de inicio de sesión y registro-->
            <form id="login-form" action="identificar.php" method="post" class="formulario">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" /><br>
                <label for="passw">Contrase&ntilde;a:</label>
                <input type="password" id="passw" name="passw" value="" /><br>
                <input type="submit" id="button1" value="Iniciar sesi&oacute;n" />
                <!--Enlace de registro-->
                <button id="button2"><a href="altausuarios.php">Registro</a></button>

            </form>

            <!--Section con el nombre y tipo de usuario identificado-->
            <section id="usuario-info" style="display:none" class="formulario">
                <?php if (isset($_SESSION['usuario_id'])): ?>
                    <h3>Bienvenido, <?php echo $_SESSION['usuario_nombre']; ?></h3>
                    <p id="tipo-usuario"> 
                    <?php if ($_SESSION['usuario_tipo'] === 'admin'): ?>
                        (Administrador) 
                    <?php else: ?>
                        (Usuario)
                    <?php endif; ?>
                    </p>
                    <button id="button2"><a href="cerrar_sesion.php">Cerrar sesión</a></button>
                <?php endif; ?>
            </section>           
        </header>

        <main>
            <h2>Comentarios</h2>

            <?php if (isset($error)): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>

            <!-- Todos los comentarios en la BD -->
            <section id="comentarios">
                <?php foreach ($comentarios as $comentario): ?>
                    <article id="comentario">
                        <h4><?php echo htmlspecialchars($comentario['nombre_usuario']); ?></h4>
                        <p id="com"><?php echo htmlspecialchars($comentario['comentario']); ?></p>
                        <p class="fecha"><?php echo $comentario['fecha_com']; ?></p>
                    </article>
                <?php endforeach; ?>
            </section>

            <!-- Textarea para escribir un nuevo comentario -->
            <?php if (isset($_SESSION['usuario_id'])): ?>
                <form action="" method="post"  class="texto">
                    <textarea id="text" name="comentario"></textarea><br>
                    <button id="envio" type="submit">Enviar comentario</button>
                    <input type="reset" id="button2" value="Borrar mensaje" />
                </form>
            <?php else: ?>
                <p id="error">Debes <a href="index.php">iniciar sesión</a> para dejar un comentario.</p>
            <?php endif; ?>
        </main>

        <?php generarFooter(); ?>

        <script src="script.js"></script>
        <script src="val_exp.js"></script>
</body>
</html>