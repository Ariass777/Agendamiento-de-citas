<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\MPApiException;

class CheckoutController extends Controller
{
    /**
     * Configura el token de acceso de Mercado Pago al inicializar el controlador.
     */
    public function __construct()
    {
        // Configuración segura: el token se lee desde config/services.php
        MercadoPagoConfig::setAccessToken(config('services.mercadopago.access_token'));
    }

    /**
     * Muestra la vista del formulario de checkout.
     */
    public function index()
    {
        return view('tienda.checkout-form');
    }

    /**
     * Prepara los ítems del carrito, incluyendo el costo de envío.
     */
    private function prepareItemsForMercadoPago(string $cartItemsJson): array
    {
        $cart = json_decode($cartItemsJson, true) ?? [];
        $items = [];
        $shippingCost = 10000; //  Costo fijo de envío 

        foreach ($cart as $item) {
            $items[] = [
                "title" => $item['name'] ?? 'Producto sin nombre',
                "quantity" => (int)($item['quantity'] ?? 1),
                "unit_price" => round((float)($item['price'] ?? 0), 2),
                "currency_id" => "COP"
            ];
        }

        // Agregar costo de envío como ítem adicional
        if (!empty($items)) {
            $items[] = [
                "title" => "Costo de Envío Nacional",
                "quantity" => 1,
                "unit_price" => (float)$shippingCost,
                "currency_id" => "COP"
            ];
        }

        return $items;
    }

    /**
     * Crea la preferencia de pago en Mercado Pago.
     */
    public function processOrder(Request $request)
    {
        //  Obtener ítems del carrito
        $cartItemsJson = $request->input('cart_items');
        $items = $this->prepareItemsForMercadoPago($cartItemsJson);

        //  Datos del cliente
        $payerData = [
            "name" => $request->input('name', 'Cliente'),
            "email" => $request->input('email'),
            "phone" => [
                "area_code" => "57", // Colombia 🇨🇴
                "number" => preg_replace('/\D/', '', $request->input('phone')), // Limpia caracteres no numéricos
            ],
        ];

        // Validación
        if (empty($items) || empty($payerData['email'])) {
            return redirect()
                ->route('tienda.index')
                ->with('error', 'El carrito está vacío o la información de contacto está incompleta.');
        }

        try {
            $client = new PreferenceClient();

            //  Crear preferencia
            $preference = $client->create([
                "items" => $items,
                "payer" => $payerData,
                "back_urls" => [
                    "success" => route('checkout.success'),
                    "failure" => route('checkout.failure'),
                    "pending" => route('checkout.pending'),
                ],
                "auto_return" => "approved",
                
            ]);

            // Redirigir al checkout de Mercado Pago
            return redirect()->away($preference->init_point);

        } catch (MPApiException $e) {
            //  Error API Mercado Pago
            \Log::error("Mercado Pago API error", ['details' => $e->getMessage()]);
            return redirect()
                ->route('tienda.index')
                ->with('error', 'Error con la API de Mercado Pago. Ver logs para más detalles.');
        } catch (\Exception $e) {
            //  Error general
            \Log::error("Error general en pago", ['details' => $e->getMessage()]);
            return redirect()
                ->route('tienda.index')
                ->with('error', 'Error interno al procesar el pago.');
        }
    }

    /**
     * Retorno: Pago exitoso.
     */
    public function success(Request $request)
    {
        return view('checkout.success_page', ['pago' => $request->all()]);
    }

    /**
     * Retorno: Pago fallido.
     */
    public function failure(Request $request)
    {
        return view('checkout.failure_page');
    }

    /**
     * Retorno: Pago pendiente.
     */
    public function pending(Request $request)
    {
        return view('checkout.pending_page');
    }
}
