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
    <title>Mantenimiento</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg" id="nav">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html">
                <img src="../img/logo.jpg" alt="Logo" width="100" height="100" class="d-inline-block align-text-top" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <h4>Dominio.com.mx</h4>
                    </li>
                    <li style="margin-left: 30px" class="nav-item">
                        <a class="nav-link" href="../usuarios/panel.php">EMPRESAS POR USUARIO</a>
                    </li>
                    <li style="margin-left: 30px" class="nav-item">
                        <a class="nav-link" href="../empresas/panel.php">EMPRESAS</a>
                    </li>
                </ul>
            </div>
            <div class="navbar-brand">
                <button class="btn btn-danger" onclick="location.href='login.php?cerrar_sesion=1'">
                    Cerrar Sesion
                </button>
            </div>
        </div>
    </nav>

    <div class="container mt-3">
        <div class="row justify-content-md-center">
            <div class="col-md-12">
                <h2 class="text-center mt-3">Mantenimiento de Usuarios</h2>
                <hr class="mb-3">
            </div>

            <div class="col-md-4 mb-3">
                <h3 class="text-center">Datos del Usuario</h3>
                <form method="POST" action="action.php" enctype="multipart/form-data">
                    <input type="text" name="metodo" value="1" hidden>
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="text" name="pass" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Telefono</label>
                        <input type="text" name="telefono" class="form-control" required maxlength="10">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Correo</label>
                        <input type="text" name="correo" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contacto</label>
                        <input type="text" name="contacto" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="Sexo">Rol</label>
                        <select class="form-select" name="rol" id="section" required>
                            <option value="">Asigne un rol</option>
                            <option value="1">Administrador</option>
                            <option value="2">Normal</option>
                        </select>
                    </div>

                    <div class="d-grid gap-2 col-12 mx-auto">
                        <button type="submit" class="btn  btn btn-primary mt-3 mb-2">
                            Registrar nuevo Usuario
                            <i class="bi bi-arrow-right-circle"></i>
                        </button>
                    </div>

                </form>
            </div>

            <?php
            include('connect.php');
            $sqlUsuarios   = ("SELECT * FROM usuarios ORDER BY id DESC");
            $queryUsuarios = mysqli_query($con, $sqlUsuarios);
            $totalUsuarios = mysqli_num_rows($queryUsuarios);
            ?>
            <div class="col-md-8">
                <h3 class="text-center">Usuarios Registrados <?php echo '(' . $totalUsuarios . ')'; ?></h3>
                <div class="row">
                    <div class="col-md-12 p-2">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover table-dark">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th scope="col">Usuario</th>
                                        <th scope="col">Contraseña</th>
                                        <th scope="col">Telefono</th>
                                        <th scope="col">Contacto</th>
                                        <th scope="col">Rol</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $conteo = 1;
                                    while ($dataUsuario = mysqli_fetch_array($queryUsuarios)) { ?>
                                    <tr>
                                        <td><?php echo  $conteo++ . ')'; ?></td>
                                        <td><?php echo $dataUsuario['username']; ?></td>
                                        <td><?php echo $dataUsuario['password']; ?></td>
                                        <td><?php echo $dataUsuario['telefono']; ?></td>
                                        <td><?php echo $dataUsuario['Contacto']; ?></td>
                                        <td><?php echo $dataUsuario['rol'] === '1' ?  'Administrador' : 'Normal' ?></td>
                                        <td>

                                            <a href="editar.php?id=<?php echo $dataUsuario['id']; ?>"
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
            </div>
        </div>
</body>

</html>