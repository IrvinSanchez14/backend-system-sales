<?php

use App\SalidaProducto;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SalidasProductos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salidas_productos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cliente_frecuente')->default(SalidaProducto::CLIENTE_FRECUENTE_NO);
            $table->string('sin_iva')->default(SalidaProducto::CON_IVA);
            $table->decimal('valor_venta', 8, 2);
            $table->decimal('valor_iva', 8, 2);
            $table->string('no_factura');
            $table->integer('usuario_id')->unsigned();
            $table->integer('sucursal_id')->unsigned();
            $table->integer('tipo_pago_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('usuario_id')->references('id')->on('users');
            $table->foreign('sucursal_id')->references('id')->on('sucursales');
            $table->foreign('tipo_pago_id')->references('id')->on('tipos_pagos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salidas_productos');
    }
}
