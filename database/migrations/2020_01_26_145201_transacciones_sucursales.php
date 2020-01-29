<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TransaccionesSucursales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transacciones_sucursales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cantidad');
            $table->integer('tipo_id')->unsigned();
            $table->integer('producto_id')->unsigned();
            $table->integer('sucursal_id')->unsigned();
            $table->integer('vendedor_id')->unsigned();
            $table->integer('usuario_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('tipo_id')->references('id')->on('tipos_transaccion');
            $table->foreign('producto_id')->references('id')->on('productos');
            $table->foreign('sucursal_id')->references('id')->on('sucursales');
            $table->foreign('vendedor_id')->references('id')->on('vendedores');
            $table->foreign('usuario_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transacciones_sucursales');
    }
}
