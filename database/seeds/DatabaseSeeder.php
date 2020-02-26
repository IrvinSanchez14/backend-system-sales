<?php

use App\Categoria;
use Illuminate\Database\Seeder;
use App\User;
use App\Product;
use App\Category;
use App\CompraDetalle;
use App\Compras;
use App\Empresa;
use App\Producto;
use App\Sucursal;
use App\Transaction;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        User::truncate();
        Empresa::truncate();
        Sucursal::truncate();
        Categoria::truncate();
        Producto::truncate();
        Compras::truncate();
        CompraDetalle::truncate();

        Category::truncate();
        Product::truncate();
        Transaction::truncate();
        DB::table('category_product')->truncate();

        User::flushEventListeners();
        Empresa::flushEventListeners();
        Sucursal::flushEventListeners();
        Categoria::flushEventListeners();
        Producto::flushEventListeners();
        Compras::flushEventListeners();
        CompraDetalle::flushEventListeners();

        Category::flushEventListeners();
        Product::flushEventListeners();
        Transaction::flushEventListeners();

        $usersQuantity = 10;
        $categoriesQuantity = 30;
        $productoQuantity = 100;
        $productsQuantity = 1000;
        $transactionsQuantity = 1000;

        // factory(User::class, $usersQuantity)->create();

        factory(User::class,  $usersQuantity)->create();
        factory(Empresa::class,  3)->create();
        factory(Sucursal::class,  $categoriesQuantity)->create();
        factory(Categoria::class, $categoriesQuantity)->create();
        factory(Producto::class, $productoQuantity)->create();
        //factory(Compras::class, $categoriesQuantity)->create();

        factory(Compras::class, $categoriesQuantity)->create()->each(function ($compra) {
            $detalles = factory(CompraDetalle::class, 6)->make();

            $compra->detalles()->saveMany($detalles);
        });

        factory(Category::class, $categoriesQuantity)->create();
        factory(Product::class, $productsQuantity)->create()->each(function ($product) {
            $categories = Category::all()->random(mt_rand(1, 5))->pluck('id');

            $product->categories()->attach($categories);
        });
        factory(Transaction::class, $transactionsQuantity)->create();
    }
}
