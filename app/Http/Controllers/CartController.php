<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Order2;
use App\Models\Product;
use Illuminate\Http\Request;

use App\custom\CalVent;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getcarrito()
    {
        // LLAMAR A LA FUNCION CALVENT
        $cvts = new CalVent();
        
        // SELECCIONAR LOS CAMPOS A PEDIR
        $campos = [
            'carts.id',
            'carts.id_product',
            'carts.amount', 
            'products.prd_title', 
            'products.prd_picture',
            'products.prd_desc',
            'products.prd_price',   
        ];

        // REALIZAR LA CONSULTA
        $carts = Cart::select($campos)
            ->join('products', 'carts.id_product', '=', 'products.id')
            ->where('carts.id_user','=', auth()->user()->id)
            ->orderBy('products.prd_title')->get();

        // REALIZAR LA SUMA DE LOS PRODUCTOS
        $total = $cvts->Calculate($carts->toArray());

        // RETORNARLOS LOS VALORES A LA RUTA
        return [
            'carts' => $carts,
            'total' => $total
        ];
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

        $data = $request->All();
        // return($data->pid);
        
         // Obtener el ID del producto y la cantidad a agregar
         $productId = $request->input('pid');
         $amount = $request->input('amount', 1); // Por defecto 1 si no se especifica
 
         // Buscar o crear la entrada en el carrito
         $cartItem = Cart::updateOrCreate(
             [
                 'id_user' => auth()->user()->id,
                 'id_product' => $productId,
             ],
             [
                 'amount' => \DB::raw("amount + $amount")
             ]
         );

        // Cart::create([
        //     'id_user' => auth()->user()->id,
        //     'id_product' => $request->input('pid'),
        //     'amount' => $request->input('amount'),
        // ]);

    }

    public function sumar(Request $request, Cart $id)
    {

        $id->update($request->all());
    }

    public function restar(Request $request, Cart $id)
    {

        $id->update($request->all());
    }

    
    public function mostrarcompra()
    {

    $user = auth()->user();
    $userId = auth()->user()->id;
    $userEmail = auth()->user()->email;

    // Obtener todas las entradas del carrito para el usuario actual con los detalles del producto
    $cartItems = Cart::where('id_user', $userId)
    ->with('product') // Cargar la relación con el producto
    ->get();

    $lastOrder = Order::orderBy('num', 'desc')->first();
    $lastNumOrder = $lastOrder ? intval($lastOrder->num) + 1 : 1;
    
    // return $lastNumOrder;

    $total = 0;
    $Ftotal = 0;

    

    // O si quieres concatenar con separadores específicos
    $fullAddress = implode(', ', array_filter([
        // $user->cp,
        // $user->state,
        $user->municipality,
        $user->cologne,
        $user->street,
        $user->outer_number,
        $user->interior_number
    ]));


    // Agregar un número de índice a cada elemento del carrito
    foreach ($cartItems as $key => $item) {

        $item->index = $key + 1;
    
        $total = $item->product->prd_price * $item->amount;
        $Ftotal = $Ftotal + $total; 

        Order2::create([
            'num_order' => $lastNumOrder,
            'partida' => $key,
            'id_product' => $item->id_product,
            'title' => $item->product->prd_title,
            'picture' => $item->product->prd_picture,
            'amount' => $item->amount,
            'desc' => $item->product->prd_desc,
            'price' => $item->product->prd_price,
        ]);
    
    };

    // return $Ftotal;

    Order::create([
        'num' => $lastNumOrder,
        'date' => date('Y-m-d H:i:s'),
        'id_user' => $userId,
        'total' => $Ftotal,
        'status' => 'E',
        'observations' => '',
        'dom' => $fullAddress,
    ]);

    Cart::where('id_user', $userId)->delete();

    return redirect()->route('orders');

}

    public function get_dom()
    {
        $user = auth()->user();
        return $user;
    }


    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $id)
    {
        $id->update($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $id)
    {
        $id->delete();
    }
}
