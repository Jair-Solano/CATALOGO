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
      width: 95%; max-width: 850px;
      margin: 40px auto;
      padding: 36px 44px;
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
      flex: 1 1 200px; min-width: 180px; max-width: 260px;
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
              <button class="payment-button" data-metodo="tarjeta">Tarjeta</button>
              <button class="payment-button" data-metodo="transferencia">Transferencia</button>
            </div>
          </div>
        </div>
        <!-- Columna derecha: resumen -->
        <div class="resumen-section">
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
          <button class="btn-pedir" id="btn-pedir">Pedir</button>
        </div>
      </div>
    </main>
  </div>
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
      btn.addEventListener('click', () => {
        metodoSeleccionado = btn.dataset.metodo;
        localStorage.setItem('metodoPago', metodoSeleccionado);
        marcarSeleccion();
      });
    });
    marcarSeleccion();
    // Botón pedir (valida selección y muestra confirmación)
    document.getElementById('btn-pedir').addEventListener('click', function() {
      if (!metodoSeleccionado) {
        alert('Por favor, selecciona un método de pago.');
        return;
      }
      // Aquí puedes hacer una petición AJAX o redirigir a la siguiente página PHP
      alert('Método de pago seleccionado: ' + metodoSeleccionado + '\n¡Pedido realizado con éxito!');
    });
    // (Opcional) Aquí puedes cargar los valores del resumen desde localStorage o PHP si lo deseas
  </script>
</body>
</html>
