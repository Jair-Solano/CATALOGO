<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "proyectoFinal";


$conexion = new mysqli($host, $user, $pass, $db);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
} else {
    echo "Conexión exitosa a la base de datos '$db'";
}
?>
