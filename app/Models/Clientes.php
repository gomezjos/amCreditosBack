<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;
    protected $table        = "gen_clientes";
    protected $primaryKey   = "clien_idclien";
    protected $fillable     = ["clien_idclien","clien_nombres","clien_apellidos","clien_docume","clien_idempr","clien_direc","clien_email","clien_telefo","clien_movil","clien_idvend","clien_notificado","clien_cons","clien_fecha","clien_observ","clien_hora","clien_valor","clien_cnombres","clien_cdirec","clien_cmovil"];

}
