<?php

include('connect.php');

$idusuario = filter_var($_POST['usuario'], FILTER_SANITIZE_STRING);
$consulta = "SELECT * FROM empresas WHERE usuario = '$idusuario'";
$resulInsert = mysqli_query($con, $consulta);
header("Location:panel.php");