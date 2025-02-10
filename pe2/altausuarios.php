<?php
include 'header.php'; // Incluir el archivo del header
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
		<link rel="stylesheet" type="text/css" href="altausuarios.css">
    </head>

    <body>
        <header>
            <?php generarHeader(); ?>

            <!--Formulario de inicio de sesión y registro-->
            <form id="login-form" action="identificar.php" method="post" class="formulario">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" /><br>
                <label for="passw">Contrase&ntilde;a:</label>
                <input type="text" id="passw" name="passw" value="" /><br>
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
            <form action="procesar.php" method="post" class="registro">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre"/><br>
                <label for="apellidos">Apellidos:</label>
                <input type="text" id="apellidos" name="apellidos"/><br>
                <label for="mail">Email:</label>
                <input type="text" id="mail" name="mail"/><br>
                <label for="password">Contrase&ntilde;a:</label>
                <input type="text" id="password" name="password"/><br>
                <label for="fecha_nac" id="fcha_nac">Fecha de nacimiento:</label>
                <input type="text" id="fecha_nac" name="fecha_nac"/><br>
                <label for="tipo_doc" id="tipo_doc">Tipo de documento:</label>
                <select id="tipo_doc_selec" name="tipo_doc">
                    <option value="DNI" selected>DNI</option>
                    <option value="Pasaporte">Pasaporte</option>
                    <option value="NIE">NIE</option>
                </select><br>
                <label for="num_doc" id="num_docu">Número de documento:</label>
                <input type="text" id="num_doc" name="num_doc"/><br>
                <label for="cod_postal" id="codi_postal">Código postal:</label>
                <input type="text" id="cod_postal" name="cod_postal"/><br>
                <input type="checkbox" id="check_term_conds">
                <label for="check_term_conds" id="ch_t_c">He leído y acepto las
                    <a href="condiciones_legales.html">condiciones legales</a> y la
                    <a href="politica_privacidad.html">Política de Privacidad</a>
                </label><br>
                <!--<input type="submit" id="envio" value="Enviar" />-->
                <button type="submit" id="envio">Enviar</a></button>
                <input type = "reset" id ="reset" value = "Reiniciar formulario" /> 
            </form>
        </main>

        <?php generarFooter(); ?>

        <script src="script.js"></script>
        <script src="val_reg.js"></script>
        
</script>
    </body>
</html>