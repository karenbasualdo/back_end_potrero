```php
<?php

// ==========================================
// THEMEALDB API
// ==========================================

$url = "https://www.themealdb.com/api/json/v1/1/search.php?s=chicken";


// ==========================================
// OBTENER DATOS DE LA API
// ==========================================

$respuesta = file_get_contents($url);


// ==========================================
// CONVERTIR JSON A ARRAY
// ==========================================

$datos = json_decode($respuesta, true);

?>

<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>TheMealDB API</title>


    <!-- BOOTSTRAP -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <!-- CSS PROPIO -->

    <link
        rel="stylesheet"
        href="css/estilo.css"
    >

</head>


<body>


<div class="container py-5">


    <!-- VOLVER -->

    <a
        href="index.php"
        class="btn btn-secondary mb-4"
    >
        Volver
    </a>



    <h1>
        TheMealDB API
    </h1>


    <p>
        Ejemplo de API + JSON + array + foreach + cards Bootstrap.
    </p>



    <!-- CARDS -->

    <div class="row g-4">


        <?php

        // ======================================
        // COMPROBAR SI LA API DEVOLVIÓ COMIDAS
        // ======================================

        if (isset($datos["meals"])) {


            // ==================================
            // FOREACH
            // ==================================

            foreach ($datos["meals"] as $comida) {

        ?>


                <div
                    class="col-12 col-sm-6 col-md-4 col-lg-3"
                >


                    <div class="card h-100 product-card">


                        <!-- IMAGEN -->

                        <img
                            src="<?php echo htmlspecialchars($comida["strMealThumb"]); ?>"
                            class="card-img-top"
                            alt="<?php echo htmlspecialchars($comida["strMeal"]); ?>"
                        >



                        <div class="card-body">


                            <!-- NOMBRE -->

                            <h3 class="card-title">

                                <?php

                                echo htmlspecialchars(
                                    $comida["strMeal"]
                                );

                                ?>

                            </h3>



                            <!-- CATEGORÍA -->

                            <p>

                                <strong>
                                    Categoría:
                                </strong>

                                <?php

                                echo htmlspecialchars(
                                    $comida["strCategory"]
                                );

                                ?>

                            </p>



                            <!-- ÁREA -->

                            <p>

                                <strong>
                                    Área:
                                </strong>

                                <?php

                                echo htmlspecialchars(
                                    $comida["strArea"]
                                );

                                ?>

                            </p>



                            <!-- RECETA -->

                            <a
                                href="https://www.themealdb.com/meal/<?php echo $comida["idMeal"]; ?>"
                                target="_blank"
                                class="btn btn-success"
                            >
                                Ver receta
                            </a>


                        </div>


                    </div>


                </div>


        <?php

            }

        } else {

            echo "
                <div class='alert alert-danger'>
                    No se pudieron obtener comidas de la API.
                </div>
            ";

        }

        ?>


    </div>


</div>


</body>

</html>
```
