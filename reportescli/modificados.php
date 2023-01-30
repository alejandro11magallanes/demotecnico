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
                        <a class="nav-link " href="../reportes/fecha.php">Proveedores Modificados</a>
                    </li>
                    <li style="margin-left: 30px" class="nav-item">
                        <a class="nav-link active" href="">Clientes Modificados</a>
                    </li>
                    <li style="margin-left: 30px" class="nav-item">
                        <a class="nav-link" href="reporte.php">Reportes de Clientes</a>
                    </li>
                    <li style="margin-left: 30px" class="nav-item">
                        <a class="nav-link " href="../reportes/panel.php">Reportes de Proveedores</a>
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
            <div class="col-md-12">
                <h2 class="text-center mt-3">Reportes de Clientes Modificados en su correo</h2>
                <hr class="mb-3">
            </div>
        </div>
        <h5>Selecciona un fecha para conocer los clientes que se han actualizado a partir de ella</h5>
        <div class="row">
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="col-md-3">
                    <select class="form-select" name="seleccion" required>
                        <option value="" selected>Usuario:</option>
                        <?php

                        include 'connect.php';
                        $consultacfdi = "SELECT * FROM usuarios";
                        $ejectuar = mysqli_query($con, $consultacfdi);

                        ?>
                        <option value="todos">Todos</option>
                        <?php
                        foreach ($ejectuar as $opciones) :

                        ?>

                            <option value="<?php echo $opciones['id']; ?>"><?php echo $opciones['username']; ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-3" style="margin-left: 28%; margin-top: -38px;">
                    <label for="usuario">Fecha</label>
                    <input type="date" id="start" name="fecha" value="2022-01-01" min="2022-01-01" max="2040-12-31">
                    <button type="submit" style="margin-left: 20px;" name="buscar" id="titulo-boton" class="btn">Buscar</button>
                </div>
            </form>
            <?php
            include 'connect.php';
            if (isset($_POST['buscar'])) {
                $fecha = $_REQUEST['fecha'];
                $requerido = $_REQUEST['seleccion'];
                if ($requerido == "todos") {
                    $consulta = "SELECT usuarios.username as user, empresas.rfc as Empresa, clientes.empresa_cli as Empresa_Cliente, clientes.contacto as Contacto, clientes.correo as Email, clientes.fecha_actualizacion as Fecha_Modificacion FROM  empresas, usuarios, clientes WHERE clientes.empresa = empresas.id AND empresas.usuario = usuarios.id AND clientes.fecha_actualizacion >='$fecha'";
                } else {
                    $consulta = "SELECT usuarios.username as user,  empresas.rfc as Empresa, clientes.empresa_cli as Empresa_Cliente, clientes.contacto as Contacto, clientes.correo as Email, clientes.fecha_actualizacion as Fecha_Modificacion FROM empresas, clientes, usuarios WHERE clientes.empresa = empresas.id AND empresas.usuario = usuarios.id AND clientes.fecha_actualizacion >='$fecha' ANd usuarios.id = '$requerido'";
                }
                // $consulta = "SELECT nombre, correo, fecha,empresas.rfc as rfc from contactos INNER JOIN empresas On contactos.empresa = empresas.id WHERE contactos.fecha >='$fecha'";
                $ejectuar = mysqli_query($con, $consulta);

            ?>
                <div class="col-md-6" style="margin-left: 58%; margin-top: -38px;">
                    <div class="row">
                        <div class="col-md-4">
                            <button class="btn  btn-success" onclick="location.href='modificados.php'">
                                Nueva Busqueda
                            </button>
                        </div>
                        <div class="col-md-4">
                            <a href="../exfechaclientes.php?id=<?php echo $fecha ?>&user=<?php echo $requerido ?>"> <img src="../img/aaa.png" width="20%"></a>
                        </div>
                    </div>
                </div>
        </div>
        <div class="row">

            <div class="col-md-12 p-2">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr id="tabla-head">
                                <th>#</th>
                                <th scope="col">Usuario</th>
                                <th scope="col">Empresa</th>
                                <th scope="col">Empresa Cliente</th>
                                <th scope="col">Contacto</th>
                                <th scope="col">Email</th>
                                <th scope="col">Fecha de Modificación</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $conteo = 1;
                            while ($dataUsuario = mysqli_fetch_array($ejectuar)) { ?>
                                <tr>
                                    <td><?php echo  $conteo++ . ')'; ?></td>
                                    <td><?php echo $dataUsuario['user']; ?></td>
                                    <td><?php echo $dataUsuario['Empresa']; ?></td>
                                    <td><?php echo $dataUsuario['Empresa_Cliente']; ?></td>
                                    <td><?php echo $dataUsuario['Contacto']; ?></td>
                                    <td><?php echo $dataUsuario['Email']; ?></td>
                                    <td><?php echo $dataUsuario['Fecha_Modificacion']; ?></td>
                                </tr>
                            <?php } ?>
                    </table>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <button class="btn  btn-success" onclick="location.href='modificados.php'">
                            Nueva Busqueda
                        </button>
                    </div>
                    <div class="col-md-4">
                        <a href="../exfechaclientes.php?id=<?php echo $fecha ?>&user=<?php echo $requerido ?>"> <img src="../img/aaa.png" width="10%"></a>
                    </div>
                </div>

            </div>
        <?php
            }
        ?>

        </div>
    </div>
</body>

</html>