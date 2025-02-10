<?php
session_start();

// Verificar si el usuario es administrador
if ($_SESSION['usuario_tipo'] !== 'admin'){
    header("Location: index.php"); // Si no es administrador redirigir el usuario a index.php
    exit();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Panel de Administrador (CRUD) - Museo del Videojuego</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="panel.css">
    </head>

    <body>
        <header>
            <h1>Panel de Administrador</h1>
            <section id="usuario-info">
                <h3 id="titulo">Bienvenido, <?php echo $_SESSION['usuario_nombre']; ?></h3> 
                <button id="button2"><a href="cerrar_sesion.php">Cerrar sesión</a></button>
            </section>
        </header>

        <main>
            <h2>Opciones del Panel</h2>
            <ul>
                <li><button id="button2"><a href="crear_obra.php">Crear nueva obra</a></button></li>
                <li><button id="button2"><a href="lista_obras.php">Lista de obras</a></button></li>
            </ul>

            <h3>Editar/Eliminar Obras:</h3>
            
            <form action="editar_obra.php" method="get">
                <label for="id">ID de la obra:</label>
                <input type="number" id="id" name="id" required>
                <button id="button2" type="submit">Editar</button>
            </form>

            <form action="eliminar_obra.php" method="get">
                <label for="id">ID de la obra:</label>
                <input type="number" id="id" name="id" required>
                <button id="button2" type="submit" onclick="return confirm('¿Estás seguro?');">Eliminar</button>
            </form>
            
        </main>

        <footer>

        </footer>
    </body>
</html>