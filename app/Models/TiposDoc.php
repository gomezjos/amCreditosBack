<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiposDoc extends Model
{
    protected $table ='sys_tido';
    protected $primaryKey = 'menu_idmenu';
    protected $fillable = ['tipo_idtido','tido_nombre','tido_siigo'];
}
