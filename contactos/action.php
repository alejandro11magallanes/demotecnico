<?php
include('connect.php');
$metodoAction  = (int) filter_var($_REQUEST['metodo'], FILTER_SANITIZE_NUMBER_INT);

if ($metodoAction == 2) {
    $idUsuario      = (int) filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);

    $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
    $correo = filter_var($_POST['correo'], FILTER_SANITIZE_STRING);
    $fechaActual = date('y-m-d');


    $UpdateUsuario    = ("UPDATE contactos SET nombre='$nombre',correo='$correo', fecha='$fechaActual'
        WHERE id='$idUsuario' ");
    $resultadoUpdate = mysqli_query($con, $UpdateUsuario);
    header('Location:../inicio.php');
}

if ($metodoAction == 3) {
    $idUsuario  = (int) filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);

    $SqlDeleteUsuario = ("DELETE FROM contactos WHERE  id='$idUsuario'");
    $resultDeleteUsuario = mysqli_query($con, $SqlDeleteUsuario);


    header('Location:../inicio.php');
}