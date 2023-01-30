<?php
$usuario  = "adm122022_admin";
$password = "admin1212!";
$servidor = "localhost";
$basededatos = "adm122022_preset";
$con = mysqli_connect($servidor, $usuario, $password) or die("No se ha podido conectar al Servidor");
$db = mysqli_select_db($con, $basededatos) or die("Upps! Error en conectar a la Base de Datos");