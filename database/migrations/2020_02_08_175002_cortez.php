<?php

use App\Cortez as AppCortez;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cortez extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cortez', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('total_ventas', 8, 2);
            $table->decimal('total_compras', 8, 2);
            $table->decimal('total_eliminado', 8, 2);
            $table->decimal('total_efectivo', 8, 2);
            $table->decimal('total_pos', 8, 2);
            $table->decimal('total_descuento', 8, 2);
            $table->decimal('total_iva', 8, 2);
            $table->string('status')->default(AppCortez::UNAVAILABLE_CORTEZ);
            $table->integer('usuario_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('cortez');
    }
}
