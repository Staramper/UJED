<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order2;
use Illuminate\Http\Request;

class Order2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function list_products(int $id)
    {

        $orders = Order2::join('orders', 'order2s.num_order', '=', 'orders.num')
                    ->where('order2s.num_order', $id)
                    ->select('order2s.*')
                    ->get();

        // return $num;
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
    public function show(Order2 $order2)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order2 $order2)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order2 $order2)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order2 $order2)
    {
        //
    }
}
