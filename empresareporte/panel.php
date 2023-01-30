<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="../img/icono.png" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/style.css" />
    <title>Reporte de RFC o Password</title>
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
                    <li style="margin-left: 30px" class="nav-item ">
                        <a class="nav-link " href="../inicioadmin.php">Usuarios</a>
                    </li>
                    <li style="margin-left: 30px" class="nav-item">
                        <a class="nav-link " href="../empresas/panel.php">Empresas</a>
                    </li>
                    <li style="margin-left: 30px" class="nav-item">
                        <a class="nav-link active" href="">Empresas para descarga</a>
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
                        <a class="nav-link" href="../reportes/panel.php">Reportes de Proveedpres</a>
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
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2 class=" mt-3">Reporte de Empresas para Descarga</h2>
                <hr class="mb-3">
            </div>
            <div class="col-md-6">

                <a href="descargaexcel.php"> <img src="../img/aaa.png" width="7%" style="margin-top: 20px;"></a>



            </div>
        </div>
    </div>

    <?php
    include('connect.php');
    $fechaActual = date('y-m-d');
    $consulta = "SELECT usuarios.username as user, usuarios.Contacto as contacto, empresas.rfc as rfc, empresas.passat as pass, empresas.fecha_csf as datess, empresas.razon as razon, empresas.modificacion as modificacion, datediff('2023-01-27', fecha_csf) as dias FROM empresas INNER JOIN usuarios ON empresas.usuario= usuarios.id WHERE fecha_csf IS NULL OR datediff('$fechaActual', fecha_csf) >=80";
    $ejecutar = mysqli_query($con, $consulta);

    ?>
    <div class="container mt-3">
        <div class="row">
            <table class="table table-bordered table-striped table-hover ">
                <thead>
                    <tr id="tabla-head">
                        <th>#</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">RFC</th>
                        <th scope="col">Razon Social</th>
                        <th scope="col">Contacto</th>
                        <th scope="col">Contraseña SAT</th>
                        <th scope="col">Fecha de Emision</th>
                        <th scope="col">Dias</th>
                        <th scope="col">CSF</th>
                        <th scope="col">Fecha de Modificacion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $conteo = 1;
                    while ($dataUsuario = mysqli_fetch_array($ejecutar)) {
                        $valor;
                        $icon;
                        if ($dataUsuario['dias'] == null) {
                            $valor = 0;
                            $icon = "<button class='btn btn-danger mb-2'><i
                            class='bi bi-file-earmark-excel'></i></button>";
                        } else {
                            $valor = $dataUsuario['dias'];
                            $icon = "<button class='btn btn-warning mb-2'><i
                            class='bi bi-file-earmark-break'></i></button>";
                        }
                        $date;
                        if ($dataUsuario['datess'] == null) {
                            $date = "No hay CSF";
                        } else {
                            $date = $dataUsuario['datess'];
                        }


                    ?>
                    <tr>
                        <td><?php echo  $conteo++ . ')'; ?></td>
                        <td><?php echo $dataUsuario['user']; ?></td>
                        <td><?php echo $dataUsuario['rfc']; ?></td>
                        <td><?php echo $dataUsuario['razon']; ?></td>
                        <td><?php echo $dataUsuario['contacto']; ?></td>
                        <td><?php echo $dataUsuario['pass']; ?></td>
                        <td><?php echo $date; ?></td>
                        <td><?php echo $valor; ?></td>
                        <td><?php echo $icon; ?></td>
                        <td><?php echo $dataUsuario['modificacion']; ?></td>
                    </tr>
                    <?php } ?>
            </table>
        </div>

</body>

</html>
</div>
</body>

</html>