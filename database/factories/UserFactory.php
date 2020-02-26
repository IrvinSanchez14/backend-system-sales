<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Categoria;
use App\User;
use App\Category;
use App\CompraDetalle;
use App\Compras;
use App\Empresa;
use App\Product;
use App\Producto;
use App\Transaction;
use App\Seller;
use App\Sucursal;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'verified' => $verified = $faker->randomElement([User::VERIFIED_USER, User::UNVERIFIED_USER]),
        'verification_token' => $verified == User::VERIFIED_USER ? null : User::generateVerificationCode(),
        'admin' => $verified = $faker->randomElement([User::ADMIN_USER, User::REGULAR_USER]),
    ];
});

$factory->define(Empresa::class, function (Faker $faker) {
    return [
        'nombre' => $faker->word,
        'razon_social' => $faker->word,
        'telefono' => $faker->phoneNumber,
        'status' => $faker->randomElement([Empresa::AVAILABLE_PRODUCT, Empresa::UNAVAILABLE_PRODUCT]),
        'usuario_id' => User::all()->random()->id,
    ];
});

$factory->define(Sucursal::class, function (Faker $faker) {
    return [
        'nombre' => $faker->word,
        'telefono' => $faker->phoneNumber,
        'direccion' => $faker->paragraph(1),
        'status' => $faker->randomElement([Sucursal::AVAILABLE_PRODUCT, Empresa::UNAVAILABLE_PRODUCT]),
        'empresa_id' => Empresa::all()->random()->id,
        'usuario_id' => User::all()->random()->id,
    ];
});

$factory->define(Categoria::class, function (Faker $faker) {
    return [
        'nombre' => $faker->word,
        'descripcion' => $faker->paragraph(1),
        'status' => $faker->randomElement([Categoria::AVAILABLE_PRODUCT, Categoria::UNAVAILABLE_PRODUCT]),
        'usuario_id' => User::all()->random()->id,
    ];
});

$factory->define(Producto::class, function (Faker $faker) {
    return [
        'nombre' => $faker->word,
        'descripcion' => $faker->paragraph(1),
        'status' => $faker->randomElement([Producto::AVAILABLE_PRODUCT, Categoria::UNAVAILABLE_PRODUCT]),
        'categoria_id' => Categoria::all()->random()->id,
        'usuario_id' => User::all()->random()->id,
    ];
});

$factory->define(Compras::class, function (Faker $faker) {
    return [
        'lote' => $faker->randomNumber,
        'tipo_compra' => $faker->randomElement([Compras::TIPO_NUEVO, Compras::TIPO_USADO]),
        'status' => $faker->randomElement([Compras::AVAILABLE_COMPRAS, Compras::UNAVAILABLE_COMPRAS]),
        'sucursal_id' => Sucursal::all()->random()->id,
        'usuario_id' => User::all()->random()->id,
    ];
});


$factory->define(CompraDetalle::class, function (Faker $faker) {
    return [
        'codigo' => $faker->randomNumber,
        'cantidad' => $faker->numberBetween($min = 1, $max = 50),
        'precio_compra' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 100),
        'precio_sugerido' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 100),
        'status' => $faker->randomElement([CompraDetalle::AVAILABLE_COMPRAS_DETALLE, CompraDetalle::UNAVAILABLE_COMPRAS_DETALLE]),
        'producto_id' => Producto::all()->random()->id,
    ];
});


$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph(1),
    ];
});

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph(1),
        'quantity' => $faker->numberBetween(1, 10),
        'status' => $faker->randomElement([Product::AVAILABLE_PRODUCT, Product::UNAVAILABLE_PRODUCT]),
        'image' => $faker->randomElement(['1.jpg', '2.jpg', '3.jpg']),
        'seller_id' => User::all()->random()->id,
    ];
});

$factory->define(Transaction::class, function (Faker $faker) {
    $seller = Seller::has('products')->get()->random();
    $buyer = User::all()->except($seller->id)->random();

    return [
        'quantity' => $faker->numberBetween(1, 10),
        'buyer_id' => $buyer->id,
        'product_id' => $seller->products->random()->id,
    ];
});
