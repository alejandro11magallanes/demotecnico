<?php
include('connect.php');
$metodoAction  = (int) filter_var($_REQUEST['metodo'], FILTER_SANITIZE_NUMBER_INT);
if ($metodoAction == 1) {
    $idusuario = filter_var($_POST['seleccion'], FILTER_SANITIZE_STRING);
    $rfc =  filter_var($_POST['rfc'], FILTER_SANITIZE_STRING);
    $razon = filter_var($_POST['razon'], FILTER_SANITIZE_STRING);
    $cp = filter_var($_POST['cp'], FILTER_SANITIZE_STRING);
    $contasat = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
    $cfdi = filter_var($_POST['cfdi'], FILTER_SANITIZE_STRING);
    $regimen = filter_var($_POST['regimen'], FILTER_SANITIZE_STRING);
    $plan = filter_var($_POST['plan'], FILTER_SANITIZE_STRING);
    $fechaActual = date('y-m-d');

    $insertUsuario = ("INSERT INTO empresas(rfc,razon,cp,passat,cfdi,regimen,plan,usuario, contratacion, modificacion)VALUES(
    '" . $rfc . "',
    '" . $razon . "',
    '" . $cp . "',
    '" . $contasat . "',
    '" . $cfdi . "',
    '" . $regimen . "',
    '" . $plan . "',
    '" . $idusuario . "',
    '" . $fechaActual . "',
    '" . $fechaActual . "'
)");
    $resulInsert = mysqli_query($con, $insertUsuario);
    if ($plan == "1") {
        $valor = 5;
    } elseif ($plan == "2") {
        $valor = 10;
    } elseif ($plan == "3") {
        $valor = 15;
    } else {
        $valor = 20;
    }
    mt_srand(time());
    $ultimaempresa = "SELECT id from empresas ORDER BY id DESC LIMIT 1";
    $newres = mysqli_query($con, $ultimaempresa);

    while ($row = mysqli_fetch_array($newres)) {

        for ($i = 0; $i < $valor; $i++) {

            //generamos un número aleatorio

            $contacto = "INSERT INTO contactos (nombre,correo,empresa,fecha) VALUES ('Por asignar','Por Asignar','" . $row[0] . "','" . $fechaActual . "')";
            $Insert = mysqli_query($con, $contacto);
            $numero_aleatorio = mt_rand(1000, 9999);
            $clientes = "INSERT INTO clientes (empresa_cli,contacto,correo,fecha_actualizacion,nip,empresa) VALUES ('Por asignar','Por Asignar','Por Asignar','" . $fechaActual . "','" . $numero_aleatorio . "','" . $row[0] . "')";
            $Insert = mysqli_query($con, $clientes);
            $numero_aleatorio = 0;
        }
    }




    header("Location:panel.php");
}

if ($metodoAction == 3) {
    $idUsuario  = (int) filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);

    $SqlDeleteUsuario = ("DELETE FROM empresas WHERE  id='$idUsuario'");
    $resultDeleteUsuario = mysqli_query($con, $SqlDeleteUsuario);


    header("Location:panel.php");
}

