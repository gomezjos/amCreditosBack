<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;
    protected $table        = "gen_productos";
    protected $primaryKey   = "prod_idprod";
    protected $fillable     = ["prod_idprod","prod_nombre","prod_descri","prod_idempr"];
}
