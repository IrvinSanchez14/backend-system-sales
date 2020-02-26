<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TransaccionVenta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaccion_venta', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('entrada_id')->unsigned();
            $table->integer('producto_id')->unsigned();
            $table->integer('cantidad_anterior');
            $table->integer('cantidad_vendida');
            $table->integer('cantidad_nueva');
            $table->decimal('precio_original', 8, 2);
            $table->decimal('precio_grabado', 8, 2);
            $table->integer('salida_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('producto_id')->references('id')->on('productos');
            $table->foreign('entrada_id')->references('id')->on('entrada_inventario');
            $table->foreign('salida_id')->references('id')->on('salidas_productos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaccion_venta');
    }
}
