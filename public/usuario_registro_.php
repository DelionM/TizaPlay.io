<?php

$PageTitle = "Registro";
include '../resources/templates/head.html';
include '../resources/templates/header.html';
include '../resources/templates/navegacion_inicio.html';
include '../resources/db/PersonaDB.php';
include '../resources/db/UsuarioDB.php';

function sanitizacion($data)
{
    $data = trim($data); // Elimina espacio en blanco (u otro tipo de caracteres) del inicio y el final de la cadna
    $data = stripslashes($data); // (\) se convierte en () y Barras invertidas dobles (\\) se convierten en una sencilla (\).
    $data = htmlspecialchars($data); // ejemplo convierte <a href='test'>Test</a> en &lt;a href=&#039;test&#039;&gt;Test&lt;/a&gt
    return $data;
}

$nombre = $paterno = $materno = $calle = $numero = $cp = $usuario = $email = $contrasenia = $contrasenia2 = "";
//$errores = [];
unset($errores);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["nombre"])) {
        $errores['nombre'] = "se requiere el nombre";
    } else {
        $nombre = sanitizacion($_POST["nombre"]);
    }
    if (empty($_POST["paterno"])) {
        $errores['paterno'] = "se requiere el apellido paterno";
    } else {
        $paterno = sanitizacion($_POST["paterno"]);
    }
    if (empty($_POST["materno"])) {
        $errores['materno'] = "se requiere el apellido materno";
    } else {
        $materno = sanitizacion($_POST["materno"]);
    }
    if (empty($_POST["calle"])) {
        $errores['calle'] = "se requiere la calle";
    } else {
        $calle = sanitizacion($_POST["calle"]);
    }
    if (empty($_POST["numero"])) {
        $errores['numero'] = "se requiere el número";
    } else {
        $numero = sanitizacion($_POST["numero"]);
        if (!filter_var($numero, FILTER_VALIDATE_INT)) {
            $errores['numero'] = "No es un número entero";
        }
    }
    if (empty($_POST["cp"])) {
        $errores['cp'] = "se requiere el CP";
    } else {
        $cp = sanitizacion($_POST["cp"]);
    }
    if (empty($_POST["usuario"])) {
        $errores['usuario'] = "se requiere el usuario";
    } else {
        $usuario = sanitizacion($_POST["usuario"]);
    }
    if (empty($_POST["email"])) {
        $errores['email'] = "se requiere un email";
    } else {
        $email = sanitizacion($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errores['email'] = "No es un formato válido de email";
        }
    }
    if (empty($_POST["contrasenia"])) {
        $errores['contrasenia'] = "se requiere la contraseña ";
    } else {
        $contrasenia = sanitizacion($_POST["contrasenia"]);
    }
    if (empty($_POST["contrasenia2"])) {
        $errores['contrasenia2'] = "se requiere la confirmación de la contraseña ";
    } else {
        $contrasenia2 = sanitizacion($_POST["contrasenia2"]);
    }
    if (strcmp($contrasenia, $contrasenia2) != 0) {
        $errores['contrasenia'] = "las contraseñas no coinciden";
    }

    if (count($errores) == 0) {
        $personaDB = new PersonaDB();
        $usuarioDB = new UsuarioDB();

        if (!$personaDB->existeCorreo($_POST['email']) && !$usuarioDB->existeUsuario($_POST['usuario'])) {
            $personaDB->insertaPersona($_POST);
            $idReceinte = $personaDB->getUltimoIdInsertado();
            $usuarioDB->insertaUsuario($idReceinte, $_POST);
            header("Location:usuario_registro_confirmar.php");
            exit();

        } else {
            if ($personaDB->existeCorreo($_POST['email'])) {
                ?>
                <div class="text-center m-5 p-5 text-danger ">
                    <h2>Ya existe un registro con ese correo electrónico</h2>
                </div>
                <?php
            } else {
                ?>
                <div class="text-center m-5 p-5 text-danger ">
                    <h2>Ya existe un registro con ese nombre de usuario</h2>
                </div>
            <?php }
        }
    }
}


