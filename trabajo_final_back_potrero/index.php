```php
<?php
// ==========================================
// CONEXIÓN CON LA BASE DE DATOS
// ==========================================

$conexion = mysqli_connect(
    "127.0.0.1",
    "root",
    "sakura13sql",
    "tienda_comida",
    3307
);

// ==========================================
// FILTROS
// ==========================================

$nombre = isset($_GET["nombre"]) ? $_GET["nombre"] : "";
$categoria = isset($_GET["categoria"]) ? $_GET["categoria"] : "";
$area = isset($_GET["area"]) ? $_GET["area"] : "";
$orden = isset($_GET["orden"]) ? $_GET["orden"] : "";


// ==========================================
// CONSULTA SELECT
// ==========================================

$consulta = "SELECT * FROM comidas WHERE 1=1";


// Filtro por nombre
if ($nombre != "") {

    $nombre = mysqli_real_escape_string($conexion, $nombre);

    $consulta .= " AND nombre LIKE '%$nombre%'";
}


// Filtro por categoría
if ($categoria != "") {

    $categoria = mysqli_real_escape_string($conexion, $categoria);

    $consulta .= " AND categoria='$categoria'";
}


// Filtro por área
if ($area != "") {

    $area = mysqli_real_escape_string($conexion, $area);

    $consulta .= " AND area='$area'";
}


// Orden por precio
if ($orden == "menor") {

    $consulta .= " ORDER BY precio ASC";
}

if ($orden == "mayor") {

    $consulta .= " ORDER BY precio DESC";
}


// ==========================================
// EJECUTAR CONSULTA
// ==========================================

$datos = mysqli_query($conexion, $consulta);


// ==========================================
// CONSULTAS PARA LOS FILTROS
// ==========================================

$categorias = mysqli_query(
    $conexion,
    "SELECT DISTINCT categoria FROM comidas ORDER BY categoria"
);

$areas = mysqli_query(
    $conexion,
    "SELECT DISTINCT area FROM comidas ORDER BY area"
);

?>

<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Sabores - Comidas</title>


    <!-- BOOTSTRAP -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <!-- CSS PROPIO -->

    <link rel="stylesheet" href="css/estilo.css">

</head>


<body>


<!-- ==========================================
     NAVBAR
     ========================================== -->

<nav class="navbar navbar-expand-lg navbar-dark main-navbar">

    <div class="container">


        <!-- LOGO -->

        <a class="navbar-brand" href="index.php">
            SABORES
        </a>


        <!-- BOTÓN RESPONSIVE -->

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
        >

            <span class="navbar-toggler-icon"></span>

        </button>


        <!-- MENÚ -->

        <div
            class="collapse navbar-collapse"
            id="navbarNav"
        >

            <ul class="navbar-nav w-100">


                <!-- PRODUCTOS -->

                <li class="nav-item">

                    <a
                        class="nav-link"
                        href="index.php"
                    >
                        Productos
                    </a>

                </li>


                <!-- API -->

                <li class="nav-item">

                    <a
                        class="nav-link"
                        href="api.php"
                    >
                        API
                    </a>

                </li>


                <!-- LOGIN CLIENTE -->

                <li class="nav-item ms-auto">

                    <a
                        class="nav-link"
                        href="login_cliente.html"
                    >
                        👤 Cliente
                    </a>

                </li>


                <!-- LOGIN TRABAJADOR -->

                <li class="nav-item">

                    <a
                        class="nav-link"
                        href="login.html"
                    >
                        🔐 Trabajador
                    </a>

                </li>

            </ul>

        </div>

    </div>

</nav>



<!-- ==========================================
     CONTENIDO PRINCIPAL
     ========================================== -->

<div class="container py-5">


    <h1>
        Comidas
    </h1>


    <p>
        Descubrí nuestras comidas.
    </p>



    <!-- ======================================
         FILTROS
         ====================================== -->

    <div class="filter-box mb-5">


        <h2>
            Buscar productos
        </h2>


        <form
            method="GET"
            action="index.php"
        >


            <div class="row">


                <!-- BUSCAR POR NOMBRE -->

                <div class="col-md-3 mb-3">

                    <label>
                        Buscar comida
                    </label>

                    <input
                        type="text"
                        name="nombre"
                        class="form-control"
                        value="<?php echo htmlspecialchars($nombre); ?>"
                        placeholder="Ej: Chicken"
                    >

                </div>



                <!-- CATEGORÍA -->

                <div class="col-md-3 mb-3">

                    <label>
                        Categoría
                    </label>

                    <select
                        name="categoria"
                        class="form-select"
                    >

                        <option value="">
                            Todas
                        </option>


                        <?php

                        while ($cat = mysqli_fetch_array($categorias)) {

                        ?>

                            <option
                                value="<?php echo htmlspecialchars($cat["categoria"]); ?>"
                            >

                                <?php
                                echo htmlspecialchars(
                                    $cat["categoria"]
                                );
                                ?>

                            </option>

                        <?php

                        }

                        ?>

                    </select>

                </div>



                <!-- ÁREA -->

                <div class="col-md-3 mb-3">

                    <label>
                        País / Área
                    </label>

                    <select
                        name="area"
                        class="form-select"
                    >

                        <option value="">
                            Todas
                        </option>


                        <?php

                        while ($ar = mysqli_fetch_array($areas)) {

                        ?>

                            <option
                                value="<?php echo htmlspecialchars($ar["area"]); ?>"
                            >

                                <?php
                                echo htmlspecialchars(
                                    $ar["area"]
                                );
                                ?>

                            </option>

                        <?php

                        }

                        ?>

                    </select>

                </div>



                <!-- ORDEN PRECIO -->

                <div class="col-md-3 mb-3">

                    <label>
                        Precio
                    </label>

                    <select
                        name="orden"
                        class="form-select"
                    >

                        <option value="">
                            Orden normal
                        </option>

                        <option value="menor">
                            Menor a mayor
                        </option>

                        <option value="mayor">
                            Mayor a menor
                        </option>

                    </select>

                </div>

            </div>



            <!-- BOTONES -->

            <button
                type="submit"
                class="btn btn-warning"
            >
                Filtrar
            </button>


            <a
                href="index.php"
                class="btn btn-secondary"
            >
                Limpiar
            </a>


        </form>

    </div>



    <!-- ======================================
         CARDS
         ====================================== -->

    <h2 class="section-title">

        Nuestras comidas

    </h2>



    <div class="row g-4">


        <?php

        // BUCLE PARA RECORRER LOS REGISTROS

        while ($reg = mysqli_fetch_array($datos)) {

        ?>


            <!-- CARD -->

            <div
                class="col-12 col-sm-6 col-md-4 col-lg-3"
            >


                <div
                    class="card product-card h-100"
                >


                    <!-- IMAGEN -->

                    <img
                        class="card-img-top"
                        src="<?php echo htmlspecialchars($reg["imagen"]); ?>"
                        alt="<?php echo htmlspecialchars($reg["nombre"]); ?>"
                    >



                    <!-- CONTENIDO -->

                    <div
                        class="card-body text-center"
                    >


                        <!-- NOMBRE -->

                        <h3 class="card-title">

                            <?php

                            echo htmlspecialchars(
                                $reg["nombre"]
                            );

                            ?>

                        </h3>



                        <!-- CATEGORÍA -->

                        <p>

                            Categoría:

                            <?php

                            echo htmlspecialchars(
                                $reg["categoria"]
                            );

                            ?>

                            <br>


                            Área:

                            <?php

                            echo htmlspecialchars(
                                $reg["area"]
                            );

                            ?>

                        </p>



                        <!-- PRECIO -->

                        <span class="product-price">

                            $

                            <?php

                            echo number_format(
                                $reg["precio"],
                                2,
                                ",",
                                "."
                            );

                            ?>

                        </span>



                        <br>
                        <br>



                        <!-- DETALLE -->

                        <a
                            href="comida.php?id=<?php echo $reg["id"]; ?>"
                            class="btn btn-success"
                        >

                            Leer más

                        </a>


                    </div>


                </div>


            </div>


        <?php

        }

        ?>


    </div>


</div>



<!-- BOOTSTRAP JS -->

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
></script>


</body>

</html>
```
