<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    use HasFactory;
    protected $table        = "sys_usuarios";
    protected $primaryKey   = "usua_idusua";
    protected $fillable     = ['usua_idusua','usua_nombre','rusua_clave','usua_clave','usua_codigo','usua_imei','usua_idperf','usua_idempr','usua_idven','usua_estado','usua_vigen','usua_facven','usua_idempre','usua_version','usua_fechaf','usua_pass','usua_acceso','usua_opc','usua_chpw'];
}
