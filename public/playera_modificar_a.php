<?php
session_start();
if (isset($_SESSION['usuario'])) {

    $PageTitle = "Modificar existencia";

    include '../resources/templates/head.html';
    include '../resources/templates/header.html';
    include '../resources/templates/navegacion_administrador.html';

    ?>

    <main>

        <div class="text-secondary text-center m-4 ">
            <h2>Agregar tipo de playera</h2>
        </div>

        <form class="p-5" action="playera_modificar_b.php" method="POST">

            <div class="mb-3">
                <label class="form-label" for="id_playera">Playera</label>
                <select class="form-select" id="id_playera" name="id_playera">
                    <option value="" selected="selected">selecciona</option>
                    <?php
                    include '../resources/db/PlayeraDB.php';
                    $playeraDB = new PlayeraDB();
                    $playeras = $playeraDB->getPlayeras();
                    foreach ($playeras as $playera):?>
                        <option value="<?= $playera['id_playera'] ?>"><?= $playera['tela'] ?> <?= $playera['color'] ?> <?= $playera['talla'] ?></option>\n";
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label" for="cantidad">Cantidad</label>
                <input class="form-control" type="text" id="cantidad" name="cantidad" placeholder="Cantidad de playeras a agregar">
            </div>

            <div class="text-end mt-5">
                <input class="btn btn-primary" type="submit" value="Modificar">
            </div>

        </form>

    </main>

    <?php

    include '../resources/templates/footer.html';
    include '../resources/templates/scripts.html';
    include '../resources/templates/fin.html';

} else {
    header("Location:login_error.php");
    exit();
}