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

$consulta = "SELECT * FROM comidas WHERE id=$id";

$respuesta = mysqli_query($conexion, $consulta);

$datos = mysqli_fetch_array($respuesta);

$nombre = $datos["nombre"];
$categoria = $datos["categoria"];
$area = $datos["area"];
$precio = $datos["precio"];
$imagen = $datos["imagen"];
$descripcion = $datos["descripcion"];

if (array_key_exists("guardar_cambios", $_POST)) {
    $nombre = $_POST["nombre"];
    $categoria = $_POST["categoria"];
    $area = $_POST["area"];
    $precio = $_POST["precio"];
    $imagen = $_POST["imagen"];
    $descripcion = $_POST["descripcion"];

    $consulta_actualizar = "UPDATE comidas SET
        nombre='$nombre',
        categoria='$categoria',
        area='$area',
        precio='$precio',
        imagen='$imagen',
        descripcion='$descripcion'
        WHERE id=$id";

    mysqli_query($conexion, $consulta_actualizar);

    header("location:listar.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar comida</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <h1>Modificar comida</h1>

    <img src="<?php echo htmlspecialchars($imagen); ?>" width="180" height="180" style="object-fit:cover;" class="mb-3">

    <form method="POST">
        <label>Nombre</label>
        <input type="text" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" class="form-control mb-3" required>

        <label>Categoría</label>
        <input type="text" name="categoria" value="<?php echo htmlspecialchars($categoria); ?>" class="form-control mb-3" required>

        <label>Área</label>
        <input type="text" name="area" value="<?php echo htmlspecialchars($area); ?>" class="form-control mb-3" required>

        <label>Precio</label>
        <input type="number" step="0.01" name="precio" value="<?php echo $precio; ?>" class="form-control mb-3" required>

        <label>URL imagen</label>
        <input type="text" name="imagen" value="<?php echo htmlspecialchars($imagen); ?>" class="form-control mb-3" required>

        <label>Descripción</label>
        <textarea name="descripcion" class="form-control mb-3"><?php echo htmlspecialchars($descripcion); ?></textarea>

        <input type="submit" name="guardar_cambios" value="Guardar cambios" class="btn btn-warning">
        <a href="listar.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
