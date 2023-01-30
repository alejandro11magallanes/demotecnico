<?php

include('connect.php');
$metodoAction  = (int) filter_var($_REQUEST['metodo'], FILTER_SANITIZE_NUMBER_INT);
if ($metodoAction == 2) {
    $idUsuario = (int) filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
    $rfc_change = filter_var($_REQUEST['rfc_cambio'], FILTER_SANITIZE_STRING);
    $pass_change = filter_var($_REQUEST['sat_cambio'], FILTER_SANITIZE_STRING);
    $fecha = date('Y-m-d');
    $fecha_csf = filter_var($_POST['fecha'], FILTER_SANITIZE_STRING);
    $rfc = filter_var($_POST['rfc'], FILTER_SANITIZE_STRING);
    $razon =  filter_var($_POST['razon'], FILTER_SANITIZE_STRING);
    $cp = filter_var($_POST['cp'], FILTER_SANITIZE_STRING);
    $pass = filter_var($_POST['sat'], FILTER_SANITIZE_STRING);
    $cfdi = filter_var($_POST['cfdi'], FILTER_SANITIZE_STRING);
    $regimen = filter_var($_POST['regimen'], FILTER_SANITIZE_STRING);
    $tmp_name = $_FILES['csf']['tmp_name'];

    if ($tmp_name == null) {
        if (strcmp($rfc, $rfc_change) !== 0 || strcmp($pass, $pass_change) !== 0) {
            $UpdateUsuario    = ("UPDATE empresas SET rfc='$rfc',razon='$razon', cp='$cp', passat='$pass',cfdi='$cfdi',regimen='$regimen', modificacion='$fecha' WHERE id='$idUsuario'");
            $resultadoUpdate = mysqli_query($con, $UpdateUsuario);
            header("Location:panel.php");
        } else {
            $UpdateUsuario    = ("UPDATE empresas SET rfc='$rfc',razon='$razon', cp='$cp', passat='$pass',cfdi='$cfdi',regimen='$regimen' WHERE id='$idUsuario'");
            $resultadoUpdate = mysqli_query($con, $UpdateUsuario);
            header("Location:panel.php");
        }
    } else {
        $contenido_pdf = file_get_contents($tmp_name);
        $pdf = addslashes($contenido_pdf);
        if (strcmp($rfc, $rfc_change) !== 0 || strcmp($pass, $pass_change) !== 0) {
            $UpdateUsuario    = ("UPDATE empresas SET rfc='$rfc',razon='$razon', cp='$cp', passat='$pass',cfdi='$cfdi',regimen='$regimen', modificacion='$fecha',  csf='$pdf', fecha_csf='$fecha_csf'  WHERE id='$idUsuario'");
            $resultadoUpdate = mysqli_query($con, $UpdateUsuario);
            header("Location:panel.php");
        } else {
            $UpdateUsuario    = ("UPDATE empresas SET rfc='$rfc',razon='$razon', cp='$cp', passat='$pass',cfdi='$cfdi',regimen='$regimen',  csf='$pdf', fecha_csf='$fecha_csf'  WHERE id='$idUsuario'");
            $resultadoUpdate = mysqli_query($con, $UpdateUsuario);
            header("Location:panel.php");
        }
    }




    // $UpdateUsuario    = ("UPDATE empresas SET rfc='$rfc',razon='$razon', cp='$cp',
    // passat='$pass',cfdi='$cfdi',regimen='$regimen', modificacion='$fecha'
    //     WHERE id='$idUsuario'");
    // $resultadoUpdate = mysqli_query($con, $UpdateUsuario);
    // header("Location:panel.php");
}