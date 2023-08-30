<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuariosVendedor extends Model
{
    use HasFactory;
    protected $table = "gen_vendedoresusuario ";
    protected $primaryKey ="ruta_idruta";
    protected $fillable = ["ruta_idruta","ruta_idvend","ruta_idusua"];
}
