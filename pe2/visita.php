<?php
include 'header.php';
include 'footer.php'; // Incluir el archivo del footer
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Alta de usuarios a la Web</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="index.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="index.css" media="(width: 480px)">
		<link rel="stylesheet" type="text/css" href="visita.css">
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
            <section id="salas">
                <ul>
                    <li>Sala 1: Evolución de los videojuegos<br>
                        <p>En esta sala se podrá ver como han ido evolucionando los videojuegos
                            desde sus inicios hasta la actualidad</p>
                    </li>
                    <li>Sala 2: Juegos emblemáticos<br>
                        <p>En esta sala se podrá ver una colección de videojuegos que
                            han sido una gran insignia en la industria</p>
                    </li>
                    <li>Sala 3: Autores/Directores más influyentes en la industria<br>
                        <p>En esta sala se podrá ver una serie de autores/directores
                            de videojuegos que han aportado o influido mucho en la
                            industria</p>
                    </li>
                    <li>Sala 4: Arcades y Setups de prueba<br>
                        <p>En esta sala se podrá jugar y probar diferentes juegos y
                            hardwares como máquinas arcades clásicas, gafas vr, etc.
                        </p>
                    </li>
                    <li>Baños</li>
                    <li>Tienda y Área de descanso:<br>
                        <p>Podrá comprar recuerdos del museo y mucho más. También hay una zona de bancos
                            para descansar y tomar algo</p>
                    </li>
                </ul>
            </section>

            <section id="plano">
                <h2>Plano del museo</h2>
                <img id="mapa" src="imagenes/plano.png" alt="Plano del Museo">
            </section>
        </main>

        <?php generarFooter(); ?>

        <script src="script.js"></script>
    </body>
</html>