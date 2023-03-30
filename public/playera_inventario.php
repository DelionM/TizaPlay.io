<?php
session_start();
if (isset($_SESSION['usuario'])) {

    $PageTitle = "Inventario";

    include '../resources/templates/head.html';
    include '../resources/templates/header.html';
    include '../resources/templates/navegacion_administrador.html';

    ?>

    <main>

        <div class="text-primary text-center m-4 ">
            <h2>Playeras en existencia</h2>
        </div>

        <div class="text-end m-4">
            <a class="btn btn-primary" href="playera_agregar_a.php">Agregar playera</a>
            <a class="btn btn-success ms-4 mt-2" href="playera_modificar_a.php">Modificar existencia</a>
        </div>

        <?php
        include '../resources/lib/verTablaPlayeras.php';
        ?>

        <div class="text-end m-4">
            <a class="btn btn-primary" href="playera_agregar_a.php">Agregar playera</a>
            <a class="btn btn-success ms-4 mt-2" href="playera_modificar_a.php">Modificar existencia</a>
        </div>
    </main>

    <?php

    include '../resources/templates/footer.html';
    include '../resources/templates/scripts.html';
    include '../resources/templates/fin.html';

} else {
    header("Location:login_error.php");
    exit();
}