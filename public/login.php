<?php

$PageTitle = "Login";
include '../resources/templates/head.html';
include '../resources/templates/header.html';
include '../resources/templates/navegacion_inicio.html';
?>

    <main>
        <div class="container">

            <div class="row justify-content-center">

                <div class="column col-9 col-md-6 ">

                    <form action="login_validacion.php" method="POST">
                        <div class="mt-3">
                            <label class="form-label" for="usuario">Usuario</label>
                            <input class="form-control" type="text" name="usuario" id="usuario" required>
                        </div>
                        <div class="mt-3">
                            <label class="form-label" for="contraseñaE">Contraseña</label>
                            <input class="form-control" type="password" name="contraseñaE" id="contraseñaE" required>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

<?php
include '../resources/templates/footer.html';
include '../resources/templates/scripts.html';
include '../resources/templates/fin.html';