<?php

include_once 'conexion.php';

session_start();

// if (isset($_GET['cerrar_sesion'])) {
//     session_unset();
//     session_destroy();
// }
if (isset($_SESSION['rol'])) {
    switch ($_SESSION['rol']) {
        case 1:
            header("location: inicioadmin.php");
            break;
        case 2:
            header("location: inicio.php");
            break;
    }
}

if (isset($_POST['usuario']) && isset($_POST['pass'])) {
    $username = $_POST['usuario'];
    $password = $_POST['pass'];

    $db = new Database();
    $query = $db->connect()->prepare('SELECT * from usuarios WHERE username = :username AND password = :password');
    $query->execute([':username' => $username, ':password' => $password]);

    $row = $query->fetch(PDO::FETCH_NUM);
    if ($row == true) {
        $rol = $row[6];
        $nombre = $row[1];
        $id = $row[0];
        $_SESSION['rol'] = $rol;
        $_SESSION['nombre'] = $nombre;
        $_SESSION['id'] = $id;
        switch ($_SESSION['rol']) {
            case 1:
                header("location: inicioadmin.php");
                break;
            case 2:
                header("location: inicio.php");
                break;
        }
    } else {
?>
<script>
alert("usuario o contraseña incorrectos");
</script>
<?php

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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css" />
    <title>Login</title>
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
                    <li style="margin-left: 30px; font-size: 25px" class="nav-item">
                        <a class="nav-link" href="info.html">¿Qué es Preset?</a>
                    </li>
                    <li style="margin-left: 30px; font-size: 25px" class="nav-item">
                        <a class="nav-link" href="planes.html">Planes por Empresa</a>
                    </li>
                    <li style="margin-left: 30px; font-size: 25px" class="nav-item">
                        <a class="nav-link" href="funcion.html">Funcionalidad</a>
                    </li>
                    <li style="margin-left: 30px; font-size: 25px" class="nav-item">
                        <a class="nav-link" href="contacto.php">Contactanos</a>
                    </li>
                </ul>
            </div>
            <div class="navbar-brand">
                <button class="btn btn-danger" onclick="location.href='index.html'">
                    Volver
                </button>
            </div>
        </div>
    </nav>
    <br />
    <br>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <form action="#" method="POST" autocomplete="off">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Usuario:</label>
                        <input type="text" name="usuario" pattern="[A-Za-z0-9_-]{1,25}" class="form-control"
                            id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Contraseña:</label>
                        <input type="password" name="pass" class="form-control" pattern="[A-Za-z0-9_-]{1,25}"
                            id="exampleInputPassword1">
                    </div>
                    <div class="text-center">
                        <button type="submit" id="titulo-boton" class="btn ">Aceptar</button>
                    </div>
                    <br>
                    <div class="text-center">
                        <a href="">¿Olvidaste tu Contraseña?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>