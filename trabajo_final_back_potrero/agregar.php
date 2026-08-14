<?php

session_start();

if (!isset($_SESSION["trabajador"])) {

    header("location:login.html");

    exit;
}

// ==========================================
// CONEXIÓN CON LA BASE DE DATOS
// ==========================================

$conexion = mysqli_connect(
    "127.0.0.1",
    "root",
    "",
    "tienda_comida",
    3307
);


// Comprobar conexión

if (!$conexion) {

    die("Error de conexión: " . mysqli_connect_error());

}

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
