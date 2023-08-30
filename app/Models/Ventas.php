<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    use HasFactory;
    protected $table = "gen_ventas";
    protected $primaryKey = "vent_idvent";
    protected $fillable =["vent_idvent","vent_idclien","vent_idvend","vent_idprod","vent_valor","vent_saldo","vent_fecha","vent_inter","vent_numcu","vent_fechaf","vent_tipo","vent_observ","vent_idempr","vent_frecue","vent_estado","vent_cuore","vent_fechac","vent_orden","vent_hora","vent_numseg","vent_vrseg"];
}
