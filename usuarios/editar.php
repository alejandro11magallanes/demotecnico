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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="shortcut icon" href="../img/icono.png" />
    <title>Editar Datos de Usuario</title>
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
            $sqlUsuario   = ("SELECT * FROM usuarios WHERE id='$idUsuario' LIMIT 1");
            $queryUsuario = mysqli_query($con, $sqlUsuario);
            $dataUsuario   = mysqli_fetch_array($queryUsuario);
            ?>

            <div class="col-md-5 mb-3">
                <h3 class="text-center">Datos del Usuario</h3>
                <form method="POST" action="action.php?metodo=2" enctype="multipart/form-data" autocomplete="off">
                    <input type="text" name="id" value="<?php echo $dataUsuario['id']; ?>" hidden>
                    <div class="mb-3">
                        <label class="form-label">Usuario</label>
                        <input type="text" class="form-control" name="username"
                            value="<?php echo $dataUsuario['username']; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="text" name="passw" class="form-control"
                            value="<?php echo $dataUsuario['password']; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Telefono</label>
                        <input type="text" name="telefono" class="form-control"
                            value="<?php echo $dataUsuario['telefono']; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Correo</label>
                        <input type="text" name="correo" class="form-control"
                            value="<?php echo $dataUsuario['correo']; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contacto</label>
                        <input type="text" name="contacto" class="form-control"
                            value="<?php echo $dataUsuario['Contacto']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="rol">Rol</label>
                        <select class="form-select" name="rol">
                            <?php
                            if ($dataUsuario['rol'] == "1") {
                                echo '<option value="1" selected>Administrador</option>';
                                echo '<option value="2">Normal</option>';
                            } else {
                                echo '<option value="2" selected>Normal</option>';
                                echo '<option value="1">Administrador</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="d-grid gap-2 col-12 mx-auto">
                        <button type="submit" class="btn  btn btn-primary mt-3 mb-2">
                            Actualizar datos del Usuario
                            <i class="bi bi-arrow-right-circle"></i>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>

</html>