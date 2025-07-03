<?php
session_start();
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['producto_id'])) {
    $producto_id = intval($_POST['producto_id']);

    
    $stmt = $conexion->prepare("SELECT id, nombre, precio, imagen FROM productos WHERE id = ?");
    $stmt->bind_param("i", $producto_id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($producto = $resultado->fetch_assoc()) {
        
        $item = [
            'id' => $producto['id'],
            'nombre' => $producto['nombre'],
            'precio' => $producto['precio'],
            'imagen' => $producto['imagen'],
            'cantidad' => 1
        ];

        //agrega carrito a l a sesion
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }

        $existe = false;
        foreach ($_SESSION['carrito'] as &$producto_en_carrito) {
            if ($producto_en_carrito['id'] == $item['id']) {
                $producto_en_carrito['cantidad']++;
                $existe = true;
                break;
            }
        }

        if (!$existe) {
            $_SESSION['carrito'][] = $item;
        }
    }

    $stmt->close();
}

header("Location: Tienda2.php");
exit;
?>
