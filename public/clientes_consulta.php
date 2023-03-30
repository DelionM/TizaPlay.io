<?php
session_start();
//if (isset($_SESSION['usuario'])) {
if (true) {

    $PageTitle = "Clientes";

    include '../resources/templates/head.html';
    include '../resources/templates/header.html';
    include '../resources/templates/navegacion_administrador.html';

    ?>

    <main>

        <div class="text-primary text-center m-4 ">
            <h2>Clientes</h2>
        </div>

        <table class="table table-striped">
            <thead>
            <tr>
                <th class="text-center">Usuario</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Ap paterno</th>
                <th class="text-center">Ap materno</th>
                <th class="text-center">Calle</th>
                <th class="text-center">Número</th>
                <th class="text-center">e-mail</th>
            </tr>
            </thead>
            <tbody>
            <?php
            include '../resources/db/UsuarioDB.php';
            $usuarioBD = new UsuarioDB();
            $clientes = $usuarioBD->getUsuariosClientes();
            foreach ($clientes as $cliente):?>
                <tr>
                    <td  class="text-center"><?= $cliente['usuario'] ?></td>
                    <td class="text-center"><?= $cliente['nombre'] ?></td>
                    <td class="text-center"><?= $cliente['apellido_paterno'] ?></td>
                    <td class="text-center"><?= $cliente['apellido_materno'] ?></td>
                    <td class="text-center"><?= $cliente['calle'] ?></td>
                    <td class="text-center"><?= $cliente['numero'] ?></td>
                    <td class="text-center"><?= $cliente['correo_electronico'] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    </main>

    <?php

    include '../resources/templates/footer.html';
    include '../resources/templates/scripts.html';
    include '../resources/templates/fin.html';

} else {
    header("Location:login_error.php");
    exit();
}