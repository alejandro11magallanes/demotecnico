<?php

use function PHPSTORM_META\elementType;

session_start();
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
    <title>Contactos</title>
</head>

<body>
    <div class="container mt-3">
        <div class="row justify-content-md-center">
            <div class="col-md-12">

                <hr class="mb-3">
            </div>
            <div class="col-md-4 mb-3">
                <h3 class="text-center">Lista de Contactos</h3>
            </div>
        </div>
        <?php

        include 'connect.php';
        $idEmpresa     = (int) filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
        $valorplan =  filter_var($_REQUEST['plan'], FILTER_SANITIZE_STRING);
        $consultaUsuario = "SELECT * FROM contactos WHERE empresa = '$idEmpresa'";
        $ejectuar = mysqli_query($con, $consultaUsuario);
        $totalContactos = mysqli_num_rows($ejectuar);
        $result = mysqli_affected_rows($con)

        ?>
        <?php
        if ($valorplan == 'A') {
            $valor = 10;
        } else {
            $valor = 50;
        }

        ?>

        <h3 class="text-center">Contactos Registrados <?php echo '(' . $totalContactos . ')'; ?></h3>
        <div class="row">
            <div class="col-md-12 p-2">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover table-dark">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th scope="col">Folio</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Correo</th>
                                <th class="text-center" scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $conteo = 1;
                            while ($dataUsuario = mysqli_fetch_array($ejectuar)) { ?>
                            <tr>
                                <td><?php echo  $conteo++ . ')'; ?></td>
                                <td><?php echo $dataUsuario['id']; ?></td>
                                <td><?php echo $dataUsuario['nombre']; ?></td>
                                <td><?php echo $dataUsuario['correo']; ?></td>
                                <td class="text-center">

                                    <a href="editarcontacto.php?id=<?php echo $dataUsuario['id']; ?>"
                                        class="btn btn-info mb-2">
                                        <i class="bi bi-arrow-clockwise"></i> </a>
                                    <a href="action.php?id=<?php echo $dataUsuario['id']; ?>& metodo=3"
                                        class="btn btn-danger mb-2">
                                        <i class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                            <?php } ?>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 p-2">
                <h3 class="text-center">Agregar Contacto</h3>
            </div>
            <div class="col-md-4 offset-md-4">
                <form class="form-inline" method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group mb-2">
                        <label class="sr-only">Nombre</label>
                        <input type="text" class="form-control" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Correo</label>
                        <input type="text" name="correo" class="form-control" required>
                    </div>
                    <div class="d-grid gap-2 col-12 mx-auto">
                        <button type="submit" name="contacto" class="btn  btn btn-primary mt-3 mb-2">
                            Registrar nuevo Contacto
                            <i class="bi bi-arrow-right-circle"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<?php
if (isset($_POST['contacto'])) {
    if ($result < $valor) {
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $fechaActual = date('y-m-d');

        $insertContacto = ("INSERT INTO contactos(nombre,correo,empresa,fecha)VALUES(
    '" . $nombre . "',
    '" . $correo . "',
    '" . $idEmpresa . "',
    '" . $fechaActual . "'
    )");
        $resulInsert = mysqli_query($con, $insertContacto);
    } else {
        echo "Ya no puedes registrtar contactos";
    }
    header('Location:../inicio.php');
}
?>

</html>