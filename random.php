<?php
//alimentamos el generador de aleatorios
mt_srand(time());
//generamos un número aleatorio
$numero_aleatorio = mt_rand(1000, 9999);
echo $numero_aleatorio;