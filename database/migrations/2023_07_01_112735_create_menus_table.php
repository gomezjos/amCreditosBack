<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_menu', function (Blueprint $table) {
            $table->increments('menu_idmenu')->startingValue(46);
            $table->text('menu_nombre');
            $table->integer('menu_idmenup');
            $table->string('menu_pagina');
            $table->string('menu_programa');
            $table->string('menu_imagen');
            $table->string('menu_orden');
            $table->string('menu_admin');
            $table->string('menu_tipo');
            $table->integer('menu_abierta')->default(0);
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
        Schema::dropIfExists('sys_menu');
    }
}
