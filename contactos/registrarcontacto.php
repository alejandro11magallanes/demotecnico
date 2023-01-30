<?php
include('connect.php');
$empresa  = (int) filter_var($_REQUEST['empresa'], FILTER_SANITIZE_NUMBER_INT);
$fila  = (int) filter_var($_REQUEST['filas'], FILTER_SANITIZE_NUMBER_INT);
$plan  = (int) filter_var($_REQUEST['plan'], FILTER_SANITIZE_NUMBER_INT);

if ($fila < $plan) {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $fechaActual = date('y-m-d');

    $insertContacto = ("INSERT INTO contactos(nombre,correo,empresa,fecha)VALUES(
'" . $nombre . "',
'" . $correo . "',
'" . $empresa . "',
'" . $fechaActual . "'
)");
    $resulInsert = mysqli_query($con, $insertContacto);
    header("Location:panel.php");
} else {
    echo "Ya no puedes registrtar contactos";
}