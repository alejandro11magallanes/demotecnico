<?php

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <title>Editar Datos del Cliente</title>
</head>

<body>
    <div class="container mt-3">
        <div class="row justify-content-md-center">
            <div class="col-md-12">
                <h2 class="text-center mt-3">Actualizacion de datos del Cliente</h2>
                <hr class="mb-3">
            </div>
            <?php
            include('connect.php');
            $idUsuario     = (int) filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
            $sqlUsuario   = ("SELECT * FROM clientes WHERE id='$idUsuario' LIMIT 1");
            $queryUsuario = mysqli_query($con, $sqlUsuario);
            $dataUsuario   = mysqli_fetch_array($queryUsuario);
            ?>

            <div class="col-md-5 mb-3">
                <h3 class="text-center">Empresa del Contacto</h3>
                <form method="POST" action="action.php" enctype="multipart/form-data">
                    <input type="text" name="id" value="<?php echo $dataUsuario['id']; ?>" hidden>
                    <div class="mb-3">
                        <label class="form-label">Empresa del Cliente</label>
                        <input type="text" class="form-control" name="empresa"
                            value="<?php echo $dataUsuario['empresa_cli']; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nombre del Contacto</label>
                        <input type="text" class="form-control" name="nombre"
                            value="<?php echo $dataUsuario['contacto']; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Correo Electronico</label>
                        <input type="text" name="correo" class="form-control"
                            value="<?php echo $dataUsuario['correo']; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Agrega la CSF de la empresa</label>
                        <input class="form-control" type="file" name="csf">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha de emision de Constancia</label>
                        <input type="date" id="start" name="fecha" value="<?php echo $dataUsuario['fecha_csf']; ?>"
                            min="2022-01-01" max="2040-12-31">
                    </div>

                    <div class="d-grid gap-2 col-12 mx-auto">
                        <button type="submit" class="btn  btn btn-primary mt-3 mb-2">
                            Actualizar datos de la empresa
                            <i class="bi bi-arrow-right-circle"></i>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>

</html>