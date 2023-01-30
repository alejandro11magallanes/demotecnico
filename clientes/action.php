<?php

include('connect.php');
$idUsuario      = (int) filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);


$empresa = filter_var($_POST['empresa'], FILTER_SANITIZE_STRING);
$nombre =  filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
$correo = filter_var($_POST['correo'], FILTER_SANITIZE_STRING);
$fecha_csf = filter_var($_POST['fecha'], FILTER_SANITIZE_STRING);
$fechaActual = date('y-m-d');
$tmp_name = $_FILES['csf']['tmp_name'];
if ($tmp_name == null) {
    echo "no hay pdf";
    $UpdateUsuario    = ("UPDATE clientes SET empresa_cli='$empresa',contacto='$nombre', correo='$correo',
        fecha_actualizacion='$fechaActual',fecha_csf='$fecha_csf' WHERE id='$idUsuario'");
    $resultadoUpdate = mysqli_query($con, $UpdateUsuario);
} else {
    $contenido_pdf = file_get_contents($tmp_name);
    $pdf = addslashes($contenido_pdf);
    $UpdateUsuario    = ("UPDATE clientes SET empresa_cli='$empresa',contacto='$nombre', correo='$correo',
        fecha_actualizacion='$fechaActual',pdf_csf='$pdf',fecha_csf='$fecha_csf' WHERE id='$idUsuario'");
    $resultadoUpdate = mysqli_query($con, $UpdateUsuario);
}





header("Location:panel.php");