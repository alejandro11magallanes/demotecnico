<?php
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=reporte.xls");
include('connect.php');
$fecha = $_REQUEST['id'];
$consulta = "SELECT empresa_cli, contacto,correo,fecha_actualizacion,  empresas.rfc as rfc from clientes INNER JOIN empresas On clientes.empresa = empresas.id WHERE clientes.fecha_actualizacion >='$fecha'";
$queryUsuarios = mysqli_query($con, $consulta);
$totalUsuarios = mysqli_num_rows($queryUsuarios);
?>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th scope="col">RFC</th>
            <th scope="col">Empresa Cliente</th>
            <th scope="col">Contacto</th>
            <th scope="col">Correo</th>
            <th scope="col">Fecha de Modificacion</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $conteo = 1;
        while ($dataUsuario = mysqli_fetch_array($queryUsuarios)) { ?>
        <tr>
            <td><?php echo  $conteo++ . ')'; ?></td>
            <td><?php echo $dataUsuario['rfc']; ?></td>
            <td><?php echo $dataUsuario['empresa_cli']; ?></td>
            <td><?php echo $dataUsuario['contacto']; ?></td>
            <td><?php echo $dataUsuario['correo']; ?></td>
            <td><?php echo $dataUsuario['fecha_actualizacion']; ?></td>
        </tr>
        <?php } ?>
</table>