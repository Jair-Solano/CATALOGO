<?php
session_start();
$carrito = $_SESSION['carrito'] ?? [];
$total = 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Carrito</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container py-5">
  <h1>Tu Carrito</h1>

  <?php if (empty($carrito)): ?>
    <p>Tu carrito está vacío.</p>
  <?php else: ?>
    <table class="table">
      <thead>
        <tr>
          <th>Producto</th>
          <th>Precio</th>
          <th>Cantidad</th>
          <th>Subtotal</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($carrito as $index => $item): 
          $subtotal = $item['precio'] * $item['cantidad'];
          $total += $subtotal;
        ?>
          <tr>
            <td><?= htmlspecialchars($item['nombre']) ?></td>
            <td>$<?= number_format($item['precio'], 2) ?></td>
            <td><?= $item['cantidad'] ?></td>
            <td>$<?= number_format($subtotal, 2) ?></td>
            <td>
              <a href="eliminar_producto.php?index=<?= $index ?>" class="btn btn-danger btn-sm">Eliminar</a>
              <!-- Puedes añadir botones para + / - cantidad -->
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
      <tfoot>
        <tr>
          <th colspan="3" class="text-end">Total</th>
          <th>$<?= number_format($total, 2) ?></th>
          <th></th>
        </tr>
      </tfoot>
    </table>
  <?php endif; ?>

  <a href="tienda2.php" class="btn btn-secondary">Seguir comprando</a>
  <?php if (!empty($carrito)): ?>
    <a href="checkout.php" class="btn btn-primary">Procesar Pago</a>
  <?php endif; ?>
</div>
</body>
</html>
