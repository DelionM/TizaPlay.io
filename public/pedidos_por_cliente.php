<?php
session_start();
if (isset($_SESSION['usuario'])) {

    $PageTitle = "Tus pedidos";

    include '../resources/templates/head.html';
    include '../resources/templates/header.html';
    include '../resources/templates/navegacion_clientes.html';

    ?>

    <main>

        <div class="text-secondary text-center m-4 ">
            <h2>Tus pedidos</h2>
        </div>

        <table class="table table-striped">
            <tr>
                <th class="text-center">Tela</th>
                <th class="text-center">Color</th>
                <th class="text-center">Talla</th>
                <th class="text-center">Cantidad</th>
                <th class="text-center">Mensaje</th>
                <th class="text-center">Costo</th>
                <th class="text-center">Imagen</th>
            </tr>
            <?php
            include '../resources/db/PedidoDB.php';
            $pedidoDB = new PedidoDB();
            $pedidos = $pedidoDB->getPedidosPorUsuario($_SESSION['id_usuario']);
            foreach ($pedidos as $pedido):?>
                <tr>
                    <td class="text-center"><?= $pedido['tela'] ?></td>
                    <td class="text-center"><?= $pedido['color'] ?></td>
                    <td class="text-center"><?= $pedido['talla'] ?></td>
                    <td class="text-center"><?= $pedido['cantidad'] ?></td>
                    <td class="text-center"><?= $pedido['mensaje'] ?></td>
                    <td class="text-center"><?= $pedido['importe'] ?></td>
                    <td class="text-center"><img src="<?= '../resources/upload/' . $pedido['nombre_archivo'] ?>" height="100px"></td>
                </tr>
            <?php endforeach; ?>
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
