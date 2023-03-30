<?php
session_start();
if (isset($_SESSION['usuario'])) {

    include '../resources/db/PlayeraDB.php';
    $playeraDB = new PlayeraDB();

    if ($playeraDB->existeTipoPlayera($_POST)) {

        $PageTitle = "playera existente";

        include '../resources/templates/head.html';
        include '../resources/templates/header.html';
        include '../resources/templates/navegacion_administrador.html';
        ?>

        <h2 class="text-secondary">Ya existe ese tipo de playera</h2>

        <?php
        include '../resources/templates/footer.html';
        include '../resources/templates/scripts.html';
        include '../resources/templates/fin.html';

    } else {
        ?>
        <?php
        $playeraDB->insertaPlayera($_POST);
        header("Location:playera_inventario.php");
        exit();
    }

} else {
    header("Location:login_error.php");
    exit();
}