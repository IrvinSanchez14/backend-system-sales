<?php

use App\Compras as AppCompras;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Compras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lote');
            $table->string('tipo_compra');
            $table->string('status')->default(AppCompras::AVAILABLE_COMPRAS);
            $table->integer('sucursal_id')->unsigned();
            $table->integer('usuario_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('sucursal_id')->references('id')->on('sucursales');
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
        Schema::dropIfExists('compras');
    }
}
