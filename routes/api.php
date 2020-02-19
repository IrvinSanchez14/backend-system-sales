<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
/*
Route::group([], function () {
    Route::post('login', 'User\UserController@login');

    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('users', 'User\UserController@index');
    });
});*/



//Route::post('login', 'AuthController@login');
Route::post('login', 'User\UserController@login');


Route::resource('users', 'User\UserController', ['except' => ['create', 'edit']]);
Route::name('verify')->get('users/verify/{token}', 'User\UserController@verify');
Route::name('resend')->get('users/{user}/resend', 'User\UserController@resend');


Route::resource('buyers', 'Buyer\BuyerController', ['only' => ['index', 'show']]);
Route::resource('buyers.transactions', 'Buyer\BuyerTransactionController', ['only' => ['index']]);
Route::resource('buyers.products', 'Buyer\BuyerProductController', ['only' => ['index']]);
Route::resource('buyers.sellers', 'Buyer\BuyerSellerController', ['only' => ['index']]);
Route::resource('buyers.categories', 'Buyer\BuyerCategoryController', ['only' => ['index']]);


Route::resource('sellers', 'Seller\SellerController', ['only' => ['index', 'show']]);
Route::resource('sellers.transactions', 'Seller\SellerTransactionController', ['only' => ['index']]);
Route::resource('sellers.categories', 'Seller\SellerCategoryController', ['only' => ['index']]);
Route::resource('sellers.buyers', 'Seller\SellerBuyerController', ['only' => ['index']]);
Route::resource('sellers.products', 'Seller\SellerProductController',  ['except' => ['create', 'edit', 'show']]);

Route::resource('categories', 'Category\CategoryController', ['except' => ['create', 'edit']]);
Route::resource('categories.products', 'Category\CategoryProductController', ['only' => ['index']]);
Route::resource('categories.sellers', 'Category\CategorySellerController', ['only' => ['index']]);
Route::resource('categories.transactions', 'Category\CategoryTransactionController', ['only' => ['index']]);
Route::resource('categories.buyers', 'Category\CategoryBuyerController', ['only' => ['index']]);

Route::resource('products', 'Product\ProductController', ['only' => ['index', 'show']]);
Route::resource('products.transactions', 'Product\ProductTransactionController', ['only' => ['index']]);
Route::resource('products.buyers', 'Product\ProductBuyerController', ['only' => ['index']]);
Route::resource('products.categories', 'Product\ProductCategoryController', ['except' => ['create', 'edit', 'show']]);
Route::resource('products.buyers.transactions', 'Product\ProductBuyerTransactionController', ['only' => ['store']]);

Route::resource('transactions', 'Transaction\TransactionController', ['only' => ['index', 'show']]);
Route::resource('transactions.categories', 'Transaction\TransactionCategoryController', ['only' => ['index']]);
Route::resource('transactions.sellers', 'Transaction\TransactionSellerController', ['only' => ['index']]);

Route::resource('empresas', 'Empresa\EmpresaController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);

Route::resource('sucursales', 'Sucursal\SucursalController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
Route::resource('sucursales.empresas', 'Sucursal\SucursalEmpresaController', ['only' => ['index']]);

Route::resource('vendedores', 'Vendedor\VendedorController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);

Route::resource('categorias', 'Categoria\CategoriaController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
Route::resource('categorias.productos', 'Categoria\CategoriaProductoController', ['only' => ['index']]);

Route::resource('productos', 'Producto\ProductoController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
Route::resource('productos.categorias', 'Producto\ProductoCategoriaController', ['only' => ['index']]);

Route::resource('tipos_transaccion', 'TipoTransaccion\TipoTransaccionController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);

Route::resource('transacciones_sucursales', 'TransaccionSucursal\TransaccionSucursalController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
Route::resource('transacciones_sucursales.all', 'TransaccionSucursal\TransaccionSucursalAllinController', ['only' => ['index']]);

Route::resource('entradas_productos', 'EntradaProducto\EntradaProductoController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
Route::resource('entradas_productos.all', 'EntradaProducto\EntradaProductoAllinController', ['only' => ['index']]);

Route::resource('salidas_productos', 'SalidaProducto\SalidaProductoController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
Route::resource('salidas_productos.all', 'SalidaProducto\SalidaProductoAllinController', ['only' => ['index']]);

Route::resource('cortes', 'Cortez\CortezController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);

Route::resource('compras', 'Compras\ComprasController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
Route::post('compras.detalles', 'Compras\ComprasyDetallesController@index');

Route::resource('compra_detalles', 'CompraDetalle\CompraDetalleController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);

Route::resource('tipo_pagos', 'TiposPagos\TiposPagosController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);

Route::resource('registro_compras', 'RegistroCompras\RegistroComprasController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
Route::resource('registro_compras.compras', 'RegistroCompras\RegistroCompraSucursalController', ['only' => ['index']]);

Route::resource('salida_detalles', 'SalidaProductoDetalle\SalidaProductoDetalleController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
