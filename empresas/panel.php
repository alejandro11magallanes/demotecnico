<?php

use PhpOffice\PhpSpreadsheet\Calculation\LookupRef\Selection;

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
    <title>Administracion de empresas</title>
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
                        <a class="nav-link active" href="">Empresas</a>
                    </li>
                    <li style="margin-left: 30px" class="nav-item">
                        <a class="nav-link" href="../empresareporte/panel.php">Empresas para descarga</a>
                    </li>
                    <li style="margin-left: 30px" class="nav-item">
                        <a class="nav-link" href="../reportes/fecha.php">Proveedores Modificados</a>
                    </li>
                    <li style="margin-left: 30px" class="nav-item">
                        <a class="nav-link" href="../reportescli/modificados.php">Clientes Modificados</a>
                    </li>
                    <li style="margin-left: 30px" class="nav-item">
                        <a class="nav-link" href="../reportescli/reporte.php">Reportes de Clientes</a>
                    </li>
                    <li style="margin-left: 30px" class="nav-item">
                        <a class="nav-link" href="../reportes/panel.php">Reportes de Proveedores</a>
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

    <div class="row">
        <div class="col-md-12" style="margin-left: 20px;">
            <h2 class=" mt-3">Mantenimiento de Empresas</h2>
            <hr class="mb-3">
        </div>
    </div>
    <div style="margin-left: 50px;">
        <div class="row">
            <form method="POST" action="" enctype="multipart/form-data" class="form-inline">
                <div class="col-md-3">

                    <select class="form-select" name="seleccion" required>
                        <option value="" selected>Usuario:</option>
                        <?php

                        include 'connect.php';
                        $consultacfdi = "SELECT * FROM usuarios";
                        $ejectuar = mysqli_query($con, $consultacfdi);


                        foreach ($ejectuar as $opciones) :

                        ?>

                            <option value="<?php echo $opciones['id']; ?>"><?php echo $opciones['username']; ?></option>
                        <?php endforeach ?>
                    </select>
                    <br>

                </div>
                <div class="col-md-3" style="margin-left: 28%; margin-top: -60px;">
                    <button type="submit" name="buscar" id="titulo-boton" class="btn">Buscar</button>
                </div>
            </form>
        </div>
    </div>

    <?php
    if (isset($_POST['buscar'])) {
        $seleccionusuario = $_REQUEST['seleccion'];
        $consultanombre = "SELECT username FROM usuarios WHERE id = '$seleccionusuario'";
        $ejectuarn = mysqli_query($con, $consultanombre);

    ?>
        <br>
        <div class="row">
            <div style="margin-left: 15px" class="col-md-2">

                <form method="POST" action="action.php" enctype="multipart/form-data" autocomplete="off">
                    <input type="text" name="metodo" value="1" hidden>
                    <input type="text" name="seleccion" value="<?php echo $seleccionusuario; ?>" hidden>
                    <div class="mb-3">
                        <label class="form-label">RFC</label>
                        <input type="text" class="form-control" name="rfc" value="Por Asignar">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Razón Social</label>
                        <input type="text" name="razon" class="form-control" value="Por Asignar">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Codigo Postal</label>
                        <input type="text" name="cp" class="form-control" value="Por Asignar">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña SAT</label>
                        <input type="text" name="pass" class="form-control" value="Por Asignar">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Uso de CFDI</label>
                        <select class="form-select" name="cfdi" required>

                            <?php


                            $consultacfdi = "SELECT * FROM cfdi";
                            $ejectuar = mysqli_query($con, $consultacfdi);
                            $consultaespecifica = "SELECT * FROM cfdi where id = '15'";
                            $qq = mysqli_query($con, $consultaespecifica);
                            $seleccionado = mysqli_fetch_array($qq)
                            ?>
                            <option value="<?php echo $seleccionado['id']; ?>" selected>
                                <?php echo $seleccionado['nombre']; ?>
                                <?php
                                foreach ($ejectuar as $opciones) :

                                ?>

                            <option value="<?php echo $opciones['id']; ?>"><?php echo $opciones['nombre']; ?></option>
                        <?php endforeach ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Regimen Fiscal</label>
                        <select class="form-select" name="regimen" required>
                            <option value="" selected>Seleccionar</option>
                            <?php


                            $consultareg = "SELECT * FROM regfiscal";
                            $ejectuar = mysqli_query($con, $consultareg);
                            $consultaespecifica = "SELECT * FROM regfiscal where id = '1'";
                            $qq = mysqli_query($con, $consultaespecifica);
                            $seleccionado = mysqli_fetch_array($qq)

                            ?>
                            <option value="<?php echo $seleccionado['id']; ?>" selected>
                                <?php echo $seleccionado['nombre']; ?>
                                <?php
                                foreach ($ejectuar as $opciones) :

                                ?>

                            <option value="<?php echo $opciones['id']; ?>"><?php echo $opciones['nombre']; ?></option>
                        <?php endforeach ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Plan</label>
                        <select class="form-select" name="plan" required>
                            <option value="" selected>Seleccionar</option>
                            <?php


                            $consultareg = "SELECT * FROM planes";
                            $ejectuar = mysqli_query($con, $consultareg);


                            ?>

                            <?php
                            foreach ($ejectuar as $opciones) :

                            ?>

                                <option value="<?php echo $opciones['id']; ?>"><?php echo $opciones['tipo']; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="d-grid gap-2 col-12 mx-auto">
                        <button type="submit" class="btn  btn btn-primary mt-3 mb-2">
                            Registrar Empresa por Usuario
                            <i class="bi bi-arrow-right-circle"></i>
                        </button>
                    </div>

                </form>
            </div>
            <?php
            $consulta = "SELECT empresas.id  as id, rfc, razon, cp, contraseñasat,contratacion,csf, cfdi.nombre as cfdi, regfiscal.nombre as reg, planes.tipo as plan FROM empresas INNER JOIN cfdi ON empresas.cfdi = cfdi.id INNER JOIN regfiscal ON empresas.regimen = regfiscal.id  INNER join planes ON empresas.plan = planes.id WHERE usuario = $seleccionusuario";
            $mishuevos = mysqli_query($con, $consulta);
            ?>


            <div class="col-md-9">
                <?php
                while ($row = mysqli_fetch_array($ejectuarn)) {
                    echo "<h3>Usuario Seleccionado: '" . $row[0] . "'</h3>";
                }
                ?>
                <table class="table table-bordered table-striped table-hover ">
                    <thead>
                        <tr id="tabla-head">
                            <th>#</th>
                            <th scope="col">RFC</th>
                            <th scope="col">Razon Social</th>
                            <th scope="col">CP</th>
                            <th scope="col">contraseña SAT</th>
                            <th scope="col">CFDI</th>
                            <th scope="col">Constancia</th>
                            <th scope="col">Regimen Fiscal</th>
                            <th scope="col">Plan</th>
                            <th scope="col">Contratacion</th>
                            <th scope="">Acciones de la empresa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $conteo = 1;
                        while ($dataUsuario = mysqli_fetch_array($mishuevos)) { ?>
                            <tr>
                                <td><?php echo  $conteo++ . ')'; ?></td>
                                <td><?php echo $dataUsuario['rfc']; ?></td>
                                <td><?php echo $dataUsuario['razon']; ?></td>
                                <td><?php echo $dataUsuario['cp']; ?></td>
                                <td><?php echo $dataUsuario['contraseñasat']; ?></td>
                                <td><?php echo $dataUsuario['cfdi']; ?></td>
                                <td><?php echo $dataUsuario['csf'] != null ?  'Si' : 'No'; ?></td>
                                <td><?php echo $dataUsuario['reg']; ?></td>
                                <td><?php echo $dataUsuario['plan']; ?></td>
                                <td><?php echo $dataUsuario['contratacion']; ?></td>
                                <td style="width: 450px;" class="text-center">

                                    <a href="editar.php?update=<?php echo $dataUsuario['id']; ?>" class="btn btn-info mb-2">
                                        <i class="bi bi-arrow-clockwise"></i> </a>
                                    <a href="action.php?id=<?php echo $dataUsuario['id']; ?>& metodo=3" class="btn btn-danger mb-2">
                                        <i class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                </table>


            </div>
        <?php
    }
        ?>
        </div>

</body>

</html>