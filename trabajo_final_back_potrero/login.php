```php
<?php

session_start();


$usuario = $_POST["usuario"];

$contrasenia = $_POST["contrasenia"];



// DATOS DEL TRABAJADOR

$ckuser = "admin";

$ckpass = "1234";



if ($usuario == $ckuser && $contrasenia == $ckpass) {


    $_SESSION["trabajador"] = $usuario;


    header("location:listar.php");


} else {


    header("location:error.html");


}

?>
```
