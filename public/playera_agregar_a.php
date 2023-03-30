<?php
session_start();
if (isset($_SESSION['usuario'])) {

    $PageTitle = "Agregar playera";

    include '../resources/templates/head.html';
    include '../resources/templates/header.html';
    include '../resources/templates/navegacion_administrador.html';

    ?>  

    <main>

        <div class="text-secondary text-center m-4 ">
            <h2>Agregar tipo de playera</h2>
        </div>

        <form class="p-5" action="playera_agregar_b.php" method="POST">

            <div class="mb-3">
                <label class="form-label" for="tela">Tela</label>
                <select class="form-select" id="tela" name="tela">
                    <option value="" selected="selected">selecciona</option>
                    <?php
                    include '../resources/db/TelaDB.php';
                    $telaDB = new TelaDB();
                    $telas = $telaDB->getTelas();
                    foreach ($telas as $tela):?>
                        <option value="<?= $tela['id_tela'] ?>"><?= $tela['tela'] ?></option>\n";
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label" for="color">Color</label>
                <select class="form-select" id="color" name="color">
                    <option value="" selected="selected">selecciona</option>
                    <?php
                    include '../resources/db/ColorDB.php';

                    $coloresDB = new ColorDB();
                    $colores = $coloresDB->getColores();
                    foreach ($colores as $color):?>
                        <option value="<?= $color['id_color'] ?>"><?= $color['color'] ?></option>\n";
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label" for="talla">Talla</label>
                <select class="form-select" id="talla" name="talla">
                    <option value="" selected="selected">selecciona</option>
                    <?php
                    include '../resources/db/TallaDB.php';
                    $tallaDB = new TallaDB();
                    $tallas = $tallaDB->getTallas();
                    foreach ($tallas as $talla):?>
                        <option value="<?= $talla['id_talla'] ?>"><?= $talla['talla'] ?></option>\n";
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="text-end mt-5">
                <input class="btn btn-primary" type="submit" value="Agregar">
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