<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRazonSocialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_razonsocial', function (Blueprint $table) {
            $table->id("razon_idrazon");
            $table->String("razon_nombre")->nullable()->unsigned();
            $table->String("razon_urltoke")->nullable()->unsigned();
            $table->String("razon_urlbase")->nullable()->unsigned();
            $table->String("razon_apiuser")->nullable()->unsigned();
            $table->String("razon_subscriptionkey")->nullable()->unsigned();
            $table->String("razon_apipassword")->nullable()->unsigned();
            $table->Integer("razon_iva")->nullable()->unsigned();
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
        Schema::dropIfExists('sys_razonsocial');
    }
}
