<?php

session_start();
unset($_SESSION['nombre']);
session_destroy();
header("location: login.php");