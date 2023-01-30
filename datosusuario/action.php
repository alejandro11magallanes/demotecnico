<?php

include('connect.php');
$metodoAction  = (int) filter_var($_REQUEST['metodo'], FILTER_SANITIZE_NUMBER_INT);

if ($metodoAction == 1) {
    $idUsuario      = (int) filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);

    $passw = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
    $contacto =  filter_var($_POST['contacto'], FILTER_SANITIZE_STRING);
    $telefono = filter_var($_POST['telefono'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);

    $UpdateUsuario    = ("UPDATE usuarios SET password='$passw',Contacto='$contacto', telefono='$telefono',
    correo='$email' WHERE id='$idUsuario'");
    $resultadoUpdate = mysqli_query($con, $UpdateUsuario);
    header("Location:../inicio.php");
}