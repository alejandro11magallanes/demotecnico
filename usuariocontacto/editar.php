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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <title>Edicion de contacto</title>
</head>

<body>
    <div class="container mt-3">
        <div class="row justify-content-md-center">
            <div class="col-md-12">
                <h2 class="text-center mt-3">Actualizacion de datos de usuario</h2>
                <hr class="mb-3">
            </div>
            <?php
            include('connect.php');
            $idUsuario     = (int) filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
            $sqlUsuario   = ("SELECT * FROM contactos WHERE id='$idUsuario' LIMIT 1");
            $queryUsuario = mysqli_query($con, $sqlUsuario);
            $dataUsuario   = mysqli_fetch_array($queryUsuario);
            ?>

            <div class="col-md-5 mb-3">
                <h3 class="text-center">Datos del contacto</h3>
                <form method="POST" action="action.php?metodo=2" enctype="multipart/form-data">
                    <input type="text" name="id" value="<?php echo $dataUsuario['id']; ?>" hidden>
                    <div class="mb-3">
                        <label class="form-label">Empresa del Contacto</label>
                        <input type="text" class="form-control" name="empresa"
                            value="<?php echo $dataUsuario['contactos']; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nombre del Contacto</label>
                        <input type="text" class="form-control" name="nombre"
                            value="<?php echo $dataUsuario['nombre']; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Correo Electronico</label>
                        <input type="text" name="email" class="form-control"
                            value="<?php echo $dataUsuario['correo']; ?>">
                    </div>
                    <div class="d-grid gap-2 col-12 mx-auto">
                        <button type="submit" class="btn  btn btn-primary mt-3 mb-2">
                            Actualizar datos de la empresa
                            <i class="bi bi-arrow-right-circle"></i>
                        </button>
                    </div>

                </form>
            </div>
            <div class="col-md-2">
                <button onclick="location.href='panel.php'" class="btn btn-primary" type="submit"><i
                        class="bi bi-arrow-left-circle"></i></button>
            </div>
        </div>
    </div>
</body>

</html>