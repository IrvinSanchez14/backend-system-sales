<?php

use App\SalidaProductoDetalles;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SalidasProductosDetalles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salidas_productos_detalles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('producto_id')->unsigned();
            $table->decimal('precio_original', 8, 2);
            $table->decimal('precio_grabado', 8, 2);
            $table->integer('status')->default(SalidaProductoDetalles::AVAILABLE_DETALLES);
            $table->integer('salida_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('producto_id')->references('id')->on('productos');
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
        Schema::dropIfExists('salidas_productos_detalles');
    }
}
