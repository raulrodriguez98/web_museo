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

// Obtener el ID de la obra a editar
$id = $_GET['id'];

// Obtener los datos de la obra de la base de datos
$stmt = $pdo->prepare("SELECT * FROM obras WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$obra = $stmt->fetch();

// Obtener la lista de imágenes disponibles en el directorio /imagenes
$imagenes = scandir('imagenes');
$imagenes = array_diff($imagenes, array('.', '..')); 

// Filtrar solo archivos de imagen
$imagenes = array_filter($imagenes, function($archivo) {
    $extension = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
    return in_array($extension, ['jpg', 'jpeg', 'png']);
});

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Editar Obra</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="crear.css"> 
    </head>
    <body>
        <header>
            <h1>Editar Obra</h1>
            <button id="button2"><a href="CRUD_admin.php">Volver al Panel</a></button>
            <button id="button2"><a href="lista_obras.php">Volver al Listado de Obras</a></button>
        </header>

        <main>
            <form action="actualizar_obra.php" method="post">
                <!--Se agrega un campo oculto (<input type="hidden">) para enviar el ID de la obra al archivo actualizar_obra.php-->
                <!--Se prellenan los campos con los datos de la obra obtenida de la base de datos con value="<php echo $obra['atributo']; ?>" -->
                <input type="hidden" name="id" value="<?php echo $obra['id']; ?>">

                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" value="<?php echo $obra['titulo']; ?>" required><br>

                <label for="autor">Autor:</label>
                <input type="text" id="autor" name="autor" value="<?php echo $obra['autor']; ?>"><br>

                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="fecha" value="<?php echo $obra['fecha']; ?>" required><br>

                <label for="tema">Tema:</label>
                <input type="text" id="tema" name="tema" value="<?php echo $obra['tema']; ?>" required><br>

                <label for="epoca">Época:</label>
                <select id="epoca" name="epoca" required>
                    <option value="">Selecciona una época</option>
                    <option value="70_90" <?php if ($obra['epoca'] == '70_90') echo 'selected'; ?>>De los 70 a los 90</option>
                    <option value="90_00" <?php if ($obra['epoca'] == '90_00') echo 'selected'; ?>>De los 90 al 2000</option>
                    <option value="00_10" <?php if ($obra['epoca'] == '00_10') echo 'selected'; ?>>De los 2000 al 2010</option>
                    <option value="10_act" <?php if ($obra['epoca'] == '10_act') echo 'selected'; ?>>De los 2010 a la actualidad</option>
                </select><br>

                <label for="imagen">Imagen:</label>
                <select id="imagen" name="imagen">
                <!--El bucle foreach genera las opciones del select a partir de la lista de imágenes-->
                    <?php foreach ($imagenes as $imagen): ?>
                        <option value="<?php echo $imagen; ?>" <?php if ($imagen == $obra['imagen']) echo 'selected'; ?>>
                            <?php echo $imagen; ?>
                        </option>
                    <?php endforeach; ?>
                </select><br>

                <button id="button2" type="submit">Actualizar</button>
            </form>
        </main>

        <footer>
        </footer>
    </body>
</html>