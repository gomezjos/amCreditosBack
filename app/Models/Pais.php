<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    use HasFactory;
    protected $table    = "sys_pais";
    protected $primaryKey = 'pais_idpais';
    protected $fillable = ['pais_idpais','pais_nombre','pais_codarea','pais_convenio'];
}
