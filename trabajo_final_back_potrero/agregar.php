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

mysqli_select_db($conexion, "tienda_comida");
$nombre = $_POST["nombre"];
$categoria = $_POST["categoria"];
$area = $_POST["area"];
$precio = $_POST["precio"];
$imagen = $_POST["imagen"];
$descripcion = $_POST["descripcion"];

$consulta = "INSERT INTO comidas
(nombre, categoria, area, precio, imagen, descripcion)
VALUES
('$nombre', '$categoria', '$area', '$precio', '$imagen', '$descripcion')";

mysqli_query($conexion, $consulta);

header("location:listar.php");
?>
