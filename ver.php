<?php
$id = $_REQUEST['id'];
include 'connect.php';
$query = "SELECT * FROM empresas WHERE id='$id'";
$resul = mysqli_query($con, $query);

header("Content-type: application/pdf");
header("Content-Disposition: inline; filename=constancia");

while ($dataUsuario = mysqli_fetch_array($resul)) {
    echo $dataUsuario['csf'];
}