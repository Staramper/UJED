<?php 

namespace App\custom;

class CalVent 
{

public function Calculate($carts) 
    {

		// Inicializar la variable para el total
        $totalAmount = 0;
        $totalProducts = 0;

        // Iterar sobre cada producto en el carrito
        foreach ($carts as $item) {
            $totalProducts += $item['amount'];
            $totalAmount += $item['amount'] * $item['prd_price'];
        }

        // Mostrar el total de productos
        return [
            'totalProducts' => $totalProducts,
            'totalAmount' => $totalAmount
        ];

    }
}