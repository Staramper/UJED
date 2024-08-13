<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function list_orders()
    {
        // Obtener el usuario autenticado
        $user = auth()->user();

        // Verificar el rol del usuario
        if ($user->role === 'admin') {
            // Si el usuario es admin, obtener todas las órdenes junto con el correo del usuario
            $orders = Order::join('users', 'orders.id_user', '=', 'users.id')
                           ->select('orders.*', 'users.email as user_email')
                           ->get();
        } else {
            // Si el usuario no es admin, obtener solo sus órdenes junto con su correo
            $orders = Order::join('users', 'orders.id_user', '=', 'users.id')
                           ->select('orders.*', 'users.email as user_email')
                           ->where('orders.id_user', $user->id)
                           ->get();
        }
    
        return $orders;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $id)
    {
        $id->update($request->all());
    }

    public function decline(Request $request, Order $id)
    {
        // Cambiar el campo status a 'd' para la orden con el ID proporcionado
        $id->update(['status' => 'D']);
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
