<?php

$conexion = mysqli_connect(
    "127.0.0.1",
    "root",
    "",
    "",
    3307
);

if (!$conexion) {
    die("ERROR: " . mysqli_connect_error());
}

echo "CONEXIÓN CORRECTA A MYSQL EN PUERTO 3307";

?>