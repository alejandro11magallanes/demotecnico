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
    <title>Editar Datos de Empresa</title>
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
            $sqlUsuario   = ("SELECT * FROM empresas WHERE id='$idUsuario' LIMIT 1");
            $queryUsuario = mysqli_query($con, $sqlUsuario);
            $dataUsuario   = mysqli_fetch_array($queryUsuario);
            $valor = "";
            if ($dataUsuario['plan'] == 1) {
                $valor = "Piloto";
            } elseif ($dataUsuario['plan'] == 2) {
                $valor = "Basico";
            } elseif ($dataUsuario['plan'] == 3) {
                $valor = "Medio";
            } else {
                $valor = "Premium";
            }
            ?>

            <div class="col-md-5 mb-3">
                <h3 class="text-center">Datos de la empresa</h3>
                <form method="POST" action="action.php?metodo=2" enctype="multipart/form-data">
                    <input type="text" name="id" value="<?php echo $dataUsuario['id']; ?>" hidden>
                    <div class="mb-3">
                        <label class="form-label">RFC</label>
                        <input type="text" class="form-control" name="rfc" value="<?php echo $dataUsuario['rfc']; ?>">
                        <input type="hidden" class="form-control" name="rfc_cambio"
                            value="<?php echo $dataUsuario['rfc']; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Razon Social</label>
                        <input type="text" name="razon" class="form-control"
                            value="<?php echo $dataUsuario['razon']; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Codigo Postal</label>
                        <input type="text" name="cp" class="form-control" value="<?php echo $dataUsuario['cp']; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña en el sat</label>
                        <input type="text" name="sat" class="form-control"
                            value="<?php echo $dataUsuario['passat']; ?>">
                        <input type="hidden" name="sat_cambio" class="form-control"
                            value="<?php echo $dataUsuario['passat']; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Uso del CFDI</label>
                        <select class="form-select" name="cfdi" required>
                            <?php


                            include 'connect.php';
                            $idcdfi = $dataUsuario['cfdi'];
                            $consultaCdfi = "SELECT * FROM cfdi WHERE id = '$idcdfi'";
                            $consultaUsuario = "SELECT * FROM cfdi";
                            $ejectuar = mysqli_query($con, $consultaUsuario);
                            $querycfdi = mysqli_query($con, $consultaCdfi);
                            $dataCdfi   = mysqli_fetch_array($querycfdi);


                            ?>
                            <option value="<?php echo $dataCdfi['id']; ?>" selected><?php echo $dataCdfi['nombre']; ?>
                                <?php

                                foreach ($ejectuar as $opciones) :

                                ?>

                            <option value="<?php echo $opciones['id']; ?>"><?php echo $opciones['nombre']; ?>
                            </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Regimen Fiscal</label>
                        <select class="form-select" name="regimen" required>
                            <?php


                            include 'connect.php';
                            $reg = $dataUsuario['regimen'];
                            $consultaCdfi = "SELECT * FROM regfiscal WHERE id = '$reg'";
                            $consultaUsuario = "SELECT * FROM regfiscal";
                            $ejectuar = mysqli_query($con, $consultaUsuario);
                            $querycfdi = mysqli_query($con, $consultaCdfi);
                            $dataCdfi   = mysqli_fetch_array($querycfdi);


                            ?>
                            <option value="<?php echo $dataCdfi['id']; ?>" selected><?php echo $dataCdfi['nombre']; ?>
                                <?php

                                foreach ($ejectuar as $opciones) :

                                ?>

                            <option value="<?php echo $opciones['id']; ?>"><?php echo $opciones['nombre']; ?>
                            </option>
                            <?php endforeach ?>
                        </select>

                    </div>
                    <div class="mb-3">
                        <label class="form-label">Plan:
                            <?php echo $valor; ?></label>

                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha de emision de la CSF</label>
                        <input type="date" id="start" name="fecha" min="2022-01-01" max="2040-12-31">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Agrega la CSF de la empresa</label>
                        <input class="form-control" type="file" name="csf">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha de contratacion:
                            <?php echo $dataUsuario['contratacion']; ?></label>
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