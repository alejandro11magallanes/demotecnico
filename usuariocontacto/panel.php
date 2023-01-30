<?php
session_start();

$nombre = $_SESSION['nombre'];
$id = $_SESSION['id'];
if (!isset($_SESSION['rol'])) {
    header("location: login.php");
} else {
    if ($_SESSION['rol'] != 2) {
        header("location: login.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="../img/icono.png" />
    <link rel="stylesheet" href="../css/style.css" />
    <title>Tus contactos</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg" id="nav">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html">
                <img src="../img/logo1.png" alt="Logo" width="200" class="d-inline-block align-text-top" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li style="margin-left: 30px" class="nav-item">
                        <a class="nav-link" href="../inicio.php">Perfil de Usuario</a>
                    </li>
                    <li style="margin-left: 30px" class="nav-item">
                        <a class="nav-link" href="../empresasusuario/panel.php">Empresas</a>
                    </li>
                    <li style="margin-left: 30px" class="nav-item">
                        <a class="nav-link active" href="">Contactos</a>
                    </li>
                </ul>
            </div>
            <div class="navbar-brand">
                <h4>Hola <?php echo $nombre; ?></h4>
            </div>
            <div class="navbar-brand">
                <button class="btn" id="cerrar-boton" onclick="location.href='../logout.php'">
                    Cerrar Sesion
                </button>
            </div>
        </div>
    </nav>
    <br>
    <div class="container">
        <h5>Selecciona una empresa para conocer los Proveedores </h5>
        <div class="row">
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="col-md-3">
                    <select class="form-select" name="seleccion" required>
                        <option value="" selected>Empresa:</option>
                        <?php


                        include 'connect.php';

                        $consultacfdi = "SELECT * FROM empresas WHERE usuario='$id'";
                        $ejectuar = mysqli_query($con, $consultacfdi);

                        ?>
                        <?php
                        foreach ($ejectuar as $opciones) :

                        ?>

                        <option value="<?php echo $opciones['id']; ?>"><?php echo $opciones['rfc']; ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-3" style="margin-left: 28%; margin-top: -38px;">
                    <button type="submit" style="margin-left: 20px;" name="buscar" id="titulo-boton"
                        class="btn">Buscar</button>
                </div>
            </form>
        </div>
        <div class="row">
            <?php
            include 'connect.php';
            if (isset($_POST['buscar'])) {
                $requerido = $_REQUEST['seleccion'];
                $consulta = "SELECT contactos.id as id, nombre, correo  from contactos WHERE contactos.empresa = '$requerido'";
                $ejectuar = mysqli_query($con, $consulta);
                $seleccionusuario = $_REQUEST['seleccion'];
                $consultanombre = "SELECT razon FROM empresas WHERE id = '$seleccionusuario'";
                $ejectuarn = mysqli_query($con, $consultanombre);

            ?>
            <div class="col-md-12 p-2">
                <div class="table-responsive">
                    <?php
                        while ($row = mysqli_fetch_array($ejectuarn)) {
                            echo "<h3 style='margin-left: 60px; margin-top: -30px;'>Usuario Seleccionado: '" . $row[0] . "'</h3>";
                        }
                        ?>
                    <table id="example" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr id="tabla-head">

                                <th scope="col">Proveedor</th>
                                <th scope="col">Contacto</th>
                                <th scope="col">Correo Electronico</th>
                                <th scope="col">Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $conteo = 1;
                                while ($dataUsuario = mysqli_fetch_array($ejectuar)) { ?>
                            <tr>

                                <td><?php echo $dataUsuario['nombre']; ?></td>
                                <td><?php echo $dataUsuario['nombre']; ?></td>
                                <td><?php echo $dataUsuario['correo']; ?></td>
                                <td class="text-center">

                                    <a href="editar.php?id=<?php echo $dataUsuario['id']; ?>" class="btn btn-info mb-2">
                                        <i class="bi bi-arrow-clockwise"></i>Modificar</a>
                                </td>
                            </tr>
                            <?php } ?>
                    </table>
                </div>
            </div>
            <div class="container">


            </div>
            <?php
            }
            ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="./app.js"></script>
</body>

</html>