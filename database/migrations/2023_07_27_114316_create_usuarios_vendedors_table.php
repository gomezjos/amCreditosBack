<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosVendedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gen_vendedoresusuario ', function (Blueprint $table) {
            $table->id("ruta_idruta");
            $table->Integer("ruta_idvend")->nullable()->unsigned();
            $table->Integer("ruta_idusua")->nullable()->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gen_vendedoresusuario ');
    }
}
