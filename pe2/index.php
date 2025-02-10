<?php
include 'header.php'; // Incluir el archivo del header
include 'footer.php'; // Incluir el archivo del footer
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Museo del Videojuego</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="index.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="index.css" media="(width: 480px)">
    </head>

    <body>
        <!--Cabecera-->
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
            <section id="introduccion">
                <!--Título del main-->
                <h2>Museo del Videojuego</h2>

                <!--Descripción del museo en el main-->
                <p>Desde los 70 hasta la actualidad, los videojuegos han sido muy populares en la sociedad juvenil, y poco a poco incluso a todas las edades, 
                    además de ir ganando protagonismo hasta llegar a convertirse en la industria más importante del sector del ocio.<br>Este museo recoge varios hitos y obras publicadas en el sector durante toda esta época.<br><br>
                   En este portal virtual podrá ver horarios, todo el contenido disponible del museo y la información necesaria para su visita en el menú en la parte superior.<br> 
                </p>
            </section>
        </main>

        <?php generarFooter(); ?>

        <script src="script.js"></script>
    </body>
</html>