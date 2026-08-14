<?php

$conexion = mysqli_connect(
    "127.0.0.1",
    "root",
    "",
    "tienda_comida",
    3307
);

if (!$conexion) {
    die("ERROR DE CONEXIÓN: " . mysqli_connect_error());
}

?>