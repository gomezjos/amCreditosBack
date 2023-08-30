<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gen_ventas', function (Blueprint $table) {
            $table->id('vent_idvent');
            $table->Integer("vent_idclien")->nullable()->unsigned();
            $table->Integer("vent_idvend")->nullable()->unsigned();
            $table->Integer("vent_idprod")->nullable()->unsigned();
            $table->decimal("vent_valor")->nullable()->unsigned();
            $table->decimal("vent_saldo")->nullable()->unsigned();
            $table->date("vent_fecha")->nullable()->unsigned();
            $table->Integer("vent_inter")->nullable()->unsigned();
            $table->Integer("vent_numcu")->nullable()->unsigned();
            $table->String("vent_fechaf")->nullable()->unsigned();
            $table->String("vent_tipo")->nullable()->unsigned();
            $table->String("vent_observ")->nullable()->unsigned();
            $table->Integer("vent_idempr")->nullable()->unsigned();
            $table->String("vent_frecue")->nullable()->unsigned();
            $table->enum('vent_estado', ['D', 'C', 'I'])->default('D');
            $table->Integer("vent_cuore")->default(0);
            $table->String("vent_fechac")->nullable()->unsigned();
            $table->Integer("vent_orden")->nullable()->unsigned();
            $table->Integer("vent_dia1")->nullable()->unsigned();
            $table->Integer("vent_dia2")->nullable()->unsigned();
            $table->String("vent_fechafc")->nullable()->unsigned();
            $table->String("vent_sancion")->nullable()->unsigned();
            $table->String("vent_fechanop")->nullable()->unsigned();
            $table->String("vent_fechaant")->nullable()->unsigned();
            $table->String("vent_clave")->nullable()->unsigned();
            $table->String("vent_cons")->nullable()->unsigned();
            $table->String("vent_lat")->nullable()->unsigned();
            $table->String("vent_lon")->nullable()->unsigned();
            $table->String("vent_hora")->nullable()->unsigned();
            $table->String("vent_fecina")->nullable()->unsigned();
            $table->String("vent_numseg")->nullable()->unsigned();
            $table->Integer("vent_vrseg")->default(0);
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
        Schema::dropIfExists('gen_ventas');
    }
}