?>

    <main>
        <div class="text-secondary text-center m-4 ">
            <h2>Registro de usuario nuevo</h2>
        </div>

        <div class="container">
            <div class="row justify-content-center">
                <div class="column col-9">
                    <form method="POST" novalidate action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                        <!-- /usuario_registro.php/%22%3E%3Cscript%3Ealert('hacked')%3C/script%3E   ->    <form  method="POST" action="usuario_registro.php"><script>alert('hacked')</script> --->
                        <div class="mt-2">
                            <label class="form-label" for="nombre">Nombre:</label>
                            <input class="form-control" type="text" name="nombre" value="<?= $nombre ?>">
                            <span class="text-danger"><?= $errores['nombre'] ?></span>
                        </div>
                        <div class="mt-2">
                            <label class="form-label " for="paterno">Apellido paterno:</label>
                            <input class="form-control" type="text" name="paterno" value="<?= $paterno ?>">
                            <span class="text-danger"><?= $errores['paterno'] ?></span>
                        </div>
                        <div class="mt-2">
                            <label class="form-label " for="materno">Apellido materno:</label>
                            <input class="form-control" type="text" name="materno" value="<?= $materno ?>">
                            <span class="text-danger"><?= $errores['materno'] ?></span>
                        </div>
                        <div class="mt-2">
                            <label class="form-label " for="calle">Calle:</label>
                            <input class="form-control" type="text" name="calle" value="<?= $calle ?>">
                            <span class="text-danger"><?= $errores['calle'] ?></span>
                        </div>
                        <div class="mt-2">
                            <label class="form-label " for="numero">Número:</label>
                            <input class="form-control" type="text" name="numero" value="<?= $numero ?>">
                            <span class="text-danger"><?= $errores['numero'] ?></span>
                        </div>
                        <div class="mt-2">
                            <label class="form-label " for="cp">Código postal:</label>
                            <input class="form-control" type="text" name="cp" value="<?= $cp ?>">
                            <span class="text-danger"><?= $errores['cp'] ?></span>
                        </div>
                        <div class="mt-2">
                            <label class="form-label " for="usuario">Usuario:</label>
                            <input class="form-control" type="text" name="usuario" value="<?= $usuario ?>">
                            <span class="text-danger"><?= $errores['usuario'] ?></span>
                        </div>
                        <div class="mt-2">
                            <label class="form-label " for="email">correo electrónico:</label>
                            <input class="form-control" type="email" name="email" value="<?= $email ?>">
                            <span class="text-danger"><?= $errores['email'] ?></span>
                        </div>
                        <div class="mt-2">
                            <label class="form-label " for="contrasenia">Contraseña</label>
                            <input class="form-control" type="password" name="contrasenia" id="contrasenia"
                                   required>
                            <span class="text-danger"><?= $errores['contrasenia'] ?></span>
                        </div>
                        <div class="mt-2">
                            <label class="form-label " for="contrasenia2">Repetir contraseña</label>
                            <input class="form-control" type="password" name="contrasenia2" id="contrasenia2"
                                   required>
                            <span class="text-danger"><?= $errores['contrasenia2'] ?></span>
                        </div>
                        <div class="mt-2">
                            <input class="btn btn-primary " type="submit" value="Enviar">
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </main>

<?php
include '../resources/templates/footer.html';
include '../resources/templates/scripts.html';
?>
    <script>
        let password = document.getElementById("contrasenia")
        let confirm_password = document.getElementById("contrasenia2");

        function validatePassword() {
            if (password.value != confirm_password.value) {
                confirm_password.setCustomValidity("Las contraseñas no coinciden");
            } else {
                confirm_password.setCustomValidity('');
            }
        }

        password.onchange = validatePassword;
        confirm_password.onkeyup = validatePassword;
    </script>
<?php
include '../resources/templates/fin.html';