<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCiudadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_ciudad', function (Blueprint $table) {
            $table->increments('ciud_idciud')->startingValue(376);
            $table->integer("ciud_idpais");
            $table->string("ciud_nombre");
            $table->string("ciud_gmt");
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
        Schema::dropIfExists('sys_ciudad');
    }
}
