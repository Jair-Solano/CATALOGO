<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "proyectoFinal";

// Crear conexión
$conexion = new mysqli($server, $user, $pass, $db);

// Verificar conexión
if ($conexion->connect_errno) {
    die("Conexión fallida: " . $conexion->connect_error);
}
else {
 echo "Conexión exitosa";
}
?>
