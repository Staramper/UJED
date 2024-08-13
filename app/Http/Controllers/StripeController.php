<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use App\Models\Cart;
use Stripe\Checkout\Session as StripeSession;

class StripeController extends Controller
{
    public function __construct()
    {
        // Configura la clave secreta de Stripe
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
    }

    public function createCheckoutSession(Request $request)
{
    $userId = auth()->user()->id; // Obtener el ID del usuario autenticado

    // Obtener los artículos del carrito para el usuario actual
    $cartItems = Cart::where('id_user', $userId)
        ->with('product') // Cargar la relación con el producto
        ->get();

    // Verifica que haya elementos en el carrito
    if ($cartItems->isEmpty()) {
        return response()->json(['msg' => 'No hay productos en el carrito'], 400);
    }

    // Crear los line_items para Stripe usando los datos del carrito
    $lineItems = [];
    foreach ($cartItems as $item) {
        $lineItems[] = [
            'price_data' => [
                'currency' => 'mxn',
                'product_data' => [
                    'name' => $item->product->prd_title,
                    'images' => [$item->product->prd_picture], // URL de la imagen del producto
                ],
                'unit_amount' => (int)($item->product->prd_price * 100), // Convertir a centavos y asegurarse de que sea un entero
            ],
            'quantity' => (int)$item->amount, // Asegurarse de que la cantidad sea un entero
        ];
    }

    try {
        // Crear la sesión de pago con Stripe
        // $url = axios.post('/create-checkout-session')

        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => url('mostrarcompra'), // URL de éxito
            'cancel_url' => url('/cart'),   // URL de cancelación
            'metadata' => [
                'user_id' => $userId,
            ],
        ]);

        // Retornar el ID de la sesión
        return response()->json(['id' => $session->id]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

public function webhookStripe(Request $request)
    {
        \Log::info('Webhook Stripe Request', [
            'method' => $request->method(),
            'payload' => $request->all(),
        ]);
        
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $endpointSecret = env('STRIPE_WEBHOOK_SECRET');

        try {
            // Verificar la firma del evento
            $event = Webhook::constructEvent(
                $payload, $sigHeader, $endpointSecret
            );
        } catch (SignatureVerificationException $e) {
            // Firma no válida
            return response()->json(['error' => 'Webhook signature verification failed'], 400);
        }

        // Maneja el evento según su tipo
        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;
                
                // Aquí puedes llamar a tu función para procesar la compra, como `mostrarcompra`
                $this->procesarCompra($session);
                break;
            // Agrega otros tipos de eventos que quieras manejar

            default:
                // Log para eventos no manejados
                \Log::info('Evento de Stripe no manejado: '.$event->type);
        }

        return response()->json(['status' => 'success']);
    }

    protected function procesarCompra($session)
    {
        // Aquí puedes ejecutar la lógica de `mostrarcompra`
        $cartController = new CartController();
        $cartController->mostrarcompra();
    }


}
