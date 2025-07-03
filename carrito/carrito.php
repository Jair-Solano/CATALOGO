<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Mi Carrito</title>
  <style>
    body {
      font-family: 'Montserrat', sans-serif;
      background-color: #f8f9fa;
      margin: 20px;
      color: #333;
    }
    h1 {
      text-align: center;
      color: #444;
    }
    table {
      width: 90%;
      margin: 0 auto;
      border-collapse: collapse;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    th, td {
      padding: 15px;
      text-align: center;
    }
    thead {
      background-color: #ff6b6b;
      color: white;
    }
    tr:nth-child(even) {
      background-color: #f2f2f2;
    }
    img {
      width: 60px;
      border-radius: 8px;
    }
    .total {
      font-weight: bold;
      color: #2d3436;
    }
    .button-container {
      text-align: center;
      margin-top: 20px;
    }
    .btn {
      padding: 10px 20px;
      background-color: #ff6b6b;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-weight: bold;
      transition: background-color 0.3s;
      text-decoration: none;
    }
    .btn:hover {
      background-color: #e74c3c;
    }
    p {
      text-align: center;
    }
  </style>
</head>
<body>

  <h1>🛒 Mi Carrito de Compras</h1>

  <?php if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0): ?>
    <table>
      <thead>
        <tr>
          <th>Imagen</th>
          <th>Producto</th>
          <th>Precio</th>
          <th>Cantidad</th>
          <th>Subtotal</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $total = 0;
          foreach ($_SESSION['carrito'] as $item): 
            $subtotal = $item['precio'] * $item['cantidad'];
            $total += $subtotal;
        ?>
        <tr>
          <td><img src="imagenes/<?= htmlspecialchars($item['imagen']) ?>" alt="<?= htmlspecialchars($item['nombre']) ?>"></td>
          <td><?= htmlspecialchars($item['nombre']) ?></td>
          <td>$<?= number_format($item['precio'], 2) ?></td>
          <td><?= $item['cantidad'] ?></td>
          <td>$<?= number_format($subtotal, 2) ?></td>
        </tr>
        <?php endforeach; ?>
        <tr>
          <td colspan="4" class="total">Total:</td>
          <td class="total">$<?= number_format($total, 2) ?></td>
        </tr>
      </tbody>
    </table>

    <div class="button-container">
      <a href="Tienda2.php" class="btn">Seguir comprando</a>
    </div>
  <?php else: ?>
    <p>Tu carrito está vacío.</p>
    <div class="button-container">
      <a href="Tienda2.php" class="btn">Regresar</a>
    </div>
  <?php endif; ?>

</body>
</html>
