<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermisosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gen_permisos', function (Blueprint $table) {
            $table->increments("perm_idperm");
            $table->integer("perm_idmenu");
            $table->integer("perm_idusua");
            $table->integer("guardar")->nullable()->unsigned();
            $table->integer("buscar")->nullable()->unsigned();
            $table->integer("eliminar")->nullable()->unsigned();
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
        Schema::dropIfExists('gen_permisos');
    }
}
