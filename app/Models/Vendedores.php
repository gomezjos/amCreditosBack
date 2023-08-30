<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendedores extends Model
{
    use HasFactory;
    protected $table =  "gen_vendedores" ;
    protected $primaryKey = "vend_idvend";
    protected $fillable = ["vend_idvend","vend_nombres","vend_apellidos","vend_docume","vend_idempr","vend_saldoi","vend_fecha","vend_idpais","vend_idciud","vend_telefo","vend_movil","vend_email","vend_direc","vend_estado","vend_urlfo","vend_idtido","vend_ventmax","vend_alterno","vend_mensaje","vend_aplicar","vend_gps","vend_tipoint","vend_inter","vend_poli","vend_nronop","vend_tipop","vend_valor","vend_fechap","vend_aplazar","vend_manual","vend_salario","vend_porcenrecaudo","vend_porcenventas","vend_tiponomina","vend_vrpension","vend_vrsalud","vend_validadoc","vend_log","vend_dir","vend_nummovil","vend_gastos","vend_gastmax","vend_numcuotas","vend_sancuo","vend_maxcuotas","vend_wifi","vend_ventas","vend_updatemovil","vend_frecue","vend_delcuotas","vend_info","vend_sigdia","vend_print","vend_codarea","vend_codiarea","vend_online","vend_ingr","vend_ingrmax","vend_valida","vend_cuotdia","vend_maxcuotdia","vend_renovacion","vend_inter1","vend_inter2","vend_inter3","vend_chnombre","vend_renomax","vend_sigdiamax","vend_renotope","vend_codigoacceso"];
}
