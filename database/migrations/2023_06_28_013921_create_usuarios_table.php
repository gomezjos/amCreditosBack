<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_usuarios', function (Blueprint $table) {
            $table->increments('usua_idusua')->startingValue(1);
            $table->string('usua_nombre');
            $table->text('usua_clave')->nullable();
            $table->string('usua_codigo');
            $table->string('usua_imei')->nullable();
            $table->integer('usua_idperf');
            $table->integer('usua_idempr')->nullable();
            $table->integer('usua_idven')->nullable();
            $table->string('usua_estado')->nullable();
            $table->string('usua_vigen')->nullable();
            $table->string('usua_fecven')->nullable();
            $table->integer('usua_idempre')->nullable();
            $table->string('usua_version')->nullable();
            $table->date('usua_fechaf')->nullable();
            $table->string('usua_pass')->nullable();
            $table->string('usua_opc')->nullable();
            $table->string('usua_acceso')->nullable();
            $table->string('usua_chpw')->nullable();
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
        Schema::dropIfExists('sys_usuarios');
    }
}
