<?php

use App\CompraDetalle;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CompraDetalles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compra_detalles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo');
            $table->integer('cantidad');
            $table->decimal('precio_compra', 8, 2);
            $table->decimal('precio_sugerido', 8, 2);
            $table->string('status')->default(CompraDetalle::AVAILABLE_COMPRAS_DETALLE);
            $table->integer('producto_id')->unsigned();
            $table->integer('compra_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('producto_id')->references('id')->on('productos');
            $table->foreign('compra_id')->references('id')->on('compras');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compra_detalles');
    }
}
