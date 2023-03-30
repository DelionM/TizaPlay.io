<?php
session_start();
if (isset($_SESSION['usuario'])) {
    include '../resources/db/PlayeraDB.php';
    $playeraDB = new PlayeraDB();
    $existencia = $playeraDB->getExistenciaporId($_POST['id_playera']);
    $cantidad = $existencia + $_POST['cantidad'];
    $playeraDB->agregaCantidadPlayerasPorId($_POST['id_playera'], $cantidad);
    header("Location:playera_inventario.php");
    exit();

} else {
    header("Location:login_error.php");
    exit();
}