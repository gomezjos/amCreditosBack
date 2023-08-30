<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gen_cuotas', function (Blueprint $table) {
            $table->id("cuot_idcuot");
            $table->Integer("cuot_idvent")->nullable()->unsigned();
            $table->Integer("cuot_numero")->nullable()->unsigned();
            $table->decimal("cuot_valor")->default(0);
            $table->String("cuot_fecha")->nullable()->unsigned();
            $table->String("cuot_estado")->default("A");
            $table->String("cuot_tipo")->default("C");
            $table->String("cuot_observ")->nullable()->unsigned();
            $table->String("cuot_hora")->nullable()->unsigned();
            $table->Integer("cuot_idvend")->nullable()->unsigned();
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
        Schema::dropIfExists('gen_cuotas');
    }
}
