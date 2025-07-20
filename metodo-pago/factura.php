<?php
// Recupera los datos del pedido enviados por POST
$productos = isset($_POST['productos']) ? json_decode($_POST['productos'], true) : [];
$envio = isset($_POST['envio']) ? floatval($_POST['envio']) : 0.00;
$itbms = isset($_POST['itbms']) ? floatval($_POST['itbms']) : 0.00;
$total = isset($_POST['total']) ? floatval($_POST['total']) : 0.00;
$cliente = isset($_POST['cliente']) ? $_POST['cliente'] : 'Cliente';
$direccion = isset($_POST['direccion']) ? $_POST['direccion'] : '';
$fecha = date('d M Y, h:i A');
$orderId = rand(1000000,9999999);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Factura - El Callejon</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f7f7f7; margin: 0; }
    .factura-container {
      background: #fff; border-radius: 16px; max-width: 700px; margin: 40px auto; box-shadow: 0 8px 32px rgba(0,0,0,0.10); padding: 38px 44px;
    }
    .factura-header { color: #a3080d; font-weight: bold; font-size: 2rem; margin-bottom: 6px; }
    .factura-sub { color: #333; margin-bottom: 24px; font-size: 1.1rem; }
    .factura-info { margin-bottom: 18px; }
    .factura-info span { display: inline-block; min-width: 120px; font-weight: bold; }
    .factura-table { width: 100%; border-collapse: collapse; margin: 24px 0 18px 0; }
    .factura-table th, .factura-table td { border: 1px solid #e0e0e0; padding: 10px 8px; text-align: left; }
    .factura-table th { background: #f3f3f3; color: #a3080d; }
    .factura-table td { background: #fff; }
    .factura-total-row td { font-weight: bold; color: #a3080d; }
    .factura-total { font-size: 1.2rem; color: #1a9c3c; font-weight: bold; text-align: right; }
    .factura-label { color: #888; font-size: 0.96rem; }
    .factura-footer { margin-top: 32px; text-align: center; color: #666; font-size: 0.95rem; }
    @media (max-width: 600px) {
      .factura-container { padding: 14px; }
      .factura-header { font-size: 1.3rem; }
    }
  </style>
</head>
<body>
  <div class="factura-container">
    <div class="factura-header">El Callejon</div>
    <div class="factura-sub">Gracias por tu pedido. Aquí tienes tu factura:</div>
    <div class="factura-info">
      <div><span>Factura No:</span> #<?php echo $orderId; ?></div>
      <div><span>Fecha:</span> <?php echo $fecha; ?></div>
      <div><span>Cliente:</span> <?php echo htmlspecialchars($cliente); ?></div>
      <?php if ($direccion) { ?><div><span>Dirección:</span> <?php echo htmlspecialchars($direccion); ?></div><?php } ?>
    </div>
    <table class="factura-table">
      <tr>
        <th>Producto</th>
        <th>Cantidad</th>
        <th>Precio Unitario</th>
        <th>Subtotal</th>
      </tr>
      <?php foreach ($productos as $prod) { ?>
        <tr>
          <td><?php echo htmlspecialchars($prod['nombre']); ?></td>
          <td><?php echo intval($prod['cantidad']); ?></td>
          <td>$. <?php echo number_format($prod['precio'], 2); ?></td>
          <td>$. <?php echo number_format($prod['precio'] * $prod['cantidad'], 2); ?></td>
        </tr>
      <?php } ?>
      <tr>
        <td colspan="3" class="factura-label">Envío</td>
        <td>$. <?php echo number_format($envio, 2); ?></td>
      </tr>
      <tr>
        <td colspan="3" class="factura-label">ITBMS</td>
        <td>$. <?php echo number_format($itbms, 2); ?></td>
      </tr>
      <tr class="factura-total-row">
        <td colspan="3">Total</td>
        <td>$. <?php echo number_format($total, 2); ?></td>
      </tr>
    </table>
    <div class="factura-footer">¡Gracias por comprar en El Callejon!</div>
    <div style="text-align:center;margin-top:24px;">
      <a href="../landing/landing.php" style="display:inline-block;background:#a3080d;color:#fff;padding:12px 36px;border-radius:8px;font-size:1.08rem;text-decoration:none;font-weight:bold;box-shadow:0 2px 8px rgba(0,0,0,0.07);transition:background 0.2s;">Regresar al Menú Principal</a>
    </div>
  </div>
</body>
</html>
