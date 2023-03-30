<?php
session_start();
if (isset($_SESSION['usuario'])) {

    $PageTitle = "Pedidos";

    include '../resources/templates/head.html';
    include '../resources/templates/header.html';
    include '../resources/templates/navegacion_administrador.html';

//    include '../resources/DB/PedidoDB.php';
//    $pedidoDB = new PedidoDB();
//    $pedidos = $pedidoDB->getPedidos();
    ?>

    <main>

        <div class="text-secondary text-center m-4 ">
            <h2>Tabla de pedidos</h2>
        </div>

        <input class="form-control mb-5" type="text" id="busqueda" onkeyup="funcionBuscar()"
               placeholder="Búsqueda por usuario" title="Escribe un usuario">

        <table class="table table-striped" id="tabla">
            <tr>
                <th class="text-center">Usuario</th>
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
            $pedidos = $pedidoDB->getPedidos();
            foreach ($pedidos as $pedido):?>
                <tr>
                    <td class="text-center"><?= $pedido['usuario'] ?></td>
                    <td class="text-center"><?= $pedido['tela'] ?></td>
                    <td class="text-center"><?= $pedido['color'] ?></td>
                    <td class="text-center"><?= $pedido['talla'] ?></td>
                    <td class="text-center"><?= $pedido['cantidad'] ?></td>
                    <td class="text-center"><?= $pedido['mensaje'] ?></td>
                    <td class="text-center"><?= $pedido['importe'] ?></td>
                    <td class="text-center"><img src="<?= '../resources/upload/' . $pedido['nombre_archivo'] ?>"
                                                 height="100px"></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </main>

    <?php

    include '../resources/templates/footer.html';
    ?>
    <script>
        function funcionBuscar() {
            let textoBuscar, tabla, renglones, primerCelda, renglon, textoCelda;
            textoBuscar = document.getElementById("busqueda").value.toUpperCase();
            tabla = document.getElementById("tabla");
            renglones = tabla.getElementsByTagName("tr");
            for (renglon = 0; renglon < renglones.length; renglon++) {
                primerCelda = renglones[renglon].getElementsByTagName("td")[0];
                if (primerCelda) {
                    textoCelda = primerCelda.textContent || primerCelda.innerText;
                    if (textoCelda.toUpperCase().indexOf(textoBuscar) > -1) {
                        renglones[renglon].style.display = "";
                    } else {
                        renglones[renglon].style.display = "none";
                    }
                }
            }
        }
    </script>
    <?php
    include '../resources/templates/scripts.html';
    include '../resources/templates/fin.html';

} else {
    header("Location:login_error.php");
    exit();
}