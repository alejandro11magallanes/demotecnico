<?php
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=reporte.xls");
include('connect.php');
$fecha = $_REQUEST['id'];
$consulta = "SELECT nombre, correo, empresas.rfc as rfc from contactos INNER JOIN empresas On contactos.empresa = empresas.id WHERE contactos.fecha >='$fecha'";
$queryUsuarios = mysqli_query($con, $consulta);
$totalUsuarios = mysqli_num_rows($queryUsuarios);
?>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th scope="col">RFC</th>
            <th scope="col">Nombre</th>
            <th scope="col">Correo</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $conteo = 1;
        while ($dataUsuario = mysqli_fetch_array($queryUsuarios)) { ?>
        <tr>
            <td><?php echo  $conteo++ . ')'; ?></td>
            <td><?php echo $dataUsuario['rfc']; ?></td>
            <td><?php echo $dataUsuario['nombre']; ?></td>
            <td><?php echo $dataUsuario['correo']; ?></td>
        </tr>
        <?php } ?>
</table>