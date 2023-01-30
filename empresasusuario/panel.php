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
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="../img/icono.png" />
    <link rel="stylesheet" href="../css/style.css" />
    <title>Tus empresas</title>
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
                        <a class="nav-link active" href="">Empresas</a>
                    </li>
                    <li style="margin-left: 30px" class="nav-item">
                        <a class="nav-link" href="../usuariocontacto/panel.php">Contactos</a>
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

    <?php
    include('connect.php');
    $sqlUsuarios   = ("SELECT empresas.id as id, rfc, razon, cp, cfdi.nombre as cfdi, regfiscal.nombre as regimen, planes.tipo as plan, contratacion, modificacion, csf FROM empresas INNER JOIN cfdi ON empresas.cfdi = cfdi.id INNER JOIN regfiscal ON empresas.regimen = regfiscal.id INNER JOIN planes on empresas.plan = planes.id WHERE  usuario='$id'");
    $queryUsuarios = mysqli_query($con, $sqlUsuarios);
    ?>
    <div class="row">

        <table class="table table-bordered table-striped table-hover ">
            <thead>
                <tr id="tabla-head">
                    <th>#</th>
                    <th scope="col">RFC</th>
                    <th scope="col">Razón Social</th>
                    <th scope="col">CP</th>
                    <th scope="col">Uso de CFDI</th>
                    <th scope="col">Regimen Fiscal</th>
                    <th scope="col">CSF</th>
                    <th scope="col">Emisión</th>
                    <th scope="col">Plan</th>
                    <th scope="col">Contactos</th>
                    <th scope="col">Contratacion</th>
                    <th scope="col">Descarga</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $conteo = 1;
                while ($dataUsuario = mysqli_fetch_array($queryUsuarios)) {
                    $valor = "";
                    if ($dataUsuario['plan'] == "Piloto") {
                        $valor = "5";
                    } elseif ($dataUsuario['plan'] == "") {
                        $valor = "50";
                    } elseif ($dataUsuario['plan'] == "Medio") {
                        $valor = "100";
                    } else {
                        $valor = "200";
                    }


                ?>
                <tr>
                    <td><?php echo  $conteo++ . ')'; ?></td>
                    <td><?php echo $dataUsuario['rfc']; ?></td>
                    <td><?php echo $dataUsuario['razon']; ?></td>
                    <td><?php echo $dataUsuario['cp']; ?></td>
                    <td><?php echo $dataUsuario['cfdi']; ?></td>
                    <td><?php echo $dataUsuario['regimen']; ?></td>
                    <td><?php echo $dataUsuario['csf'] != null ?  'Si' : 'No'; ?></td>
                    <td><?php echo "por definir"; ?></td>
                    <td><?php echo $dataUsuario['plan']; ?></td>
                    <td><?php echo $valor; ?></td>
                    <td><?php echo $dataUsuario['contratacion']; ?></td>
                    <td class="text-center"> <a href="../ver.php?id=<?php echo $dataUsuario['id']; ?>"
                            class="btn btn-info mb-2">

                            <i class="bi bi-file-earmark-arrow-down"></i>
                        </a></td>
                    <td class="text-center">

                        <a href="editar.php?id=<?php echo $dataUsuario['id']; ?>" class="btn btn-info mb-2">
                            <i class="bi bi-arrow-clockwise"></i> Actualizar</a>
                    </td>
                </tr>
                <?php } ?>
        </table>

    </div>

</body>

</html>