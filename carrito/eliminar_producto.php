<?php
session_start();
if (isset($_GET['index']) && isset($_SESSION['carrito'][$_GET['index']])) {
    unset($_SESSION['carrito'][$_GET['index']]);
    // Reindexar para evitar huecos
    $_SESSION['carrito'] = array_values($_SESSION['carrito']);
}
header('Location: carrito.php');
exit;
?>
