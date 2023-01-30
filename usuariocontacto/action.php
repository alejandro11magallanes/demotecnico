<?php

include('connect.php');
$metodoAction  = (int) filter_var($_REQUEST['metodo'], FILTER_SANITIZE_NUMBER_INT);
if ($metodoAction == 2) {
    $idUsuario      = (int) filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);

    $empresa = filter_var($_POST['empresa'], FILTER_SANITIZE_STRING);
    $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
    $correo =  filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $fecha = date('y-m-d');


    $UpdateUsuario    = ("UPDATE contactos SET contactos='$empresa',nombre='$nombre',correo='$correo', fecha='$fecha' WHERE id='$idUsuario'");
    $resultadoUpdate = mysqli_query($con, $UpdateUsuario);
    header("Location:panel.php");
}