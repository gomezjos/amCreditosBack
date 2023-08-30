<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresas extends Model{
    use HasFactory;
    protected $table        = "gen_empresas";
    protected $primaryKey   = "empr_idempr";
    protected $fillable     = ["empr_idempr","empr_razon","empr_docume","empr_rutalo","empr_colorhe","empr_colorme","empr_colorbtn","empr_digive","empr_telefo","empr_movil","empr_email","empr_nombres","empr_apellidos","empr_idtido","empr_direc","empr_estado","empr_idpais","empr_idciud","empr_caja","empr_aviso","empr_contrato","empr_num","empr_fecha","empr_rutacon","empr_logo","empr_idrefe","empr_iva","empr_idrazon","empr_codarea","empr_print","empr_send","empr_preciounidad","empr_fechacontrato","empr_generarContrato","empr_comision","empr_codigoAccesoEmpresa","empr_contrasenaEmpresa","empr_codigoAccesoR"];
}
