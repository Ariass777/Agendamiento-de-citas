<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Finalizar Compra - Silvia Peluquería</title>
    <script src="https://sdk.mercadopago.com/js/v2"></script>
</head>
<body style="background-color:#121212;color:#fff;text-align:center;font-family:Poppins,sans-serif;">
<h1>Confirmar tu Compra</h1>
<p>Revisando tus productos...</p>
<div id="wallet_container"></div>

<script>
    const mp = new MercadoPago("{{ config('services.mercadopago.public_key') }}", {
        locale: 'es-CO'
    });

    const cart = JSON.parse(localStorage.getItem('silvia_cart')) || [];

    fetch("{{ route('checkout.create') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ items: cart })
    })
        .then(res => res.json())
        .then(data => {
            mp.bricks().create("wallet", "wallet_container", {
                initialization: {
                    preferenceId: data.id
                },
            });
        });
</script>
</body>
</html>