if ($metodoAction == 2) {
    $idUsuario      = (int) filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
    $actual = (int) filter_var($_REQUEST['actual'], FILTER_SANITIZE_NUMBER_INT);
    $fecha_csf = filter_var($_POST['fecha'], FILTER_SANITIZE_STRING);
    $rfc = filter_var($_POST['rfc'], FILTER_SANITIZE_STRING);
    $razon =  filter_var($_POST['razon'], FILTER_SANITIZE_STRING);
    $cp = filter_var($_POST['cp'], FILTER_SANITIZE_STRING);
    $pass = filter_var($_POST['sat'], FILTER_SANITIZE_STRING);
    $cfdi = filter_var($_POST['cfdi'], FILTER_SANITIZE_STRING);
    $regimen = filter_var($_POST['regimen'], FILTER_SANITIZE_STRING);
    $plan = filter_var($_POST['plan'], FILTER_SANITIZE_STRING);
    $fechaActual = date('y-m-d');
    $tmp_name = $_FILES['csf']['tmp_name'];


    if ($tmp_name == null) {

        if ($actual == $plan) {
            echo " Son los mismos solo actualizo datos sin modificar contactos";
            $UpdateUsuario    = ("UPDATE empresas SET rfc='$rfc',razon='$razon', cp='$cp',
        passat='$pass',cfdi='$cfdi',regimen='$regimen', modificacion='$fechaActual', fecha_csf='$fecha_csf' 
            WHERE id='$idUsuario'");
            $resultadoUpdate = mysqli_query($con, $UpdateUsuario);
        } else if ($actual == 1 and $plan == 2) {
            $consulta_contactos = "SELECT * FROM contactos WHERE empresa ='$idUsuario'";
            $resultado_contactos = mysqli_query($con, $consulta_contactos);
            $contactos_to_empresa = mysqli_affected_rows($con);
            for ($i = $contactos_to_empresa; $i < 50; $i++) {
                $contacto = "INSERT INTO contactos (nombre,correo,empresa,fecha) VALUES ('Por asignar','Por Asignar','" . $idUsuario . "','" . $fechaActual . "')";
                $Insert = mysqli_query($con, $contacto);
            }
            $UpdateUsuario    = ("UPDATE empresas SET rfc='$rfc',razon='$razon', cp='$cp',
        passat='$pass',cfdi='$cfdi',regimen='$regimen',plan='$plan', modificacion='$fechaActual'
            WHERE id='$idUsuario'");
            $resultadoUpdate = mysqli_query($con, $UpdateUsuario);
        } else if ($actual == 1 and $plan == 3) {
            $consulta_contactos = "SELECT * FROM contactos WHERE empresa ='$idUsuario'";
            $resultado_contactos = mysqli_query($con, $consulta_contactos);
            $contactos_to_empresa = mysqli_affected_rows($con);
            for ($i = $contactos_to_empresa; $i < 100; $i++) {
                $contacto = "INSERT INTO contactos (nombre,correo,empresa,fecha) VALUES ('Por asignar','Por Asignar','" . $idUsuario . "','" . $fechaActual . "')";
                $Insert = mysqli_query($con, $contacto);
            }
            $UpdateUsuario    = ("UPDATE empresas SET rfc='$rfc',razon='$razon', cp='$cp',
        passat='$pass',cfdi='$cfdi',regimen='$regimen',plan='$plan', modificacion='$fechaActual'
            WHERE id='$idUsuario'");
            $resultadoUpdate = mysqli_query($con, $UpdateUsuario);
        } else if ($actual == 1 and $plan == 4) {
            $consulta_contactos = "SELECT * FROM contactos WHERE empresa ='$idUsuario'";
            $resultado_contactos = mysqli_query($con, $consulta_contactos);
            $contactos_to_empresa = mysqli_affected_rows($con);
            for ($i = $contactos_to_empresa; $i < 200; $i++) {
                $contacto = "INSERT INTO contactos (nombre,correo,empresa,fecha) VALUES ('Por asignar','Por Asignar','" . $idUsuario . "','" . $fechaActual . "')";
                $Insert = mysqli_query($con, $contacto);
            }
            $UpdateUsuario    = ("UPDATE empresas SET rfc='$rfc',razon='$razon', cp='$cp',
        passat='$pass',cfdi='$cfdi',regimen='$regimen',plan='$plan', modificacion='$fechaActual'
            WHERE id='$idUsuario'");
            $resultadoUpdate = mysqli_query($con, $UpdateUsuario);
        } else if ($actual == 2 and $plan == 3) {
            $consulta_contactos = "SELECT * FROM contactos WHERE empresa ='$idUsuario'";
            $resultado_contactos = mysqli_query($con, $consulta_contactos);
            $contactos_to_empresa = mysqli_affected_rows($con);
            for ($i = $contactos_to_empresa; $i < 100; $i++) {
                $contacto = "INSERT INTO contactos (nombre,correo,empresa,fecha) VALUES ('Por asignar','Por Asignar','" . $idUsuario . "','" . $fechaActual . "')";
                $Insert = mysqli_query($con, $contacto);
            }
            $UpdateUsuario    = ("UPDATE empresas SET rfc='$rfc',razon='$razon', cp='$cp',
        passat='$pass',cfdi='$cfdi',regimen='$regimen',plan='$plan', modificacion='$fechaActual'
            WHERE id='$idUsuario'");
            $resultadoUpdate = mysqli_query($con, $UpdateUsuario);
        } else if ($actual == 2 and $plan == 4) {
            $consulta_contactos = "SELECT * FROM contactos WHERE empresa ='$idUsuario'";
            $resultado_contactos = mysqli_query($con, $consulta_contactos);
            $contactos_to_empresa = mysqli_affected_rows($con);
            for ($i = $contactos_to_empresa; $i < 200; $i++) {
                $contacto = "INSERT INTO contactos (nombre,correo,empresa,fecha) VALUES ('Por asignar','Por Asignar','" . $idUsuario . "','" . $fechaActual . "')";
                $Insert = mysqli_query($con, $contacto);
            }
            $UpdateUsuario    = ("UPDATE empresas SET rfc='$rfc',razon='$razon', cp='$cp',
        passat='$pass',cfdi='$cfdi',regimen='$regimen',plan='$plan', modificacion='$fechaActual'
            WHERE id='$idUsuario'");
            $resultadoUpdate = mysqli_query($con, $UpdateUsuario);
        } else if ($actual == 3 and $plan == 4) {
            $consulta_contactos = "SELECT * FROM contactos WHERE empresa ='$idUsuario'";
            $resultado_contactos = mysqli_query($con, $consulta_contactos);
            $contactos_to_empresa = mysqli_affected_rows($con);
            for ($i = $contactos_to_empresa; $i < 200; $i++) {
                $contacto = "INSERT INTO contactos (nombre,correo,empresa,fecha) VALUES ('Por asignar','Por Asignar','" . $idUsuario . "','" . $fechaActual . "')";
                $Insert = mysqli_query($con, $contacto);
            }
            $UpdateUsuario    = ("UPDATE empresas SET rfc='$rfc',razon='$razon', cp='$cp',
        passat='$pass',cfdi='$cfdi',regimen='$regimen',plan='$plan', modificacion='$fechaActual'
            WHERE id='$idUsuario'");
            $resultadoUpdate = mysqli_query($con, $UpdateUsuario);
        }
    } else {
        $contenido_pdf = file_get_contents($tmp_name);
        $pdf = addslashes($contenido_pdf);
        $UpdateUsuario    = ("UPDATE empresas SET rfc='$rfc',razon='$razon', cp='$cp',
        passat='$pass',cfdi='$cfdi',regimen='$regimen', modificacion='$fechaActual', csf='$pdf', fecha_csf='$fecha_csf' 
            WHERE id='$idUsuario'");
        $resultadoUpdate = mysqli_query($con, $UpdateUsuario);
    }

    header("Location:panel.php");
}