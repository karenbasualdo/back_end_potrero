```php
<?php

session_start();


$usuario = $_POST["usuario"];

$contrasenia = $_POST["contrasenia"];



// DATOS DE PRUEBA DEL CLIENTE

$ckuser = "cliente";

$ckpass = "1234";



if ($usuario == $ckuser && $contrasenia == $ckpass) {


    $_SESSION["cliente"] = $usuario;


    header("location:index.php");


} else {


    header("location:error_cliente.html");


}

?>
```
