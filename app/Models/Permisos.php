<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permisos extends Model
{
    use HasFactory;
    protected $table        = "gen_permisos";
    protected $primaryKey   = "perm_idperm";
    protected $fillable     = ["perm_idperm","perm_idmenu","perm_idusua","guardar","buscar","eliminar"];
}
