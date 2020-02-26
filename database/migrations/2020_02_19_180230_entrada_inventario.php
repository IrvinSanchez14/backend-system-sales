<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EntradaInventario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrada_inventario', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cantidad');
            $table->decimal('precio_sugerido', 8, 2);
            $table->integer('producto_id')->unsigned();
            $table->integer('registro_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('producto_id')->references('id')->on('productos');
            $table->foreign('registro_id')->references('id')->on('registro_compras');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entrada_inventario');
    }
}
