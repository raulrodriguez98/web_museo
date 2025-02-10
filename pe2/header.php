<?php
function generarHeader() {
    echo '
        <!--Nombre del museo-->
        <h1>Museo del Videojuego</h1>

        <!--Logo del museo-->
        <img class="logo" src="imagenes/logo.png" alt="Logo del Museo" />

        <!--Menú de enlaces de interés del museo-->
        <nav id="normal">
            <ul>
                <li><a href="index.php">&Iacute;ndice</a></li>
                <li><a href="coleccion.php">Colecci&oacute;n</a></li>
                <li><a href="visita.php">Visita</a></li>
                <li><a href="exposiciones.php">Exposiciones</a></li>
                <li><a href="informacion.php">Informaci&oacute;n</a></li>
                <li><a href="experiencias.php">Expericiencias</a></li>
            </ul>
        </nav> 

        <!--Menú de enlaces de interés del museo para móvil-->
        <nav id="movil">
            <button class="dropbtn">Menú</button>
            <section class="dropdown-content">
                <a href="index.php">&Iacute;ndice</a>
                <a href="coleccion.php">Colecci&oacute;n</a>
                <a href="visita.php">Visita</a>
                <a href="exposiciones.php">Exposiciones</a>
                <a href="informacion.php">Informaci&oacute;n</a>
                <a href="experiencias.php">Expericiencias</a>
            </section>
        </nav>          
    ';
}
?>       