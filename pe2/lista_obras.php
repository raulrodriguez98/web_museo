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

// Obtener todas las obras de la base de datos
$stmt = $pdo->query("SELECT * FROM obras");
$obras = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Lista de Obras</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="crear.css">
        <link rel="stylesheet" href="coleccion.css"> 
    </head>

    <body>
        <header>
            <h1>Lista de Obras</h1>
            <button id="button2"><a href="CRUD_admin.php">Volver al Panel</a></button>
        </header>

        <main>
        
            <section id="obras">
                <?php foreach ($obras as $obra): ?>
                    <article class="obra">
                        <img class="juego" src="imagenes/<?php echo $obra['imagen']; ?>" alt="<?php echo htmlspecialchars($obra['titulo']); ?>">
                        <p><?php echo htmlspecialchars($obra['titulo']); ?></p>
                        <p>Autor: <?php echo htmlspecialchars($obra['autor']); ?></p>
                        <p>Fecha: <?php echo $obra['fecha']; ?></p>
                        <?php if ($_SESSION['usuario_tipo'] === 'admin'): ?>
                            <button id="button2"><a href="editar_obra.php?id=<?php echo $obra['id']; ?>">Editar</a></button>
                            <button id="button2"><a href="eliminar_obra.php?id=<?php echo $obra['id']; ?>" onclick="return confirm('¿Estás seguro?');">Eliminar</a></button>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </section>
    </main>
        </main>

        <footer>
        </footer>
    </body>
</html>