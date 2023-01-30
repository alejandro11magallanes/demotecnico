<?php

session_start();

if (!isset($_SESSION['rol'])) {
    header("location: login.php");
} else {
    if ($_SESSION['rol'] != 1) {
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
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="../img/icono.png" />
    <link rel="stylesheet" href="../css/style.css" />
    <title>Reportes</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg" id="nav">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html">
                <img src="../img/logo1.png" alt="Logo" width="200" class="d-inline-block align-text-top" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li style="margin-left: 30px" class="nav-item ">
                        <a class="nav-link " href="../inicioadmin.php">Usuarios</a>
                    </li>
                    <li style="margin-left: 30px" class="nav-item">
                        <a class="nav-link " href="../empresas/panel.php">Empresas</a>
                    </li>
                    <li style="margin-left: 30px" class="nav-item">
                        <a class="nav-link" href="../empresareporte/panel.php">Empresas para descarga</a>
                    </li>
                    <li style="margin-left: 30px" class="nav-item">
                        <a class="nav-link" href="fecha.php">Proveedores Modificados</a>
                    </li>
                    <li style="margin-left: 30px" class="nav-item">
                        <a class="nav-link" href="../reportescli/modificados.php">Clientes Modificados</a>
                    </li>
                    <li style="margin-left: 30px" class="nav-item">
                        <a class="nav-link" href="../reportescli/reporte.php">Reportes de Clientes</a>
                    </li>
                    <li style="margin-left: 30px" class="nav-item">
                        <a class="nav-link active" href="">Reportes de Proveedores</a>
                    </li>
                </ul>
            </div>
            <div class="navbar-brand">
                <button id="cerrar-boton" class="btn" onclick="location.href='../logout.php'">
                    Cerrar Sesion
                </button>
            </div>
        </div>
    </nav>
    <div class="container mt-3">
        <div class="row justify-content-md-center">
            <div class="col-md-6">
                <h2 class="text-center mt-3">Reportes de Clientes</h2>
                <hr class="mb-3">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <h5>Selecciona un usuario y una empresa para conocer los contactos registrados</h5>
                <form method="POST" action="" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label for="usuario">Usuario</label>
                        <select class="form-select" name="usuario" required>
                            <option value="" selected>Seleccione un usuario</option>
                            <?php
                            include 'connect.php';

                            $consultaUsuario = "SELECT * FROM usuarios";
                            $ejectuar = mysqli_query($con, $consultaUsuario);


                            foreach ($ejectuar as $opciones) :

                            ?>

                                <option value="<?php echo $opciones['id']; ?>" <?php
                                                                                if (
                                                                                    isset(
                                                                                        $_POST['usuario']
                                                                                    )
                                                                                    and $_POST['usuario'] == $opciones['id']
                                                                                ) echo 'selected';
                                                                                ?>>
                                    <?php echo $opciones['username']; ?>
                                </option>
                            <?php endforeach ?>
                        </select>

                    </div>
                    <?php
                    if (isset($_POST['usuario'])) {
                        $consultados = "SELECT * FROM empresas where usuario = " . ($_POST['usuario']) . ";";
                        $ejectuardos = mysqli_query($con, $consultados);
                    ?>
                        <div class="mb-3">
                            <label for="usuario">Empresa</label>
                            <select class="form-select" name="empresa" required>
                                <option value="" selected>Seleccione la empresa</option>
                                <?php



                                foreach ($ejectuardos as $opciones) :

                                ?>

                                    <option value="<?php echo $opciones['id']; ?>" <?php
                                                                                    if (
                                                                                        isset(
                                                                                            $_POST['empresa']
                                                                                        )
                                                                                        and $_POST['empresa'] == $opciones['id']
                                                                                    ) echo ' selected ';
                                                                                    ?>>
                                        <?php echo $opciones['rfc']; ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        <?php
                    }
                        ?>
                        </div>
                        <div class="mb-3 ">
                            <button type="submit" name="enviar" class="btn  btn btn-primary mt-3 mb-2">
                                Buscar
                            </button>
                        </div>
                </form>
                <?php
                if (isset($_POST['empresa'])) {
                    include('connect.php');
                    $empresa = $_POST['empresa'];
                    $sqlUsuarios   = ("SELECT * FROM contactos where empresa = '$empresa'");
                    $queryUsuarios = mysqli_query($con, $sqlUsuarios);
                    $totalUsuarios = mysqli_num_rows($queryUsuarios);
                ?>
                    <div class="row">
                        <div class="col-md-6">
                            <button class="btn  btn-success" onclick="location.href='panel.php'">
                                Nueva Busqueda
                            </button>
                        </div>
                        <div class="col-md-6">
                            <a href="excel.php?id=<?php echo $empresa ?>"> <img src="../img/aaa.png" width="20%"></a>
                        </div>
                    </div>
                    <?php
                    ?>
            </div>



            <div class="col-md-8 text-center">
                <h3 class="text-center">Contacto registrados <?php echo '(' . $totalUsuarios . ')'; ?>
                </h3>
                <div class="row">
                    <div class="col-md-12 p-2">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover ">
                                <thead>
                                    <tr id="tabla-head">
                                        <th>#</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Correo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $conteo = 1;
                                    while ($dataUsuario = mysqli_fetch_array($queryUsuarios)) { ?>
                                        <tr>
                                            <td><?php echo  $conteo++ . ')'; ?></td>
                                            <td><?php echo $dataUsuario['nombre']; ?></td>
                                            <td><?php echo $dataUsuario['correo']; ?></td>
                                        </tr>
                                    <?php } ?>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

<?php
                } ?>


</body>

</html>