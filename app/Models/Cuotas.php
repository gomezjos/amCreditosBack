<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuotas extends Model
{
    use HasFactory;
    protected $table        = "gen_cuotas";
    protected $primaryKey   = "cuot_idcuot";
    protected $fillable     = ["cuot_idcuot","cuot_idvent","cuot_numero","cuot_valor","cuot_fecha","cuot_estado","cuot_tipo","cuot_observ","cuot_hora","cuot_idvend"];
}
