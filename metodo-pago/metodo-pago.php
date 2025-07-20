<?php /*
  Archivo unificado para la sección de método de pago
  Incluye estilos y lógica de selección de método de pago
*/ ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>El Callejon - Método de Pago</title>
  <style>
    /* Reset y base */
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: Arial, sans-serif;
      background: #fdfcfc;
      color: #333;
      min-height: 100vh;
    }
    .app-header {
      background: #a3080d;
      color: #fff;
      display: flex;
      align-items: center;
      padding: 10px 20px;
      width: 100%;
      position: sticky;
      top: 0;
      z-index: 10;
    }
    .logo { height: 40px; margin-right: 10px; }
    .app-container {
      display: flex; flex-direction: column; align-items: center; min-height: 100vh; width: 100%; justify-content: center;
    }
    .card {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
      width: 97%; max-width: 1050px;
      margin: 40px auto;
      padding: 32px 36px;
    }
    .card-title { color: #a3080d; margin-bottom: 24px; font-size: 1.4rem; font-weight: bold; }
    .checkout-grid {
      display: flex; gap: 48px; justify-content: space-between; align-items: flex-start;
    }
    .form-section {
      flex: 1 1 320px; min-width: 260px; max-width: 350px;
      display: flex; flex-direction: column; gap: 16px;
    }
    .form-section label { font-weight: bold; margin-bottom: 4px; display: block; }
    .form-section select { margin-bottom: 8px; margin-top: 4px; width: 100%; }
    .payment-options {
      margin: 4px 0 8px 0; display: flex; flex-wrap: wrap; gap: 12px;
    }
    .payment-button {
      background: #fff; border: 2px solid #a3080d; color: #a3080d;
      border-radius: 8px; padding: 8px 24px; font-size: 1rem; cursor: pointer;
      transition: background 0.2s, color 0.2s, border 0.2s;
    }
    .payment-button.selected, .payment-button:hover {
      background: #a3080d; color: #fff;
    }
    .resumen-section {
      flex: 1 1 420px; min-width: 340px; max-width: 540px;
      display: flex; flex-direction: column; gap: 8px;
      background: #faf7f7; border-radius: 10px;
      padding: 18px 20px 20px 20px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
      height: fit-content; align-self: flex-start;
    }
    .resumen-item {
      display: flex; justify-content: space-between; font-size: 1rem; margin-bottom: 7px;
    }
    .resumen-total {
      font-weight: bold; font-size: 1.1rem; border-top: 1px solid #d9d9d9; padding-top: 7px; margin-top: 10px;
    }
    .btn-pedir {
      margin-top: 24px; background: #a3080d; color: #fff; border: none;
      border-radius: 8px; padding: 10px 0; font-size: 1.1rem; cursor: pointer;
      transition: background 0.2s; width: 100%;
    }
    .btn-pedir:hover { background: #7e0509; }
    @media (max-width: 1100px) {
      .checkout-grid { gap: 24px; }
    }
    @media (max-width: 800px) {
      .checkout-grid { flex-direction: column; gap: 24px; }
      .resumen-section { align-self: stretch; width: 100%; min-width: unset; margin-top: 16px; }
      .form-section { width: 100%; min-width: unset; }
      .card { padding: 18px; }
    }
    @media (max-width: 500px) {
      .card { padding: 8px; }
    }
  align-items: center;
  gap: 10px;
  font-size: 0.95rem;
}
.btn-pedir {
  margin-top: 24px;
  background: #a3080d;
  color: #fff;
  border: none;
  border-radius: 8px;
  padding: 10px 0;
  font-size: 1.1rem;
  cursor: pointer;
  transition: background 0.2s;
  width: 100%;
}
.btn-pedir:hover {
  background: #7e0509;
}
  </style>
</head>
<body>
  <header class="app-header">
    <img src="../assets/imag/logo-color.png" alt="logo" class="logo">
    <h1>El Callejon</h1>
  </header>
  <div class="app-container">
    <main class="card">
      <h2 class="card-title">Confirmar pedido</h2>
      <div class="checkout-grid">
        <!-- Columna izquierda: formulario -->
        <div class="form-section">
          <div>
            <label for="tipo-entrega">Tipo de entrega:</label>
            <select id="tipo-entrega" disabled style="width:100%;">
              <option>Retiro</option>
            </select>
          </div>
          <div>
            <label for="ubicacion">Ubicación:</label>
            <select id="ubicacion" style="width:100%;">
              <option>Seleccionar</option>
            </select>
          </div>
          <div>
            <label>Método de pago</label>
            <div class="payment-options">
              <button class="payment-button" data-metodo="efectivo">Efectivo</button>
              <button class="payment-button" data-metodo="yappy">Yappy</button>
            </div>
          </div>
        </div>
        <!-- Columna derecha: resumen -->
        <div class="resumen-section">
  <div class="resumen-item" style="flex-direction:column;align-items:flex-start;gap:6px;">
    <span style="font-weight:bold;">Productos:</span>
    <table id="tabla-productos" style="width:100%;margin-bottom:10px;font-size:1rem;table-layout:fixed;">
      <thead>
        <tr style="color:#a3080d;background:#f3f3f3;">
          <th style="text-align:left;padding:4px 6px;width:40%;word-break:break-word;">Producto</th>
          <th style="text-align:right;padding:4px 6px;width:20%;">Cantidad</th>
          <th style="text-align:right;padding:4px 6px;width:20%;">Precio</th>
          <th style="text-align:right;padding:4px 6px;width:20%;">Subtotal</th>
        </tr>
      </thead>
      <tbody id="productos-listado">
        <!-- JS insertará aquí los productos -->
      </tbody>
    </table>
  </div>
  <div class="resumen-item">
    <span>Envío:</span>
    <span id="resumen-envio">$0.00</span>
  </div>
  <div class="resumen-item">
    <span>ITBMS:</span>
    <span id="resumen-itbms">$0.10</span>
  </div>
  <div class="resumen-item resumen-total">
    <span>Total:</span>
    <span id="resumen-total">$6.60</span>
  </div>
  <form id="form-factura" action="factura.php" method="post" style="width:100%;margin-top:10px;">
    <input type="hidden" name="productos" id="input-productos">
    <input type="hidden" name="envio" id="input-envio">
    <input type="hidden" name="itbms" id="input-itbms">
    <input type="hidden" name="total" id="input-total">
    <input type="hidden" name="cliente" id="input-cliente">
    <input type="hidden" name="direccion" id="input-direccion">
    <button type="submit" class="btn-pedir" id="btn-pedir">Pedir</button>
  </form>
</div>
      </div>
    </main>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
  <script src="qr-generator.js"></script>
  <script>
    // Selección visual y guardado del método de pago
    const buttons = document.querySelectorAll('.payment-button');
    let metodoSeleccionado = localStorage.getItem('metodoPago') || '';
    function marcarSeleccion() {
      buttons.forEach(btn => {
        if (btn.dataset.metodo === metodoSeleccionado) {
          btn.classList.add('selected');
        } else {
          btn.classList.remove('selected');
        }
      });
    }
    buttons.forEach(btn => {
      btn.addEventListener('click', async () => {
        metodoSeleccionado = btn.dataset.metodo;
        localStorage.setItem('metodoPago', metodoSeleccionado);
        marcarSeleccion();
        if (btn.dataset.metodo === 'yappy') {
          const qrData = 'https://yappy.pagoseguro.com/ElCallejon'; // <-- Cambia esto por el dato real que usas para Yappy
          window.showYappyQRDialog(qrData);
        }
      });
    });
    marcarSeleccion();
    // --- DEMO: Productos seleccionados ---
// Esto normalmente vendría de tu backend o localStorage. Aquí es ejemplo.
const productosDemo = [
  { nombre: 'Hamburguesa Clásica', cantidad: 2, precio: 4.50 },
  { nombre: 'Papas Fritas', cantidad: 1, precio: 2.00 },
  { nombre: 'Soda', cantidad: 3, precio: 1.10 }
];
// --- END DEMO ---

function renderProductosTabla(productos) {
  const tbody = document.getElementById('productos-listado');
  tbody.innerHTML = '';
  let totalProductos = 0;
  productos.forEach(prod => {
    const subtotal = prod.precio * prod.cantidad;
    totalProductos += subtotal;
    const tr = document.createElement('tr');
    tr.innerHTML = `<td>${prod.nombre}</td><td style='text-align:right;'>${prod.cantidad}</td><td style='text-align:right;'>$${prod.precio.toFixed(2)}</td><td style='text-align:right;'>$${subtotal.toFixed(2)}</td>`;
    tbody.appendChild(tr);
  });
  return totalProductos;
}

// Inicializa valores de resumen
const envio = 0.00;
const itbms = 0.10;
const totalProductos = renderProductosTabla(productosDemo);
document.getElementById('resumen-envio').textContent = `$${envio.toFixed(2)}`;
document.getElementById('resumen-itbms').textContent = `$${itbms.toFixed(2)}`;
const total = totalProductos + envio + itbms;
document.getElementById('resumen-total').textContent = `$${total.toFixed(2)}`;

// --- Envío de datos a factura.php ---
const formFactura = document.getElementById('form-factura');
formFactura.addEventListener('submit', function(e) {
  if (!metodoSeleccionado) {
    e.preventDefault();
    alert('Por favor, selecciona un método de pago.');
    return false;
  }
  // Puedes obtener estos datos reales de inputs o localStorage
  document.getElementById('input-productos').value = JSON.stringify(productosDemo);
  document.getElementById('input-envio').value = envio;
  document.getElementById('input-itbms').value = itbms;
  document.getElementById('input-total').value = total;
  document.getElementById('input-cliente').value = 'Cliente Demo'; // Cambia por el real
  document.getElementById('input-direccion').value = 'Dirección Demo'; // Cambia por el real
});
    // (Opcional) Aquí puedes cargar los valores del resumen desde localStorage o PHP si lo deseas
  </script>
</body>
</html>
