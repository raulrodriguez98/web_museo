<?php
include 'header.php'; // Incluir el archivo del header
include 'footer.php'; // Incluir el archivo del footer
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Aviso de éxito de registro en la web</title>
        <meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="index.css">   
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="index.css" media="(width: 480px)">
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
            <section id="exito">
                <p>El registro se ha realizado con éxito</p>
                <button id="button_index"><a href="index.php">Volver al índice</a></button>   
            </section>
        </main>

        <?php generarFooter(); ?>

        <script src="script.js"></script>
    </body>

</html>