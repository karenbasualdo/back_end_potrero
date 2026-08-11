<?php

session_start();

if (!isset($_SESSION["trabajador"])) {

    header("location:login.html");

    exit;
}


mysqli_connect(
    "127.0.0.1",
    "root",
    "sakura13sql",
    "tienda_comida",
    3307
);

$id = $_GET["id"];

$consulta = "DELETE FROM comidas WHERE id=$id";

mysqli_query($conexion, $consulta);

header("location:listar.php");
?>