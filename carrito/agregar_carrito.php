<?php
session_start();
include '../db/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['producto_id'])) {
    $producto_id = intval($_POST['producto_id']);

    // Consultar producto en la base de datos
    $stmt = $conexion->prepare("SELECT ID, nombre, precio, imagen FROM productos WHERE ID = ?");
    $stmt->bind_param("i", $producto_id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($producto = $resultado->fetch_assoc()) {
        // Inicializar carrito si no existe
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }

        // Verificar si el producto ya está en el carrito
        $existe = false;
        foreach ($_SESSION['carrito'] as &$item) {
            if ($item['ID'] == $producto_id) {
                $item['cantidad']++;
                $existe = true;
                break;
            }
        }
        if (!$existe) {
            $producto['cantidad'] = 1;
            $_SESSION['carrito'][] = $producto;
        }
    }
}

header('Location: tienda2.php');
exit;
?>
