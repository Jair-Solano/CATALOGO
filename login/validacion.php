<?php
require_once('../db/conexion.php');

// Obtener los datos del formulario por el metodo POST
$user = $_POST['user']; // Correo institucional
$password = $_POST['password']; // Contraseña

 

// Consulta para obtener los datos del usuario por correo electrónico
$stmt = $conexion->prepare("SELECT * FROM usuarios WHERE usuario = ?");
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($result->num_rows > 0) {
    // Verificar la contraseña ingresada con la contraseña hasheada almacenada
    if ($result->num_rows > 0) {
    // Verificar la contraseña ingresada con la contraseña hasheada almacenada
    if ( ($password==$row['contraseña'])) {

        session_start(); 
        $_SESSION['user'] = $email;
        $_SESSION['rol'] = $row['rol'];
        $_SESSION['usuario'] = $row['usuario'];
        $_SESSION['cedula'] = $row['cedula'];

        // Redirigir según el rol
        if ($row['rol'] == 1) {
            header("Location:   ../landing/landing.php");
        } else if ($row['rol'] == 0) {
            header("Location: ../landing/landing.php");
        }
        exit(); // Asegura la redirección
    } else {
        // Contraseña incorrecta
        header("Location: ../login-php/loging.php?message=error_password");
        exit(); // Asegura la redirección
    }
}} else {
    // Usuario no encontrado
    header("Location: ../login-php/loging.php?message=error_user");
    exit(); // Asegura la redirección 
}

$stmt->close();
$conexion->close();
?>