<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    include 'connect.php';
    $consulta = "SELECT * FROM empresas";
    $ejecutar = mysqli_query($con, $consulta);
    ?>
    <table>
        <thead>
            <tr id="tabla-head">
                <th>#</th>
                <th scope="col">RFC</th>
                <th scope="col">Razon Social</th>
                <th scope="col">CP</th>
                <th scope="col">contraseña SAT</th>
                <th scope="col">CFDI</th>
                <th scope="col">Constancia</th>

            </tr>
        </thead>

        <tbody>
            <?php
            $conteo = 1;
            while ($dataUsuario = mysqli_fetch_assoc($ejecutar)) { ?>
            <tr>
                <td><?php echo  $conteo++ . ')'; ?></td>
                <td><?php echo $dataUsuario['rfc']; ?></td>
                <td><?php echo $dataUsuario['razon']; ?></td>
                <td><?php echo $dataUsuario['cp']; ?></td>
                <td><?php echo $dataUsuario['contraseñasat']; ?></td>
                <td><?php echo $dataUsuario['cfdi']; ?></td>
                <td><a href="ver.php?id=<?php echo $dataUsuario['id']; ?>" />Ver
                    documento</a><br><br></a>
                </td>


            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>