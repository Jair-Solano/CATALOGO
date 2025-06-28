<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Carrito</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .payment-method {
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .payment-method:hover {
            border-color: #0d6efd;
            background-color: #f8f9fa;
        }
        .payment-method.selected {
            border-color: #0d6efd;
            background-color: #e7f1ff;
        }
        .payment-icon {
            font-size: 1.5rem;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <h1 class="mb-4">Tu Carrito</h1>
        
        <div class="row">
            <div class="col-md-8">
                <!-- Productos -->
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title mb-0">PRODUCTO</h5>
                            <span class="text-muted">Precio</span>
                        </div>
                        
                        <!-- Producto 1 -->
                        <div class="d-flex justify-content-between align-items-center py-3 border-bottom">
                            <div class="d-flex align-items-center">
                                <button class="btn btn-outline-danger me-3" title="Eliminar producto">
                                    <i class="bi bi-trash"></i>
                                </button>
                                <div>
                                    <h6 class="mb-1">Analog Magazine Rock Red</h6>
                                    <div class="input-group" style="width: 120px;">
                                        <button class="btn btn-outline-secondary" type="button">-</button>
                                        <input type="text" class="form-control text-center" value="2">
                                        <button class="btn btn-outline-secondary" type="button">+</button>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <div>$120</div>
                                <strong>$240</strong>
                            </div>
                        </div>
                        
                        <!-- Producto 2 -->
                        <div class="d-flex justify-content-between align-items-center py-3 border-bottom">
                            <div class="d-flex align-items-center">
                                <button class="btn btn-outline-danger me-3" title="Eliminar producto">
                                    <i class="bi bi-trash"></i>
                                </button>
                                <div>
                                    <h6 class="mb-1">Closca Helmet Black</h6>
                                    <div class="input-group" style="width: 120px;">
                                        <button class="btn btn-outline-secondary" type="button">-</button>
                                        <input type="text" class="form-control text-center" value="1">
                                        <button class="btn btn-outline-secondary" type="button">+</button>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <div>$132</div>
                                <strong>$132</strong>
                            </div>
                        </div>
                        
                        <!-- Producto 3 -->
                        <div class="d-flex justify-content-between align-items-center py-3">
                            <div class="d-flex align-items-center">
                                <button class="btn btn-outline-danger me-3" title="Eliminar producto">
                                    <i class="bi bi-trash"></i>
                                </button>
                                <div>
                                    <h6 class="mb-1">Sigg Water Bottle Gravel Black</h6>
                                    <div class="input-group" style="width: 120px;">
                                        <button class="btn btn-outline-secondary" type="button">-</button>
                                        <input type="text" class="form-control text-center" value="2">
                                        <button class="btn btn-outline-secondary" type="button">+</button>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <div>$23</div>
                                <strong>$46</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <!-- Resumen del pedido -->
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Resumen del Pedido</h5>
                        
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span>$418</span>
                        </div>
                        
                        <div class="d-flex justify-content-between mb-3">
                            <span>Envío</span>
                            <span class="text-success">Gratis</span>
                        </div>
                        
                    
                        
                        <div class="d-flex justify-content-between fw-bold fs-5 mb-4">
                            <span>Total</span>
                            <span>$418</span>
                        </div>
                        
                        <a href="#procesarPago" class="btn btn-primary w-100 py-2">PROCESAR PAGO</a>

                        
                        <div class="mt-3 text-center">
                            <small class="text-muted">Al proceder con el pago, aceptas nuestros <a href="#">Términos y Condiciones</a></small>
                        </div>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title mb-3">Garantía de compra</h6>
                        <div class="d-flex">
                            <i class="bi bi-shield-check text-success me-2" style="font-size: 1.5rem;"></i>
                            <div>
                                <small>Compra protegida con nuestro sistema de seguridad. Reembolso garantizado si no recibes tu pedido.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Script para seleccionar método de pago
        document.querySelectorAll('.payment-method').forEach(method => {
            method.addEventListener('click', function() {
                document.querySelectorAll('.payment-method').forEach(m => {
                    m.classList.remove('selected');
                });
                this.classList.add('selected');
                const radio = this.querySelector('input[type="radio"]');
                if (radio) {
                    radio.checked = true;
                }
            });
        });
    </script>
</body>
</html>