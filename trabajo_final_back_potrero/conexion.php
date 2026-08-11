```php
<?php

mysqli_connect(
    "127.0.0.1",
    "root",
    "sakura13sql",
    "tienda_comida",
    3307
);


if (!$conexion) {

    die("ERROR DE CONEXIÓN: " . mysqli_connect_error());

}


echo "CONEXIÓN CON MYSQL CORRECTA";


mysqli_select_db(
    $conexion,
    "tienda_comida"
);


echo "<br>BASE DE DATOS CORRECTA";

?>
```
