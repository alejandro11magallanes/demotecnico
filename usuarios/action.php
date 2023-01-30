<?php
include('connect.php');
$metodoAction  = (int) filter_var($_REQUEST['metodo'], FILTER_SANITIZE_NUMBER_INT);

if ($metodoAction == 1) {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
    $telefono = filter_var($_POST['telefono'], FILTER_SANITIZE_STRING);
    $correo = filter_var($_POST['correo'], FILTER_SANITIZE_STRING);
    $contacto = filter_var($_POST['contacto'], FILTER_SANITIZE_STRING);
    $rol = filter_var($_POST['rol'], FILTER_SANITIZE_STRING);

    $insertUsuario = ("INSERT INTO usuarios(username,password,telefono,correo,Contacto,rol)VALUES(
        '" . $username . "',
        '" . $password . "',
        '" . $telefono . "',
        '" . $correo . "',
        '" . $contacto . "',
        '" . $rol . "'
    )");
    $resulInsert = mysqli_query($con, $insertUsuario);
    header("Location:../inicioadmin.php");
}


if ($metodoAction == 2) {
    $idUsuario      = (int) filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);

    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password =  filter_var($_POST['passw'], FILTER_SANITIZE_STRING);
    $telefono = filter_var($_POST['telefono'], FILTER_SANITIZE_STRING);
    $correo = filter_var($_POST['correo'], FILTER_SANITIZE_STRING);
    $contacto = filter_var($_POST['contacto'], FILTER_SANITIZE_STRING);
    $rol = filter_var($_POST['rol'], FILTER_SANITIZE_STRING);

    $Updateuser   = ("UPDATE usuarios SET username='$username',password='$password', telefono='$telefono',
    correo='$correo', Contacto='$contacto', rol='$rol'
        WHERE id='$idUsuario' ");
    $resultadoUpdate = mysqli_query($con, $Updateuser);
    header("Location:../inicioadmin.php");
}



//Eliminar Usuario
if ($metodoAction == 3) {
    $idUsuario  = (int) filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);

    $SqlDeleteUsuario = ("DELETE FROM usuarios WHERE  id='$idUsuario'");
    $resultDeleteUsuario = mysqli_query($con, $SqlDeleteUsuario);


    header("Location:../inicioadmin.php");
}

if ($metodoAction == 4) {
    $idUsuario      = (int) filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);

    $rfc = filter_var($_POST['rfc'], FILTER_SANITIZE_STRING);
    $razon =  filter_var($_POST['razon'], FILTER_SANITIZE_STRING);
    $cp = filter_var($_POST['cp'], FILTER_SANITIZE_STRING);
    $pass = filter_var($_POST['sat'], FILTER_SANITIZE_STRING);
    $cfdi = filter_var($_POST['cfdi'], FILTER_SANITIZE_STRING);
    $regimen = filter_var($_POST['regimen'], FILTER_SANITIZE_STRING);

    $UpdateUsuario    = ("UPDATE empresas SET rfc='$rfc',razon='$razon', cp='$cp',
    contraseñasat='$pass',cfdi='$cfdi',regimen='$regimen'
        WHERE id='$idUsuario'");
    $resultadoUpdate = mysqli_query($con, $UpdateUsuario);
    header("Location:../inicio.php");
}