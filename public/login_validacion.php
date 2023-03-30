<?php

session_start();
include '../resources/db/UsuarioDB.php';

$usuarioDB = new UsuarioDB();
$passwordAlmacendo = $usuarioDB->getPasswordHashByUser($_POST['usuario']);
if (password_verify($_POST['contraseñaE'], $passwordAlmacendo)) {
    $_SESSION['usuario'] = $_POST['usuario'];
    $consulta = $usuarioDB->getUsuarioTipoCientePorUsuario($_POST['usuario']);
    $tipoUsuario = $consulta['tipo_usuario'];
    $_SESSION['id_usuario'] = $consulta['id_usuario'];
    if ($tipoUsuario == 'administrador') {
        header("Location:vista_administrador.php");
    } else {
        header("Location:vista_cliente.php");
    }
    exit();
} else { // Usuario o password inválido
    header("Location:login_error.php");
    exit();
}
