<?php
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=reporte.xls");
include('connect.php');
$fecha = $_REQUEST['id'];
$requerido = $_REQUEST['user'];
if ($requerido == "todos") {
    $consulta = "SELECT usuarios.username as user, usuarios.Contacto as contacto, empresas.rfc as rfc,empresas.passat as pass ,empresas.modificacion as datess FROM empresas, usuarios WHERE empresas.usuario = usuarios.id AND empresas.modificacion >= '$fecha'";
} else {
    $consulta = "SELECT usuarios.username as user, usuarios.Contacto as contacto, empresas.rfc as rfc,empresas.passat as pass ,empresas.modificacion as datess FROM empresas, usuarios WHERE empresas.usuario = usuarios.id AND usuarios.id = '$requerido' AND empresas.modificacion >= '$fecha'";
}
$ejectuar = mysqli_query($con, $consulta);

?>
<table class="table table-bordered table-striped table-hover">
    <thead>
        <tr id="tabla-head">
            <th>#</th>
            <th scope="col">Usuario</th>
            <th scope="col">RFC</th>
            <th scope="col">Contacto</th>
            <th scope="col">Contaseña</th>
            <th scope="col">Fecha de Modificación</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $conteo = 1;
        while ($dataUsuario = mysqli_fetch_array($ejectuar)) { ?>
        <tr>
            <td><?php echo  $conteo++ . ')'; ?></td>
            <td><?php echo $dataUsuario['user']; ?></td>
            <td><?php echo $dataUsuario['rfc']; ?></td>
            <td><?php echo $dataUsuario['contacto']; ?></td>
            <td><?php echo $dataUsuario['pass']; ?></td>
            <td><?php echo $dataUsuario['datess']; ?></td>
        </tr>
        <?php } ?>
</table>