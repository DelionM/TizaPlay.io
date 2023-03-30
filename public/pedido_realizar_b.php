<?php
session_start();
if (isset($_SESSION['usuario'])) {

    $PageTitle = "Confirmar pedido";

    include '../resources/templates/head.html';
    include '../resources/templates/header.html';
    include '../resources/templates/navegacion_clientes.html';
    ?>

    <main>

        <div class="text-secondary text-center mt-5">
            <h2>
                <?php print $_SESSION['usuario'] ?> detalles de tu pedido
            </h2>
        </div>

        <?php
        include '../resources/db/PlayeraDB.php';
        $playeraDB = new PlayeraDB();
        $idplayera = $playeraDB->getIdPlayera($_POST);
        if ($idplayera == 0) { // si no hay playeras de ese tipo ?>

            <div class="text-center m-5 p-5 text-danger ">
                <h2>No hay playeras con esas características en existencia, intenta con otras características</h2>
            </div>

            <?php
        } else {

            // inserta imagen
            include '../resources/db/ImagenDB.php';
            $imagenDB = new ImagenDB();
            $imagenDB->insertaImagen($_FILES);

            if ($_POST['tela'] == 2) {
                $costo = 150;
            } else {
                $costo = 100;
            }
            $costo *= $_POST['cantidad'];

            $idImagen = $imagenDB->getMaxId();
            //inserta pedido
            include '../resources/db/PedidoDB.php';
            $pedidoDB = new PedidoDB();
            $pedidoDB->insertaPedido($idplayera, $_SESSION['id_usuario'], $costo, $idImagen, $_POST);

            // obtiene pedido
            $idPedido = $pedidoDB->getMaxId();
            $pedido = $pedidoDB->getPedidoPorId($idPedido);
            $_SESSION['id_pedido'] = $idPedido;

            //obtiene imagen
            $nombreImagen = $imagenDB->getNombreArchivoById($pedido['fk_idimagen']);
            $imagenURL = '../resources/upload/' . $nombreImagen;
            ?>

            <div class="container">
                <div class="row justify-content-center">
                    <div class="column col-9">

                        <form action="pedido_realizar_c.php" method="POST">

                            <div class="mb-3">
                                <label class="form-label" for="tela">Tela:</label>
                                <input class="form-control" type="text" name="tela" readonly="readonly" value="<?= $pedido['tela'] ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="color">Color:</label>
                                <input class="form-control" type="text" name="color" readonly="readonly" value="<?= $pedido['color'] ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="talla">Talla:</label>
                                <input class="form-control" type="text" name="color" readonly="readonly" value="<?= $pedido['talla'] ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="cantidad">Cantidad:</label>
                                <input class="form-control" type="text" name="cantidad" readonly="readonly"
                                       value="<?= $pedido['cantidad'] ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="mensaje">Mensaje:</label>
                                <input class="form-control" type="textarea" name="mensaje" readonly="readonly"
                                       value="<?= $pedido['mensaje'] ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="costo">Costo:</label>
                                <input class="form-control" type="textarea" name="costo" readonly="readonly"
                                       value="<?= $pedido['importe'] ?>">
                            </div>


                            <div class="mb-3">
                                <label class="form-label" for="imagen">Imagen:</label>
                                <img src="<?= $imagenURL ?>" height="150px">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="referencia">Referencia:</label>
                                <input class="form-control" type="textarea" name="referencia" readonly="readonly"
                                       value=<?= rand(0, 100000) ?>>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="contrareferencia">Contrareferencia: </label>
                                <input class="form-control"  type="text" name="contrareferencia">
                            </div>

                            <div class="mb-3">
                                <button class="btn btn-primary" type="submit">Pagar</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        <?php } ?>

    </main>

    <?php

    include '../resources/templates/footer.html';
    include '../resources/templates/scripts.html';
    include '../resources/templates/fin.html';

} else {
    header("Location:login_error.php");
    exit();
}
