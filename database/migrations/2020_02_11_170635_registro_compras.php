<?php

use App\RegistroCompras as AppRegistroCompras;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RegistroCompras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registro_compras', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status')->default(AppRegistroCompras::AVAILABLE_COMPRAS_REGISTRO);
            $table->string('descripcion');
            $table->integer('compra_id')->unsigned();
            $table->integer('usuario_id')->unsigned();
            $table->integer('sucursal_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('compra_id')->references('id')->on('compras');
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
        Schema::dropIfExists('registro_compras');
    }
}
