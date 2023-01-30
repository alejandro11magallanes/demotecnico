<?php
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=reporte.xls");
include('connect.php');
$fechaActual = date("Y-m-d");
$consulta = "SELECT usuarios.username as user, usuarios.Contacto as contacto, empresas.rfc as rfc, empresas.passat as pass, empresas.fecha_csf as datess, empresas.razon as razon, empresas.modificacion as modificacion, datediff('2023-01-27', fecha_csf) as dias FROM empresas INNER JOIN usuarios ON empresas.usuario= usuarios.id WHERE fecha_csf IS NULL OR datediff('$fechaActual', fecha_csf) >=80";
$ejecutar = mysqli_query($con, $consulta);
?>
<table ">
    <thead>
        <tr id=" tabla-head">
    <th>#</th>
    <th scope="col">Usuario</th>
    <th scope="col">RFC</th>
    <th scope="col">Razon Social</th>
    <th scope="col">Contacto</th>
    <th scope="col">Contraseña SAT</th>
    <th scope="col">Fecha de Emision</th>
    <th scope="col">Dias</th>
    <th scope="col">CSF</th>
    <th scope="col">Fecha de Modificacion</th>
    </tr>
    </thead>
    <tbody>
        <?php
        $conteo = 1;
        while ($dataUsuario = mysqli_fetch_array($ejecutar)) {
            $valor;
            $icon;
            if ($dataUsuario['dias'] == null) {
                $valor = 0;
                $icon = "<button class='btn btn-danger mb-2'><i
                            class='bi bi-file-earmark-excel'></i></button>";
            } else {
                $valor = $dataUsuario['dias'];
                $icon = "<button class='btn btn-warning mb-2'><i
                            class='bi bi-file-earmark-break'></i></button>";
            }
            $date;
            if ($dataUsuario['datess'] == null) {
                $date = "No hay CSF";
            } else {
                $date = $dataUsuario['datess'];
            }


        ?>
        <tr>
            <td><?php echo  $conteo++ . ')'; ?></td>
            <td><?php echo $dataUsuario['user']; ?></td>
            <td><?php echo $dataUsuario['rfc']; ?></td>
            <td><?php echo $dataUsuario['razon']; ?></td>
            <td><?php echo $dataUsuario['contacto']; ?></td>
            <td><?php echo $dataUsuario['pass']; ?></td>
            <td><?php echo $date; ?></td>
            <td><?php echo $valor; ?></td>
            <td><?php echo $icon; ?></td>
            <td><?php echo $dataUsuario['modificacion']; ?></td>
        </tr>
        <?php } ?>
</table>