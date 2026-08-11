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

$consulta = "SELECT * FROM comidas";
$datos = mysqli_query($conexion, $consulta);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABM Comidas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
<div class="container py-5">
    <h1>ABM de comidas</h1>

    <a href="index.php" class="btn btn-secondary">Inicio</a>
    <a href="agregar.html" class="btn btn-success">Agregar comida</a>
    <br><br>

    <table class="table table-dark table-bordered align-middle">
        <tr>
            <th>ID</th>
            <th>NOMBRE</th>
            <th>CATEGORÍA</th>
            <th>ÁREA</th>
            <th>PRECIO</th>
            <th>IMAGEN</th>
            <th>EDITAR</th>
            <th>BORRAR</th>
        </tr>

        <?php while ($reg = mysqli_fetch_array($datos)) { ?>
            <tr>
                <td><?php echo $reg["id"]; ?></td>
                <td><?php echo htmlspecialchars($reg["nombre"]); ?></td>
                <td><?php echo htmlspecialchars($reg["categoria"]); ?></td>
                <td><?php echo htmlspecialchars($reg["area"]); ?></td>
                <td>$ <?php echo $reg["precio"]; ?></td>
                <td>
                    <img src="<?php echo htmlspecialchars($reg["imagen"]); ?>" width="100" height="100" style="object-fit:cover;">
                </td>
                <td>
                    <a href="modificar.php?id=<?php echo $reg["id"]; ?>" class="btn btn-warning">Editar</a>
                </td>
                <td>
                    <a href="borrar.php?id=<?php echo $reg["id"]; ?>" class="btn btn-danger"
                       onclick="return confirm('¿Seguro que querés borrar esta comida?');">
                        Borrar
                    </a>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>
