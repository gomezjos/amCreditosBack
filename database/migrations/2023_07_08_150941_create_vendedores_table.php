<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gen_vendedores', function (Blueprint $table) {
            $table->id('vend_idvend');
            $table->String("vend_nombres")->nullable()->unsigned();
            $table->String("vend_apellidos")->nullable()->unsigned();
            $table->String("vend_docume")->nullable()->unsigned();
            $table->String("vend_idempr")->nullable()->unsigned();
            $table->Integer("vend_saldoi")->nullable()->unsigned();
            $table->String("vend_fecha")->nullable()->unsigned();
            $table->Integer("vend_idpais")->nullable()->unsigned();
            $table->Integer("vend_idciud")->nullable()->unsigned();
            $table->String("vend_telefo")->nullable()->unsigned();
            $table->String("vend_movil")->nullable()->unsigned();
            $table->String("vend_email")->nullable()->unsigned();
            $table->String("vend_direc")->nullable()->unsigned();
            $table->String("vend_estado")->nullable()->unsigned();
            $table->String("vend_urlfo")->nullable()->unsigned();
            $table->Integer("vend_idtido")->nullable()->unsigned();
            $table->Integer("vend_ventmax")->nullable()->unsigned();
            $table->String("vend_alterno")->default('N');
            $table->String("vend_mensaje")->nullable()->unsigned();
            $table->String("vend_aplicar")->default('S');
            $table->String("vend_gps")->default('N');
            $table->String("vend_tipoint")->default('V');
            $table->Integer("vend_inter")->nullable()->unsigned();
            $table->String("vend_poli")->default('I');
            $table->Integer("vend_nronop");
            $table->String("vend_tipop")->nullable()->unsigned();
            $table->Integer("vend_valor")->nullable()->unsigned();
            $table->String("vend_fechap")->nullable()->unsigned();
            $table->String("vend_aplazar")->default('N');
            $table->String("vend_manual")->default('N');
            $table->Integer("vend_salario")->nullable()->unsigned();
            $table->Integer("vend_porcenrecaudo")->nullable()->unsigned();
            $table->Integer("vend_porcenventas")->nullable()->unsigned();
            $table->String("vend_tiponomina")->nullable()->unsigned();
            $table->Integer("vend_vrpension")->nullable()->unsigned();
            $table->Integer("vend_vrsalud")->nullable()->unsigned();
            $table->String("vend_validadoc")->default('N');
            $table->String("vend_log")->default('N');
            $table->String("vend_dir")->default('N');
            $table->String("vend_nummovil")->nullable()->unsigned();
            $table->String("vend_gastos")->nullable()->unsigned();
            $table->Integer("vend_gastmax")->nullable()->unsigned();
            $table->String("vend_numcuotas")->nullable()->unsigned();
            $table->String("vend_sancuo")->default('N');
            $table->Integer("vend_maxcuotas")->nullable()->unsigned();
            $table->String("vend_wifi")->default('S');
            $table->String("vend_ventas")->default('N');
            $table->String("vend_updatemovil")->default('S');
            $table->String("vend_frecue")->default('N');
            $table->String("vend_delcuotas")->default('S');
            $table->String("vend_info")->default('N');
            $table->String("vend_sigdia")->default('N');
            $table->String("vend_print")->default('N');
            $table->String("vend_codarea")->nullable()->unsigned();
            $table->String("vend_codiarea")->nullable()->unsigned();
            $table->String("vend_online")->default('N');
            $table->String("vend_ingr")->default('N');
            $table->Integer("vend_ingrmax")->nullable()->unsigned();
            $table->String("vend_valida")->default('N');
            $table->String("vend_cuotdia")->default('N');
            $table->Integer("vend_maxcuotdia")->nullable()->unsigned();
            $table->String("vend_renovacion")->default('N');
            $table->String("vend_inter1")->nullable()->unsigned();
            $table->String("vend_inter2")->nullable()->unsigned();
            $table->String("vend_inter3")->nullable()->unsigned();
            $table->String("vend_chnombre")->default('N');
            $table->Integer("vend_renomax")->nullable()->unsigned();
            $table->Integer("vend_sigdiamax");
            $table->String("vend_renotope")->default('N');
            $table->String("vend_codigoacceso")->nullable()->unsigned();
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
        Schema::dropIfExists('gen_vendedores');
    }
}
