<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pais extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_pais', function (Blueprint $table) {
            $table->increments("pais_idpais")->startingValue(20);
            $table->text("pais_nombre");
            $table->string("pais_codarea");
            $table->string("pais_convenio");
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
        Schema::dropIfExists('sys_pais');
    }
}

