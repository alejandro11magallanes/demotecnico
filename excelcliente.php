<?php
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=reporte.xls");
include('connect.php');
$empresa = $_REQUEST['id'];
$sqlUsuarios   = ("SELECT * FROM clientes where empresa = '$empresa'");
$queryUsuarios = mysqli_query($con, $sqlUsuarios);
$totalUsuarios = mysqli_num_rows($queryUsuarios);
?>
<table>
    <thead>
        <tr>
            <th>#</th>
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
            <td><?php echo $dataUsuario['contacto']; ?></td>
            <td><?php echo $dataUsuario['correo']; ?></td>
        </tr>
        <?php } ?>
</table>