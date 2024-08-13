<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\NegocioController;
use App\Http\Controllers\QuejaController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Order2Controller;
use App\Http\Controllers\StripeController;
use App\Mail\ContactanosMailable;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::view('/acount', 'acount')->name('acount');

// Administracion
Route::middleware(['auth', 'role:admin'])->namespace('App\Http\Controllers')->group( function () 
{
    Route::get('/listar_usuarios', [UserController::class, 'listar'])->name('listar_usuarios');
    Route::post('/crear_usuarios', [UserController::class, 'store'])->name('crear_usuarios');
    Route::put('/editar_usuarios/{id}', [UserController::class, 'update'])->name('editar_usuarios');
    Route::delete('/eliminar_usuarios/{id}', [UserController::class, 'destroy'])->name('eliminar_usuarios');
    
    Route::get('/show_user/{id}', [UserController::class, 'show'])->name('show_user');
    
    Route::view('/adminUser', 'adminUser')->name('adminUser');

    Route::view('/producto', 'producto')->name('producto');
});

// Socios
Route::middleware(['auth', 'role:socio'])->namespace('App\Http\Controllers')->group( function () 
{
    Route::view('/negocio', 'negocio')->name('negocio');
});

// Autenticado
Route::middleware('auth')->namespace('App\Http\Controllers')->group( function () 
{
    Route::resource('product','ProductController');
    Route::resource('business','BusinessController');
    Route::resource('queja','QuejaController');
    Route::resource('chat','ChatController');
    Route::get('/chatcli/{bsn}/{chat}', [ChatController::class, 'chatcli'])->name('chatcli');
    
    Route::get('/getnegocio', [NegocioController::class, 'index'])->name('getnegocio');
    Route::get('/getAllProducto', [NegocioController::class, 'getAllProducto'])->name('getAllProducto');
    Route::get('/getproducto/{id}', [NegocioController::class, 'getproducto'])->name('getproducto');
    Route::get('/getquejas/{id}', [NegocioController::class, 'getquejas'])->name('getquejas');

    Route::view('/quejav', 'quejav')->name('quejav');
    Route::view('/chats', 'chats')->name('chats');

    Route::view('/cart', 'cart')->name('cart');
    Route::get('/getcarrito', [CartController::class, 'getcarrito'])->name('getcarrito');
    Route::put('/agregar_carrito', [CartController::class, 'store'])->name('agregar_carrito');
    Route::put('/sumar_carrito/{id}', [CartController::class, 'sumar'])->name('sumar_carrito');
    Route::put('/restar_carrito/{id}', [CartController::class, 'restar'])->name('restar_carrito');
    Route::delete('/eliminar_carrito/{id}', [CartController::class, 'destroy'])->name('eliminar_carrito');
    
    Route::get('/get_dom', [CartController::class, 'get_dom'])->name('get_dom');
    Route::put('/edit_dom/{id}', [UserController::class, 'edit_dom'])->name('edit_dom');
    Route::get('/mostrarcompra', [CartController::class, 'mostrarcompra'])->name('mostrarcompra');

    Route::view('/orders', 'orders')->name('orders');
    Route::get('/list_orders', [OrderController::class, 'list_orders'])->name('list_orders');
    Route::put('/editar_orders/{id}', [OrderController::class, 'update'])->name('editar_orders');
    Route::put('/decline_orders/{id}', [OrderController::class, 'decline'])->name('decline_orders');

    Route::get('/list_products/{id}', [Order2Controller::class, 'list_products'])->name('list_products');

    // RUTAS STRIPE
    Route::post('/create-checkout-session', [StripeController::class, 'createCheckoutSession']);
    Route::post('/webhook-stripe', [StripeController::class, 'webhookStripe']);

});
