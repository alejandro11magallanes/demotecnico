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
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="shortcut icon" href="img/icono.png" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <title>Bienvenido</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg" id="nav">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html">
                <img src="img/logo1.png" alt="Logo" width="200" class="d-inline-block align-text-top" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li style="margin-left: 30px" class="nav-item">
                        <a class="nav-link active" href="empresas/panel.php">Perfil de Usuario</a>
                    </li>
                    <li style="margin-left: 30px" class="nav-item">
                        <a class="nav-link" href="empresasusuario/panel.php">Empresas</a>
                    </li>
                    <li style="margin-left: 30px" class="nav-item">
                        <a class="nav-link" href="usuariocontacto/panel.php">Proveedores</a>
                    </li>
                    <li style="margin-left: 30px" class="nav-item">
                        <a class="nav-link" href="clientes/panel.php">Clientes</a>
                    </li>
                </ul>
            </div>
            <div class="navbar-brand">
                <h4>Hola <?php echo $nombre; ?></h4>
            </div>
            <div class="navbar-brand">
                <button class="btn" id="cerrar-boton" onclick="location.href='logout.php'">
                    Cerrar Sesion
                </button>
            </div>
        </div>
    </nav>
    <div class="container">
        <h2>Perfil del usuario</h2>
        <?php
        include('connect.php');
        $sqlUsuarios   = ("SELECT username, password, telefono,Contacto, correo, empresas.id as constancia FROM usuarios INNER JOIN empresas on empresas.usuario = usuarios.id WHERE  usuarios.id='$id'");
        $queryUsuarios = mysqli_query($con, $sqlUsuarios);
        $dataCdfi   = mysqli_fetch_array($queryUsuarios);
        ?>
        <div class="col-md-6" style="margin-left: 300px;">
            <form action="datosusuario/action.php" method="post" enctype="multipart/form-data" autocomplete="off">
                <input type="text" name="metodo" value="1" hidden>
                <input type="text" name="id" value="<?php echo $id; ?>" hidden>
                <div class="mb-3">
                    <label class="form-label">Usuario: <?php echo $dataCdfi['username'] ?></label>
                </div>
                <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <input type="text" name="pass" class="form-control" required
                        value="<?php echo $dataCdfi['password']; ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Contacto</label>
                    <input type="text" name="contacto" class="form-control" required
                        value="<?php echo $dataCdfi['Contacto']; ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Telefono</label>
                    <input type="text" name="telefono" class="form-control" required
                        value="<?php echo $dataCdfi['telefono']; ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Correo Electronico</label>
                    <input type="text" name="email" class="form-control" required
                        value="<?php echo $dataCdfi['correo']; ?>">
                </div>
                <div class="d-grid gap-2 col-12 mx-auto">
                    <button type="button" onclick="location.href='ver.php?id=<?php echo $dataCdfi['constancia']; ?>'"
                        class="btn  btn btn-primary mt-3 mb-2">
                        Descargar Constancia de Situación Fiscal

                    </button>
                </div>
                <div class="d-grid gap-2 col-12 mx-auto">
                    <button type="submit" class="btn  btn btn-primary mt-3 mb-2">
                        Cambiar Datos
                        <i class="bi bi-arrow-right-circle"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>