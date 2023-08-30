<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gen_clientes', function (Blueprint $table) {
            $table->id("clien_idclien");
            $table->String("clien_nombres")->nullable()->unsigned();
            $table->String("clien_apellidos")->nullable()->unsigned();
            $table->String("clien_docume")->nullable()->unsigned();
            $table->Integer("clien_idempr");
            $table->String("clien_direc")->nullable()->unsigned();
            $table->String("clien_email")->nullable()->unsigned();
            $table->String("clien_telefo")->nullable()->unsigned();
            $table->String("clien_movil")->nullable()->unsigned();
            $table->Integer("clien_idvend");
            $table->String("clien_notificado")->default('N')->nullable()->unsigned();
            $table->Integer("clien_cons");
            $table->String("clien_fecha")->nullable()->unsigned();
            $table->String("clien_observ")->nullable()->unsigned();
            $table->String("clien_hora")->nullable()->unsigned();
            $table->String("clien_valor")->nullable()->unsigned();
            $table->String("clien_cnombres")->nullable()->unsigned();
            $table->String("clien_cdirec")->nullable()->unsigned();
            $table->String("clien_cmovil")->nullable()->unsigned();
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
        Schema::dropIfExists('gen_clientes');
    }
}
