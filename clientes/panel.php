<?php
session_start();
include 'connect.php';
$nombre = $_SESSION['nombre'];
$id = $_SESSION['id'];
$sub = "SELECT empresas.id as id FROM empresas WHERE usuario = '$id'";
$query = mysqli_query($con, $sub);
$result = mysqli_fetch_array($query);
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
    <title>Tus clientes</title>
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
                        <a class="nav-link " href="../usuariocontacto/panel.php">Proveedores</a>
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
        <h5>Selecciona una empresa para conocer a tus clientes </h5>
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
                $consulta = "SELECT clientes.id as id ,empresa_cli, contacto, correo, fecha_csf,nip,pdf_csf  from clientes WHERE empresa = '$requerido'";
                $ejectuar = mysqli_query($con, $consulta);

            ?>
            <div class="col-md-12 p-2">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr id="tabla-head">
                                <th scope="col">ID</th>
                                <th scope="col">Cliente</th>
                                <th scope="col">Contacto</th>
                                <th scope="col">Correo Electronico</th>

                                <th scope="col">CSF Emision</th>
                                <th scope="col">NIP</th>
                                <th scope="col">Archivo</th>
                                <th scope="col">Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $conteo = 1;
                                $fechaactual = date('Y-m-d');
                                while ($dataUsuario = mysqli_fetch_array($ejectuar)) {
                                    $icono = "";
                                    if ($dataUsuario['pdf_csf'] != null && date('Y-m-d', strtotime($dataUsuario['fecha_csf'] . "+90 days")) <= $fechaactual) {
                                        $icono = "<a href='../verclientes.php?id=$dataUsuario[id]>"
                                            . "'
                        class='btn btn-warning mb-2'><i class='bi bi-file-earmark-break'></i></a>";
                                    } else if ($dataUsuario['pdf_csf'] != null) {
                                        $icono = "<a href='../verclientes.php?id=$dataUsuario[id]>"
                                            . "'
                            class='btn btn-info mb-2'><i class='bi bi-file-earmark-arrow-down'></i></a>";
                                    } else if ($dataUsuario['pdf_csf'] == null) {
                                        $icono = "<button class='btn btn-danger mb-2'><i
                                    class='bi bi-file-earmark-excel'></i></button>";
                                    }


                                ?>

                            <tr>
                                <td><?php echo $dataUsuario['id']; ?></td>
                                <td><?php echo $dataUsuario['empresa_cli']; ?></td>
                                <td><?php echo $dataUsuario['contacto']; ?></td>
                                <td><?php echo $dataUsuario['correo']; ?></td>
                                <td><?php echo $dataUsuario['fecha_csf']; ?></td>
                                <td><?php echo $dataUsuario['nip']; ?></td>
                                <td class="text-center"><?php echo $icono; ?></td>
                                <td class="text-center">

                                    <a href="editar.php?id=<?php echo $dataUsuario['id']; ?>" class="btn btn-info mb-2">
                                        <i class="bi bi-arrow-clockwise"></i>Modificar</a>
                                </td>
                            </tr>
                            <?php
                                    if ($dataUsuario['fecha_csf'] == null) {
                                    } else {
                                        echo $sumandofecha = date('Y-m-d', strtotime($dataUsuario['fecha_csf'] . "+90 days"));
                                    }
                                }
                                ?>
                        </tbody>
                    </table>
                </div>
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