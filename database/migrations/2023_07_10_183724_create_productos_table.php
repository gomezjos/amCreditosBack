<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gen_productos', function (Blueprint $table) {
            $table->id("prod_idprod");
            $table->String("prod_nombre")->nullable()->unsigned();
            $table->String("prod_descri")->nullable()->unsigned();
            $table->Integer("prod_idempr");
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
        Schema::dropIfExists('gen_productos');
    }
}
