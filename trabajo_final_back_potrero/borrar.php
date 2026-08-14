<?php

session_start();

if (!isset($_SESSION["trabajador"])) {

    header("location:login.html");

    exit;
}


// CONEXIÓN
require_once "conexion.php";


// ID DEL PRODUCTO
$id = $_GET["id"];


// ELIMINAR PRODUCTO
$consulta = "DELETE FROM comidas WHERE id=$id";

mysqli_query($conexion, $consulta);


// VOLVER AL LISTADO
header("location:listar.php");

exit;

?>