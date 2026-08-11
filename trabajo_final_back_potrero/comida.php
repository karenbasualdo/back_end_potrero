<?php
$conexion = mysqli_connect(
    "127.0.0.1",
    "root",
    "sakura13sql",
    "tienda_comida",
    3307
);

if (!$conexion) {

    die(
        "Error de conexión: "
        . mysqli_connect_error()
    );

}

$id = $_GET["id"];

$consulta = "SELECT * FROM comidas WHERE id=$id";

$respuesta = mysqli_query($conexion, $consulta);

$reg = mysqli_fetch_array($respuesta);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($reg["nombre"]); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
<div class="container py-5">
    <a href="index.php" class="btn btn-secondary mb-4">Volver</a>

    <div class="card mx-auto" style="max-width: 800px;">
        <div class="row g-0">
            <div class="col-md-6">
                <img src="<?php echo htmlspecialchars($reg["imagen"]); ?>" class="img-fluid rounded-start">
            </div>

            <div class="col-md-6">
                <div class="card-body">
                    <h1><?php echo htmlspecialchars($reg["nombre"]); ?></h1>

                    <p>Categoría: <?php echo htmlspecialchars($reg["categoria"]); ?></p>
                    <p>Área: <?php echo htmlspecialchars($reg["area"]); ?></p>

                    <h2>$ <?php echo number_format($reg["precio"], 2, ",", "."); ?></h2>

                    <p><?php echo htmlspecialchars($reg["descripcion"]); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
