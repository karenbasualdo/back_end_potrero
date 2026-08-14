<?php
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

    <link rel="stylesheet" href="estilo/estilo.css">

</head>


<body>


<!-- ==========================================
     NAVBAR
     ========================================== -->

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">

        <!-- LOGO / NOMBRE -->
        <a class="navbar-brand fw-bold" href="index.php">
            🍽️ SABORES
        </a>

        <!-- BOTÓN RESPONSIVE -->
        <button 
            class="navbar-toggler" 
            type="button" 
            data-bs-toggle="collapse" 
            data-bs-target="#menu"
            aria-controls="menu"
            aria-expanded="false"
            aria-label="Abrir menú">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- MENÚ -->
        <div class="collapse navbar-collapse" id="menu">

            <ul class="navbar-nav ms-auto">

                <!-- INICIO -->
                <li class="nav-item">
                    <a class="nav-link" href="index.php">
                        Inicio
                    </a>
                </li>

                <!-- PRODUCTOS -->
                <li class="nav-item">
                    <a class="nav-link" href="index.php">
                        Productos
                    </a>
                </li>


                <!-- LOGIN CLIENTE -->
                <li class="nav-item">
                    <a class="nav-link" href="login_cliente.html">
                        👤 Cliente
                    </a>
                </li>

                <!-- LOGIN TRABAJADOR -->
                <li class="nav-item">
                    <a class="nav-link" href="login.html">
                        🔐 Trabajador
                    </a>
                </li>

            </ul>

        </div>
    </div>
</nav>

<div style="height: 70px;"></div>



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

<!-- FOOTER -->
<footer class="footer mt-5">
    <div class="container py-5">

        <div class="row align-items-center">

            <!-- MARCA -->
            <div class="col-md-4 mb-4 text-center text-md-start">

                <h4 class="footer-title">
                    🍽️ SABORES
                </h4>

                <p class="footer-text">
                    Descubrí diferentes comidas, sabores y opciones
                    para disfrutar.
                </p>

            </div>


            <!-- REDES SOCIALES -->
            <div class="col-md-4 mb-4 text-center">

                <h5 class="footer-subtitle">
                    Seguinos
                </h5>

                <div class="footer-socials">

                    <a
                        href="https://www.instagram.com/"
                        target="_blank"
                        aria-label="Instagram"
                    >
                        <img
                            src="https://cdn-icons-png.flaticon.com/512/5968/5968776.png"
                            alt="Instagram"
                            class="social-icon"
                        >
                    </a>


                    <a
                        href="https://www.facebook.com/"
                        target="_blank"
                        aria-label="Facebook"
                    >
                        <img
                            src="https://cdn-icons-png.flaticon.com/512/733/733547.png"
                            alt="Facebook"
                            class="social-icon"
                        >
                    </a>


                    <a
                        href="https://www.whatsapp.com/"
                        target="_blank"
                        aria-label="WhatsApp"
                    >
                        <img
                            src="https://cdn-icons-png.flaticon.com/512/733/733585.png"
                            alt="WhatsApp"
                            class="social-icon"
                        >
                    </a>


                    <a
                        href="https://www.linkedin.com/"
                        target="_blank"
                        aria-label="LinkedIn"
                    >
                        <img
                            src="https://cdn-icons-png.flaticon.com/512/174/174857.png"
                            alt="LinkedIn"
                            class="social-icon"
                        >
                    </a>

                </div>

            </div>


            <!-- CONTACTO -->
            <div class="col-md-4 mb-4 text-center text-md-end">

                <h5 class="footer-subtitle">
                    Contacto
                </h5>

                <p class="footer-text mb-1">
                    📍 Cañuelas, Argentina
                </p>

                <p class="footer-text mb-1">
                    📞 WhatsApp: 11 xxxxxxxx
                </p>

                <p class="footer-text">
                    📧 contacto@sabores.com
                </p>

            </div>

        </div>


        <hr class="footer-line">


        <!-- COPYRIGHT -->
        <div class="text-center footer-copy">

            © 2026 SABORES · Todos los derechos reservados karen andrea basualdo              

        </div>

    </div>
</footer>
<!-- BOOTSTRAP JS -->

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
></script>
</body>

</html>
```
