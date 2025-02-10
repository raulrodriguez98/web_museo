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


// Obtener valores únicos para los filtros
$stmt = $pdo->query("SELECT DISTINCT epoca FROM obras");
$epocas = $stmt->fetchAll(PDO::FETCH_COLUMN);

$stmt = $pdo->query("SELECT DISTINCT autor FROM obras");
$autores = $stmt->fetchAll(PDO::FETCH_COLUMN);

$stmt = $pdo->query("SELECT DISTINCT tema FROM obras");
$temas = $stmt->fetchAll(PDO::FETCH_COLUMN);


// Paginación
$obrasPorPagina = 9;
$paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
$offset = ($paginaActual - 1) * $obrasPorPagina;


// Consulta SQL para obtener obras (con paginación y filtros)
$sql = "SELECT * FROM obras";
$where = [];
$params = [];

// Consulta por Época
if (isset($_GET['epoca']) && $_GET['epoca'] !== '') {
    $where[] = "epoca = :epoca";
    $params[':epoca'] = $_GET['epoca'];
}

// Consulta por Autor
if (isset($_GET['autor']) && $_GET['autor'] !== '') {
    $where[] = "autor = :autor";
    $params[':autor'] = $_GET['autor'];
}

// Consulta por Tema
if (isset($_GET['tema']) && $_GET['tema'] !== '') {
    $where[] = "tema = :tema";
    $params[':tema'] = $_GET['tema'];
}

// Sino hay filtro de búsqueda, coger todos
if (!empty($where)) {
    $sql .= " WHERE " . implode(" AND ", $where);
}

$sql .= " LIMIT $obrasPorPagina OFFSET $offset";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$obras = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Contar el total de obras (para la paginación)
$stmt = $pdo->prepare("SELECT COUNT(*) FROM obras");
if (!empty($where)) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM obras WHERE " . implode(" AND ", $where));
}
$stmt->execute($params);
$totalObras = $stmt->fetchColumn();
$totalPaginas = ceil($totalObras / $obrasPorPagina);
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Colección</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="index.css">
        <link rel="stylesheet" href="coleccion.css">
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
            <!-- Filtro de búsqueda -->
            <aside id="menu">
                <h2>Filtros</h2>

                <ul>
                    <li id="sin-filtros"><a href="coleccion.php" data-filtro="epoca" data-valor="">Quitar Filtros</a></li>
                    <!-- Filtro por época -->
                    <li id="filtro-epoca" data-cantidad="<?php echo count($epocas); ?>">Épocas
                        <ul>
                            <?php foreach ($epocas as $epoca): ?>
                                <li><a href="coleccion.php?epoca=<?php echo $epoca; ?>" data-filtro="epoca" data-valor="<?php echo $epoca; ?>"><?php echo $epoca; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>

                    <!-- Filtro por autor -->
                    <li id="filtro-autor" data-cantidad="<?php echo count($autores); ?>">Autores
                        <ul>
                            <?php foreach ($autores as $autor): ?>
                                <li><a href="coleccion.php?autor=<?php echo $autor; ?>" data-filtro="autor" data-valor="<?php echo $autor; ?>"><?php echo $autor; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>

                    <!-- Filtro por tema -->
                    <li id="filtro-tema" data-cantidad="<?php echo count($temas); ?>">Tema
                        <ul>
                            <?php foreach ($temas as $tema): ?>
                                <li><a href="coleccion.php?tema=<?php echo $tema; ?>" data-filtro="tema" data-valor="<?php echo $tema; ?>"><?php echo $tema; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                </ul>
            </aside>

            <!-- Lista/Tablas de obras -->
            <section id="tabla">
                <table>
                    <tbody>
                        <?php
                        $contador = 0; // Contador para controlar las filas
                        foreach ($obras as $obra):
                            if ($contador % 3 == 0) {
                                echo "<tr>"; // Iniciar nueva fila cada 3 obras
                            }
                        ?>

                        <td>
                            <article class="obra">
                                <!-- 1º Prepara la imagen para ponerla en la tabla junto con la información -->
                                <!-- 2º Recoge información para el tooltip para enseñar la información al poner el ratón encima de la imagen -->
                                <img class="juego" src="imagenes/<?php echo $obra['imagen']; ?>" 
                                    alt="<?php echo htmlspecialchars($obra['titulo']); ?>" 
                                    data-titulo="<?php echo htmlspecialchars($obra['titulo']); ?>"
                                    data-categoria="<?php echo htmlspecialchars($obra['epoca']); ?>"
                                    data-autor="<?php echo htmlspecialchars($obra['autor']); ?>"
                                    data-tema="<?php echo htmlspecialchars($obra['tema']); ?>">
                                <h3><?php echo htmlspecialchars($obra['titulo']); ?></h3>
                                <p>Autor: <?php echo htmlspecialchars($obra['autor']); ?></p>
                                <p>Fecha: <?php echo $obra['fecha']; ?></p>
                            </article>
                        </td>

                        <?php
                            $contador++;
                            if ($contador % 3 == 0) {
                                echo "</tr>"; // Cerrar fila después de 3 obras
                            }
                        endforeach;
                        
                        // Completar la última fila con celdas vacías si es necesario
                        while ($contador % 3 != 0) {
                            echo "<td></td>";
                            $contador++;
                        }
                        echo "</tr>"; // Cerrar la última fila
                        ?>
                    </tbody>
                </table>

                <!-- Para cambiar de nº página -->
                <nav id="paginacion">
                    <?php if ($paginaActual > 1): ?>
                        <a href="coleccion.php?pagina=<?php echo $paginaActual - 1; ?><?php echo isset($_GET['epoca']) ? '&epoca=' . $_GET['epoca'] : ''; ?><?php echo isset($_GET['autor']) ? '&autor=' . $_GET['autor'] : ''; ?><?php echo isset($_GET['tema']) ? '&tema=' . $_GET['tema'] : ''; ?>">Anterior</a>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                        <a href="coleccion.php?pagina=<?php echo $i; ?><?php echo isset($_GET['epoca']) ? '&epoca=' . $_GET['epoca'] : ''; ?><?php echo isset($_GET['autor']) ? '&autor=' . $_GET['autor'] : ''; ?><?php echo isset($_GET['tema']) ? '&tema=' . $_GET['tema'] : ''; ?>" <?php if ($i == $paginaActual) echo 'class="active"'; ?>><?php echo $i; ?></a>
                    <?php endfor; ?>

                    <?php if ($paginaActual < $totalPaginas): ?>
                        <a href="coleccion.php?pagina=<?php echo $paginaActual + 1; ?><?php echo isset($_GET['epoca']) ? '&epoca=' . $_GET['epoca'] : ''; ?><?php echo isset($_GET['autor']) ? '&autor=' . $_GET['autor'] : ''; ?><?php echo isset($_GET['tema']) ? '&tema=' . $_GET['tema'] : ''; ?>">Siguiente</a>
                    <?php endif; ?>
                </nav>
            </section>

            
        </main>

        <?php generarFooter(); ?>

        

        <article id="tooltip" style="display: none;">
            <p id="tooltip-titulo"></p>
            <p id="tooltip-categoria"></p>
            <p id="tooltip-autor"></p>
            <p id="tooltip-tema"></p>
        </article>

        <script src="script.js"></script>
        <script src="menu.js"></script>
    </body>
</html>