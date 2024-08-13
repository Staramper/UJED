import Stripe from "stripe";
import { WEBHOOK_SECRET_KEY } from "../config.js"; // Asegúrate de tener tu clave secreta en config.js
import { pool } from "../db.js"; // Asumiendo que tienes una conexión a tu base de datos

const stripe = new Stripe(process.env.STRIPE_SECRET_KEY); // Asegúrate de tener la clave secreta en tus variables de entorno

// Crear una sesión de checkout
export const createCheckoutSession = async (req, res) => {
    const cliente_id = req.user.usuario_id; // Obtener el ID del cliente desde el usuario autenticado

    try {
        // Obtener resumen y datos necesarios para la compra
        const [cartItems] = await pool.query(`
            SELECT
                p.nombre_producto, p.precio, dc.cantidad
            FROM
                detalle_carrito dc
            JOIN
                productos p ON dc.FK_producto_id = p.producto_id
            WHERE
                dc.FK_cliente_id = ? AND dc.FK_carrito_compra_id = (
                    SELECT
                        carrito_compra_id FROM carrito_compra WHERE FK_cliente_id = ? AND estatus = 'pendiente'
                )   
        `, [cliente_id, cliente_id]);

        if (cartItems.length === 0) {
            return res.status(400).json({ msg: "No hay productos en el carrito" });
        }

        // Crear los line_items para Stripe usando los datos del carrito
        const line_items = cartItems.map(item => ({
            price_data: {
                currency: 'mxn',
                product_data: {
                    name: item.nombre_producto,
                },
                unit_amount: item.precio * 100, // Convertir a centavos
            },
            quantity: item.cantidad
        }));

        // Crear la sesión de pago con Stripe
        const session = await stripe.checkout.sessions.create({
            payment_method_types: ["card"],
            line_items,
            mode: "payment",
            success_url: 'http://localhost:3000/success.html',
            cancel_url: 'http://localhost:3000/cancel.html',
            metadata: {
                cliente_id: cliente_id
            }
        });

        // Retornar la sesión creada
        res.status(200).json({
            id: session.id,
            session
        });
    } catch (error) {
        console.error(error);
        res.status(500).json({
            message: "Error al crear la sesión de pago",
            error: error.message
        });
    }
};

// Manejar el webhook de Stripe
export const webhookStripe = async (req, res) => {
    const sig = req.headers['stripe-signature'];
    const endpointSecret = STRIPE_WEBHOOK_SECRET;

    let event;

    try {
        event = stripe.webhooks.constructEvent(req.body, sig, endpointSecret);
    } catch (error) {
        console.error(error);
        return res.status(400).json({
            message: "Error al verificar la firma del webhook",
        });
    }

    // Manejar el evento según su tipo
    switch (event.type) {
        case 'checkout.session.completed':
            const session = event.data.object;
            console.log('Session completed:', session);
            // Aquí puedes manejar la lógica para guardar la orden en tu base de datos
            break;
        default:
            console.log(`Unhandled event type: ${event.type}`);
    }

    res.json({ received: true });
};
