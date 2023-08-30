<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudades extends Model
{
    use HasFactory;
    protected $table        = "sys_ciudad";
    protected $primaryKey   = "ciud_idciud";
    protected $fillable     = ['ciud_idciud','ciud_idpais','ciud_nombre','ciud_gtm'];
}
