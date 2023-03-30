<?php
$PageTitle = "Index";
include '../resources/templates/head.html';
include '../resources/templates/header.html';
include '../resources/templates/navegacion_inicio.html';
?>

<main>
    <!-- Inicio banner -->

    <!--pantallas medianas en adelante-->
    <div class="d-none d-md-block">
        <div class="position-relative">
            <img src="../public/assets/img/banner-bg.jpg" alt="" class="img-fluid">

            <div class="position-absolute bottom-0 bg-light rounded m-4 p-4 " style="opacity:0.8">
                <p class="fw-bold">Tiza-shirts</p>
                <p>Dale una mejor impresión a tu negocio</p>
                <p> Playeras estampadas con el logotipo de tu empresa, en todos los diseños, colores y tallas</p>
                <a href="login.php" class="btn btn-primary text-uppercase mx-2">Accesar</a>
                <a href="usuario_registro.php" class="btn btn-primary text-uppercase mx-2">Registrarse</a>
            </div>
        </div>
    </div>

    <!--pantallas pequeñas-->
    <div class="">
        <img src="../public/assets/img/banner-bg.jpg" alt="" class="img-fluid d-md-none">

        <div class=" bottom-0 bg-light rounded m-4 p-4 d-md-none text-center" style="opacity:0.8">
            <p class="fw-bold">Tiza-shirts</p>
            <p>Dale una mejor impresión a tu negocio</p>
            <div class="d-md-none">

                <p class="d-none"> Playeras estampadas con el logotipo de tu empresa, en todos los diseños, colores y
                    tallas</p>
            </div>
            <a href="login.php" class="btn btn-primary text-uppercase my-1 ">Accesar</a>
            <a href="usuario_registro.php.php" class="btn btn-primary text-uppercase my-1">Registrarse</a>
        </div>
    </div>
    <!-- fin banner -->

</main>

<?php
include '../resources/templates/footer.html'; 
include '../resources/templates/scripts.html';
include '../resources/templates/fin.html';
