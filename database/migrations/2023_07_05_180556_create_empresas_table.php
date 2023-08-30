<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gen_empresas', function (Blueprint $table) {
            $table->id('empr_idempr');
            $table->String('empr_razon')->nullable()->unsigned();
            $table->String('empr_docume')->nullable()->unsigned();
            $table->String('empr_rutalo')->nullable()->unsigned();
            $table->String('empr_colorhe')->nullable()->unsigned();
            $table->String('empr_colorme')->nullable()->unsigned();
            $table->String('empr_colorbtn')->nullable()->unsigned();
            $table->String('empr_digive')->nullable()->unsigned();
            $table->String('empr_telefo')->nullable()->unsigned();
            $table->String('empr_movil')->nullable()->unsigned();
            $table->String('empr_email')->nullable()->unsigned();
            $table->String('empr_nombres')->nullable()->unsigned();
            $table->String('empr_apellidos')->nullable()->unsigned();
            $table->Integer('empr_idtido')->nullable()->unsigned();
            $table->String('empr_direc')->nullable()->unsigned();
            $table->String('empr_estado')->nullable()->unsigned();
            $table->Integer('empr_idpais')->nullable()->unsigned();
            $table->Integer('empr_idciud')->nullable()->unsigned();
            $table->String('empr_caja')->nullable()->unsigned();
            $table->String('empr_aviso')->nullable()->unsigned();
            $table->String('empr_contrato')->nullable()->unsigned();
            $table->String('empr_num')->nullable()->unsigned();
            $table->String('empr_fecha')->nullable()->unsigned();
            $table->String('empr_rutacon')->nullable()->unsigned();
            $table->String('empr_logo')->nullable()->unsigned();
            $table->String('empr_idrefe')->nullable()->unsigned();
            $table->String('empr_iva')->nullable()->unsigned();
            $table->Integer('empr_idrazon')->nullable()->unsigned();
            $table->String('empr_codarea')->nullable()->unsigned();
            $table->String('empr_print')->nullable()->unsigned();
            $table->String('empr_send')->nullable()->unsigned();
            $table->String('empr_preciounidad')->nullable()->unsigned();
            $table->String('empr_fechacontrato')->nullable()->unsigned();
            $table->String('empr_generarContrato')->nullable()->unsigned();
            $table->String('empr_comision')->nullable()->unsigned();
            $table->String('empr_codigoAccesoEmpresa')->nullable()->unsigned();

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
        Schema::dropIfExists('gen_empresas');
    }
}
