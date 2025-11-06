{{-- resources/views/tienda/index.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Productos | Silvia peluqueria</title>
    {{-- ¡IMPORTANTE! Token CSRF no es tan crucial aquí ya que solo redirige, pero se mantiene por si acaso --}}
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* [ ... Tu CSS se mantiene igual ... ] */
        body { background-color: #121212; color: #E0E0E0; font-family: 'Poppins', sans-serif; }
        .header-bg { background-color: #0a0a0a; border-bottom: 1px solid #333; }
        .header-logo { width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 2px solid #D4AF37; }
        .header-content { display: flex; align-items: center; justify-content: space-between; max-width: 1200px; margin: 0 auto; padding: 15px 20px; }
        .header-schedule { color: #AAAAAA; font-size: 0.85rem; text-align: right; padding-left: 20px; line-height: 1.4; }
        .main-content { padding: 50px 20px; max-width: 1200px; margin: auto; }
        .store-title { color: #D4AF37; font-weight: 700; margin-bottom: 40px; text-align: center; font-size: 2.5rem; text-shadow: 0 0 5px rgba(212, 175, 55, 0.5); }
        .product-card { background-color: #1c1c1c; border-radius: 8px; padding: 20px; margin-bottom: 30px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5); transition: transform 0.3s; height: 100%; display: flex; flex-direction: column; justify-content: space-between; }
        .product-card:hover { transform: translateY(-5px); }
        
        /* --- ESTILOS MODIFICADOS PARA MEJORAR LA IMAGEN --- */
        .product-image-container {
            background-color: #2e2e2e; /* Fondo oscuro sutil para la imagen, similar al de la referencia */
            border-radius: 6px;
            padding: 20px 10px; 
            margin-bottom: 15px;
            height: 280px; /* Altura fija para uniformidad */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-image { 
            width: 100%; 
            max-height: 240px; 
            height: auto; 
            object-fit: contain; 
            border-radius: 0; 
            margin: 0; 
            display: block; 
        }
        /* ------------------------------------------------ */

        .product-name { color: #D4AF37; font-size: 1.2rem; font-weight: 600; margin-top: 10px; }
        .product-price { color: #fff; font-size: 1.5rem; margin-top: 10px; font-weight: 700; }
        .btn-add-to-cart { background-color: #7d4833; color: white; border: 2px solid #5a3324; padding: 10px 20px; border-radius: 6px; transition: background-color 0.3s, border-color 0.3s; text-decoration: none; display: block; margin-top: auto; font-weight: 600; cursor: pointer; }
        .btn-add-to-cart:hover { background-color: #92543e; border-color: #D4AF37; color: white; }
        .btn-add-to-cart:disabled { background-color: #333; border-color: #555; cursor: not-allowed; color: #aaa; }
        .product-card .product-description { color: #AAAAAA; font-size: 0.95rem; min-height: 40px; }
        .inventory-display { font-size: 0.85rem; color: #AAAAAA; margin-top: 5px; margin-bottom: 10px; }
        .out-of-stock { color: #d9534f; font-weight: 600; }
        .cart-sidebar { background-color: #1c1c1c; border-radius: 8px; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5); position: sticky; top: 20px; }
        .cart-sidebar h4 { color: #D4AF37; border-bottom: 2px solid #333; padding-bottom: 10px; margin-bottom: 20px; }
        .cart-item { border-bottom: 1px dashed #333; padding: 10px 0; display: flex; justify-content: space-between; align-items: center; }
        .cart-item-details { display: flex; flex-direction: column; }
        .cart-item-name { font-size: 0.95rem; }
        .cart-item-price { font-size: 0.9rem; color: #AAAAAA; }
        .btn-remove-unit { color: #d9534f; cursor: pointer; font-size: 1.1rem; margin-left: 10px; transition: color 0.3s; }
        .btn-remove-unit:hover { color: #ff0000; }
        .cart-total { border-top: 2px solid #D4AF37; padding-top: 15px; margin-top: 15px; font-size: 1.3rem; font-weight: 700; }
        .btn-checkout { background-color: #D4AF37; color: #121212; font-weight: 700; display: block; width: 100%; padding: 15px; border-radius: 6px; margin-top: 20px; border: none; transition: background-color 0.3s; text-decoration: none; cursor: pointer; }
        .btn-checkout:hover { background-color: #e0c25a; color: #121212; }
        .btn-back { color: #AAAAAA; text-decoration: none; margin-bottom: 20px; display: inline-block; transition: color 0.3s; }
        .btn-back:hover { color: #D4AF37; }
        .cart-empty-message { color: #AAAAAA; text-align: center; padding: 20px 0; }
        .processing-message { color: #D4AF37; text-align: center; padding: 10px 0; }
        footer { background-color: #0a0a0a; color: #555; padding: 20px 0; font-size: 0.8rem; border-top: 1px solid #333; text-align: center; }
    </style>
</head>
<body>

    <header class="header-bg">
        <div class="header-content">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo Silvia Peluquería" class="header-logo">
            <p class="header-schedule">
                <i class="far fa-clock text-warning me-1"></i> HORARIOS DE ATENCIÓN: <br> Domingo a domingo, 8:00 AM - 9:00 PM
            </p>
        </div>
    </header>
    <div class="main-content">
        
        <a href="{{ url('/') }}" class="btn-back">
            <i class="fas fa-chevron-left me-2"></i> Volver a Reservas
        </a>
        <h1 class="store-title">Explora Nuestros Productos Capilares Exclusivos</h1>
        
        <div class="row">
            
            <div class="col-lg-8">
                <div class="row" id="product-list">
                    
                    {{-- Producto 1: Shampoo Reparador --}}
                    <div class="col-lg-6 col-md-6 mb-4">
                        <div class="product-card text-center" data-id="1" data-name="Shampoo Reparador" data-price="25000">
                            <div>
                                <div class="product-image-container">
                                    <img src="{{ asset('images/shampoo.jpg') }}" alt="Shampoo de Lujo" class="product-image"> 
                                </div>
                                <h5 class="product-name">Shampoo Reparador con Keratina</h5>
                                <p class="product-description">Fórmula enriquecida para cabellos dañados y secos.</p>
                            </div>
                            <div>
                                <div class="product-price">$25.000 COP</div>
                                <div class="inventory-display" data-inventory-id="1"></div>
                                <button class="btn-add-to-cart" data-id="1" onclick="addItem(this)">
                                    <i class="fas fa-cart-plus me-2"></i> Añadir al Carrito
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Producto 2: Acondicionador --}}
                    <div class="col-lg-6 col-md-6 mb-4">
                        <div class="product-card text-center" data-id="2" data-name="Acondicionador Ultra Hidratante" data-price="22000">
                            <div>
                                <div class="product-image-container">
                                    <img src="{{ asset('images/Acondicionador.jpg') }}" alt="Acondicionador Premium" class="product-image"> 
                                </div>
                                <h5 class="product-name">Acondicionador Ultra Hidratante</h5>
                                <p class="product-description">Desenreda y aporta brillo sin apelmazar el cabello.</p>
                            </div>
                            <div>
                                <div class="product-price">$22.000 COP</div>
                                <div class="inventory-display" data-inventory-id="2"></div>
                                <button class="btn-add-to-cart" data-id="2" onclick="addItem(this)">
                                    <i class="fas fa-cart-plus me-2"></i> Añadir al Carrito
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Producto 3: Mascarilla --}}
                    <div class="col-lg-6 col-md-6 mb-4">
                        <div class="product-card text-center" data-id="3" data-name="Mascarilla Restauradora de Oro" data-price="45000">
                            <div>
                                <div class="product-image-container">
                                    <img src="{{ asset('images/mascarilla.jpg') }}" alt="Mascarilla Capilar" class="product-image"> 
                                </div>
                                <h5 class="product-name">Mascarilla Restauradora de Oro</h5>
                                <p class="product-description">Tratamiento intensivo para una regeneración profunda.</p>
                            </div>
                            <div>
                                <div class="product-price">$45.000 COP</div>
                                <div class="inventory-display" data-inventory-id="3"></div>
                                <button class="btn-add-to-cart" data-id="3" onclick="addItem(this)">
                                    <i class="fas fa-cart-plus me-2"></i> Añadir al Carrito
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Producto 4: Serum --}}
                    <div class="col-lg-6 col-md-6 mb-4">
                        <div class="product-card text-center" data-id="4" data-name="Serum de Brillo de Seda" data-price="30000">
                            <div>
                                <div class="product-image-container">
                                    <img src="{{ asset('images/serum.jpg') }}" alt="Serum de Brillo" class="product-image"> 
                                </div>
                                <h5 class="product-name">Serum de Brillo de Seda</h5>
                                <p class="product-description">Acabado profesional y protección térmica.</p>
                            </div>
                            <div>
                                <div class="product-price">$30.000 COP</div>
                                <div class="inventory-display" data-inventory-id="4"></div>
                                <button class="btn-add-to-cart" data-id="4" onclick="addItem(this)">
                                    <i class="fas fa-cart-plus me-2"></i> Añadir al Carrito
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="cart-sidebar">
                    <h4><i class="fas fa-shopping-basket me-2"></i> Tu Carrito</h4>
                    
                    <div id="cart-items-container" class="cart-items">
                        <p class="cart-empty-message" id="cart-empty-message">El carrito está vacío. ¡Añade productos!</p>
                    </div>
                    
                    <div class="cart-total">
                        <span>Total a Pagar:</span>
                        <span id="cart-total" class="float-end">$0 COP</span>
                    </div>
                    
                    {{-- Botón de Checkout MODIFICADO --}}
                    <button id="btn-checkout" class="btn-checkout text-center" onclick="redirectToCheckout()" disabled>
                        <i class="fas fa-money-check-alt me-2"></i> Continuar con el Pago
                    </button>
                    
                    <p id="payment-status-message" class="processing-message" style="display: none;"></p>
                    
                </div>
            </div>
        </div>
    </div>
    
    <footer>
        <div class="container">
            © 2025 Silvia Peluquería — Todos los derechos reservados
        </div>
    </footer>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // ------------------------------------------------------------------------------------------------
        // 1. INVENTARIO
        // ------------------------------------------------------------------------------------------------
        let productInventory = {
            '1': 5, '2': 3, '3': 2, '4': 10 
        };

        if (localStorage.getItem('silvia_inventory')) {
            productInventory = JSON.parse(localStorage.getItem('silvia_inventory'));
        }

        function saveInventory() {
            localStorage.setItem('silvia_inventory', JSON.stringify(productInventory));
        }

        function renderInventory() {
            Object.keys(productInventory).forEach(id => {
                const displayElement = document.querySelector(`.inventory-display[data-inventory-id="${id}"]`);
                const addButton = document.querySelector(`.btn-add-to-cart[data-id="${id}"]`);
                const stock = productInventory[id];

                if (displayElement) {
                    if (stock > 0) {
                        displayElement.innerHTML = `Stock disponible: <strong>${stock}</strong>`;
                        displayElement.classList.remove('out-of-stock');
                        if (addButton) {
                            addButton.disabled = false;
                            addButton.innerHTML = '<i class="fas fa-cart-plus me-2"></i> Añadir al Carrito';
                        }
                    } else {
                        displayElement.innerHTML = `<span class="out-of-stock">¡AGOTADO!</span>`;
                        displayElement.classList.add('out-of-stock');
                        if (addButton) {
                            addButton.disabled = true;
                            addButton.textContent = 'Agotado';
                        }
                    }
                }
            });
        }


        // ------------------------------------------------------------------------------------------------
        // 2. CARRITO
        // ------------------------------------------------------------------------------------------------
        let cart = JSON.parse(localStorage.getItem('silvia_cart')) || [];
        const cartContainer = document.getElementById('cart-items-container');
        const cartTotalDisplay = document.getElementById('cart-total');
        const emptyMessage = document.getElementById('cart-empty-message');
        const checkoutButton = document.getElementById('btn-checkout');
        const paymentMessage = document.getElementById('payment-status-message');
        const SHIPPING_COST = 10000; // Costo de envío fijo

        function addItem(button) {
            const id = button.dataset.id;
            const productCard = button.closest('.product-card');
            const name = productCard.dataset.name;
            // Asegúrate de que el precio sea numérico (float)
            const price = parseFloat(productCard.dataset.price); 

            if (productInventory[id] > 0) {
                productInventory[id] -= 1;
                saveInventory();
                renderInventory();

                const existingItem = cart.find(item => item.id === id);
                if (existingItem) {
                    existingItem.quantity += 1;
                } else {
                    // Importante: almacenar el precio como número
                    cart.push({ id, name, price, quantity: 1 }); 
                }

                saveCart();
                renderCart();
            }
        }

        function removeUnit(id) {
            const itemToRemove = cart.find(item => item.id === id);
            
            if (itemToRemove && itemToRemove.quantity > 0) {
                productInventory[id] += 1;
                saveInventory();
                renderInventory(); 

                itemToRemove.quantity -= 1;

                if (itemToRemove.quantity === 0) {
                    cart = cart.filter(item => item.id !== id);
                }
            }
            
            saveCart();
            renderCart();
        }

        function saveCart() {
            localStorage.setItem('silvia_cart', JSON.stringify(cart));
        }

        function renderCart() {
            cartContainer.innerHTML = ''; 
            let total = 0;

            if (cart.length === 0) {
                emptyMessage.style.display = 'block';
                cartTotalDisplay.textContent = '$0 COP';
                checkoutButton.disabled = true;
                return;
            }

            emptyMessage.style.display = 'none';
            checkoutButton.disabled = false;

            cart.forEach(item => {
                const subtotal = item.price * item.quantity;
                total += subtotal;

                const itemElement = document.createElement('div');
                itemElement.classList.add('cart-item');
                itemElement.innerHTML = `
                    <div class="cart-item-details">
                        <span class="cart-item-name">${item.name} (x${item.quantity})</span>
                        <span class="cart-item-price">$${item.price.toLocaleString('es-CO')}</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <span class="text-warning">$${subtotal.toLocaleString('es-CO')}</span>
                        <i class="fas fa-minus-circle btn-remove-unit" onclick="removeUnit('${item.id}')" title="Eliminar una unidad"></i>
                    </div>
                `;
                cartContainer.appendChild(itemElement);
            });

            // Mostrar y sumar costo de envío
            const shippingElement = document.createElement('div');
            shippingElement.classList.add('cart-item');
            shippingElement.innerHTML = `
                <div class="cart-item-details">
                    <span class="cart-item-name">Costo de Envío</span>
                    <span class="cart-item-price">Envío Nacional</span>
                </div>
                <div class="d-flex align-items-center">
                    <span class="text-warning">$${SHIPPING_COST.toLocaleString('es-CO')}</span>
                </div>
            `;
            cartContainer.appendChild(shippingElement);
            
            total += SHIPPING_COST;

            cartTotalDisplay.textContent = `$${total.toLocaleString('es-CO')} COP`;
        }
        
        // ------------------------------------------------------------------------------------------------
        // 3. FLUJO DE PAGO MODIFICADO: REDIRECCIÓN
        // ------------------------------------------------------------------------------------------------
        /**
         * Guarda el carrito y redirige al nuevo formulario de datos del cliente.
         */
        function redirectToCheckout() { 
            if (cart.length === 0) {
                alert('El carrito está vacío. ¡Añade productos para continuar!');
                return;
            }
            
            // 1. Guardar el carrito en localStorage antes de la redirección
            saveCart(); 
            
            // 2. Redirigir al formulario de datos del cliente (ruta: checkout.index)
            // Asegúrate de que 'checkout.index' esté definida en tu Laravel.
            window.location.href = '{{ route('checkout.index') }}'; 
        }

        // Si el botón HTML aún llama a processPayment(), usamos esta función puente.
        function processPayment() {
            redirectToCheckout();
        }
        
        // ------------------------------------------------------------------------------------------------
        // 4. INICIALIZACIÓN
        // ------------------------------------------------------------------------------------------------

        document.addEventListener('DOMContentLoaded', () => {
            // Muestra cualquier mensaje de error devuelto por el controlador después de una redirección
            @if(session('error'))
                alert("Error de Pago: {{ session('error') }}");
            @endif
            
            renderInventory(); 
            renderCart(); 
        });

    </script>
    
</body>
</html>