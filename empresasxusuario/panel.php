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
    <title>Contactos</title>
</head>

<body>
    <div class="container mt-3">
        <div class="row justify-content-md-center">
            <div class="col-md-12">
                <hr class="mb-3">
            </div>
            <div class="col-md-4 mb-3">
                <h3 class="text-center">Usuarios por empresa</h3>
            </div>
        </div>
        <h5>Selecciona un usuario para conocer las empresas registradas a su nombre</h5>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="usuario">Usuario</label>
                    <select class="form-select" name="usuario" required>
                        <option value="" selected>Seleccione un usuario</option>
                        <?php
                        include 'connect.php';

                        $consultaUsuario = "SELECT * FROM usuarios";
                        $ejectuar = mysqli_query($con, $consultaUsuario);


                        foreach ($ejectuar as $opciones) :

                        ?>

                        <option value="<?php echo $opciones['id']; ?>"><?php echo $opciones['username']; ?></option>
                        <?php endforeach ?>
                    </select>

                </div>
                <div class="d-grid gap-2 col-12 mx-auto">
                    <button type="submit" name="enviar" class="btn  btn btn-primary mt-3 mb-2">
                        Buscar
                    </button>
                </div>
            </div>

        </form>
    </div>
    <?php
    if (isset($_POST['enviar'])) {
        include('connect.php');
        $usuario = $_POST['usuario'];
        $sqlUsuarios   = ("SELECT * FROM empresas where usuario = '$usuario'");
        $queryUsuarios = mysqli_query($con, $sqlUsuarios);
        $totalUsuarios = mysqli_num_rows($queryUsuarios);
    ?>
    <div class="container mt-3">
        <div class="col-md-8">
            <h3 class="text-center">Empresas Registrados para ese usuario <?php echo '(' . $totalUsuarios . ')'; ?></h3>
            <div class="row">
                <div class="col-md-12 p-2">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover table-dark">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th scope="col">RFC</th>
                                    <th scope="col">Razon</th>
                                    <th scope="col">CP</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $conteo = 1;
                                    while ($dataUsuario = mysqli_fetch_array($queryUsuarios)) { ?>
                                <tr>
                                    <td><?php echo  $conteo++ . ')'; ?></td>
                                    <td><?php echo $dataUsuario['rfc']; ?></td>
                                    <td><?php echo $dataUsuario['razon']; ?></td>
                                    <td><?php echo $dataUsuario['cp']; ?></td>
                                </tr>
                                <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</body>

</html>