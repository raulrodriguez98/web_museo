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

// Obtener la lista de imágenes disponibles en el directorio /imagenes
$imagenes = scandir('imagenes');
$imagenes = array_diff($imagenes, array('.', '..')); // Eliminar . y ..

// Filtrar solo archivos de imagen
$imagenes = array_filter($imagenes, function($archivo) {
    $extension = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
    return in_array($extension, ['jpg', 'jpeg', 'png']);
});

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Crear Nueva Obra</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="crear.css">
    </head>

    <body>
        <header>
            <h1>Crear Nueva Obra</h1>
            <button id="button2"><a href="CRUD_admin.php">Volver al Panel</a></button>
        </header>

        <main>
            <form action="guardar_obra.php" method="post">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" required><br>

                <label for="autor">Autor:</label>
                <input type="text" id="autor" name="autor" required><br>

                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="fecha"><br>

                <label for="tema">Tema:</label>
                <input type="text" id="tema" name="tema" required><br>

                <label for="epoca">Época:</label>
                <select id="epoca" name="epoca" required>
                    <option value="">Selecciona una época</option>
                    <option value="70_90">De los 70 a los 90</option>
                    <option value="90_00">De los 90 al 2000</option>
                    <option value="00_10">De los 2000 al 2010</option>
                    <option value="10_act">De los 2010 a la actualidad</option>
                </select><br>
                <label for="imagen">Imagen:</label>
                <select id="imagen" name="imagen">
                <!--El bucle foreach genera las opciones del select a partir de la lista de imágenes-->
                    <?php foreach ($imagenes as $imagen): ?>
                        <option value="<?php echo $imagen; ?>"><?php echo $imagen; ?></option>
                    <?php endforeach; ?>
                </select><br>

                <button id="button2" type="submit">Guardar</button>
            </form>
        </main>

        <footer>
        
        </footer>
    </body>
</html>