<?php
ob_start();
session_start();
$ancla = $_SESSION['cliente'];
$empresa = $_SESSION['empresa'];
$nip = $_SESSION['nip'];
$id = $_SESSION['id'];
include 'connect.php';

$consulta = "SELECT razon FROM empresas WHERE id = '$ancla'";
$ejecutar = mysqli_query($con, $consulta);


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="shortcut icon" href="img/icono.png" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css" />
    <title>Portal</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg" id="nav">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html">
                <img src="img/logo1.png" alt="Logo" width="200" class="d-inline-block align-text-top" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li style="margin-left: 30px; font-size: 25px" class="nav-item">
                        <a class="nav-link" href="info.html">¿Qué es Preset?</a>
                    </li>
                    <li style="margin-left: 30px; font-size: 25px" class="nav-item">
                        <a class="nav-link" href="planes.html">Planes por Empresa</a>
                    </li>
                    <li style="margin-left: 30px; font-size: 25px" class="nav-item">
                        <a class="nav-link" href="funcion.html">Funcionalidad</a>
                    </li>
                    <li style="margin-left: 30px; font-size: 25px" class="nav-item">
                        <a class="nav-link" href="contacto.php">Contactanos</a>
                    </li>
                </ul>
            </div>
            <div class="navbar-brand">
                <button class="btn" id="cerrar-boton" onclick="location.href='cerrar.php'">
                    Cerrar Sesion
                </button>
            </div>
        </div>
    </nav>
    <br />
    <br>
    <br>
    <div class="container">
        <div class="row">
            <h3 style="color: #00b0f0;">Bienvenido al portal de Clientes</h3>
            <br>
            <br>
            <br>
            <div class="col-md-4 offset-md-4">
                <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Empresa: <?php echo $empresa; ?> </label>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Numero de Cliente</label>
                        <input readonly type="text" value="<?php echo $id; ?>" name="usuario" pattern="[0-9]{1,25}"
                            class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Contraseña:</label>
                        <input type="password" readonly value="<?php echo $nip; ?>" name="pass" class="form-control"
                            pattern="[0-9]{1,25}" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Agrega la CSF de la empresa</label>
                        <input type="file" class="form-control" name="archivo" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha de emision de Constancia</label>
                        <input type="date" id="start" name="fecha" min="2022-01-01" max="2040-12-31" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" name="subir" id="titulo-boton" class="btn ">Subir Constancia</button>
                    </div>
                    <br>

                </form>
            </div>
        </div>
    </div>
</body>

</html>



<!-- Funcionalidad de insertar csf en el registro del cliente -->
<?php


if (isset($_POST['subir'])) {
    $fecha_csf = filter_var($_POST['fecha'], FILTER_SANITIZE_STRING);
    $pasouno = $_FILES['archivo']['tmp_name'];
    $pasodos = file_get_contents($pasouno);
    $achivolisto = addslashes($pasodos);
    $UpdateUsuario    = ("UPDATE clientes SET fecha_csf='$fecha_csf', pdf_csf='$achivolisto'  WHERE id='$id'");
    $resultadoUpdate = mysqli_query($con, $UpdateUsuario);
    header("location: cerrar.php");
}
?>