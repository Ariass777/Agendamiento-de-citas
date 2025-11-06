@extends('layouts.app') 

@section('content')

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="text-center mb-4">Finalizar Compra</h1>

            @if(session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            
            <div id="cart-summary" class="card p-3 mb-4">
                <h5>Resumen del Pedido</h5>
                <p id="total-text">Cargando...</p>
                <a href="{{ route('tienda.index') }}" class="btn btn-sm btn-link">Modificar Carrito</a>
            </div>

            <div class="card p-4 shadow-sm">
                <h3 class="mb-3">1. Datos del Comprador</h3>
                
                <form id="payer-form" method="POST" action="{{ route('checkout.process') }}">
                    @csrf
                    
                    <input type="hidden" name="cart_items" id="cart-items-input" value="">

                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre Completo</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email (Requerido por Mercado Pago)</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Teléfono (Ej: 3001234567)</label>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Ejemplo: +573001234567" required>
                        <small class="form-text text-muted">Asegúrate de incluir el código de país (Ej. +57).</small>
                    </div>

                    <hr>

                    <h3 class="mb-3">2. Envío</h3>
                    <div class="alert alert-info">
                        <strong>Envío Nacional:</strong> $10.000 COP
                    </div>
                    
                    <hr>

                    <button type="submit" id="submit-button" class="btn btn-warning btn-lg w-100">
                        Pagar [Cargando Total...] con Mercado Pago
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // **Script para cargar y validar los datos del carrito antes de enviar**
    document.addEventListener('DOMContentLoaded', function() {
        const cartItemsInput = document.getElementById('cart-items-input');
        const submitButton = document.getElementById('submit-button');
        const totalText = document.getElementById('total-text');
        
        // 1. Obtener datos del carrito
        const cartJson = localStorage.getItem('silvia_cart');
        let cart = [];
        const shippingCost = 10000;
        let total = 0;

        if (cartJson) {
            try {
                cart = JSON.parse(cartJson);
            } catch (e) {
                console.error("Error al parsear el carrito de localStorage", e);
            }
        }

        // 2. Validar y calcular total
        if (cart.length === 0) {
            alert('El carrito está vacío. Serás redirigido a la tienda.');
            window.location.href = '{{ route('tienda.index') }}';
            return;
        }

        // 3. Preparar y Mostrar el Total
        cart.forEach(item => {
            // Asumiendo que el precio ya está en formato numérico entero (25000, 44000, etc.)
            total += item.price * item.quantity; 
        });
        
        // Sumar el costo de envío
        total += shippingCost;

        // Formato para mostrar al usuario (solo visual)
        const formattedTotal = total.toLocaleString('es-CO', { 
            style: 'currency', 
            currency: 'COP', 
            minimumFractionDigits: 0 
        });

        totalText.innerHTML = `<strong>Total a Pagar (Incluye Envío):</strong> ${formattedTotal}`;
        submitButton.innerHTML = `Pagar ${formattedTotal} con Mercado Pago`;

        // 4. Inyectar datos en el campo oculto
        // Se envía el JSON de los productos que necesita el controlador para reconstruir la preferencia
        cartItemsInput.value = cartJson;

    });
</script>

@endsection