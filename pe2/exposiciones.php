<?php
include 'header.php'; // Incluir el archivo del header
include 'footer.php'; // Incluir el archivo del footer
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Exposiciones</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="index.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="index.css" media="(width: 480px)">
        <link rel="stylesheet" type="text/css" href="exposiciones.css">
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

        <!--imagen representativa de la misma, el título, el autor o autores,
        la temática, el periodo y un resumen con información sobre la
        exposición y las obras exhibidas-->
        <main>
            <ul>
                <li>
                    <img class="imagen" src="imagenes/ds.jpg" alt="Imagen representativa">
                    <section class="info">
                        <h3>Exposición de Realidad Virtual</h3>
                        <p>15/04/24 - 31/06/24</p>
                        <p>Víctor Rodríguez Rodríguez, Jose Antonio Casado Robles, Álex Sevilla Pulido</p>
                        <p>Tecnología</p>
                        <p>Traerá varios equipos de gafas de realidad virtual
                            para que se prueben varias demos y juegos
                        </p>
                    </section>
                </li>

                <li>
                    <img class="imagen" src="imagenes/d2.jpg" alt="Imagen representativa">
                    <section class="info">
                        <h3>Inclusión en los videojuegos</h3>
                        <p>25/04/24 - 18/05/24</p>
                        <p>Noah Guisasola Acebedo, Manuel Escámez Muelas</p>
                        <p>Social</p>
                        <p>Durante la mayor parte de la historia de esta
                            industria no se han tenido en la mayoría de
                            ocasiones muchos perfiles sociales o inclusivos
                            
                        </p>
                    </section>
                </li>

                <li>
                    <img class="imagen" src="imagenes/hl.jpg" alt="Imagen representativa">
                    <section class="info">
                        <h3>Exposición de Capcom</h3>
                        <p>01/05/24 - 31/07/24</p>
                        <p>Capcom</p>
                        <p>Videojuegos</p>
                        <p>Estarán disponibles varios juegos de la compañía
                            de videojuegos Capcom para jugar y probar las demos
                            de los siguientes títulos
                        </p>
                    </section>
                </li>
            </ul>
        </main>

        <?php generarFooter(); ?>

        <script src="script.js"></script>
    </body>
</html>