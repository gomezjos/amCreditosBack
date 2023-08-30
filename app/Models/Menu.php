<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table ='sys_menu';
    protected $primaryKey = 'menu_idmenu';
    protected $fillable = ['menu_idmenu','menu_nombre','menu_idmenup','menu_pagina','menu_programa','menu_imagen','menu_orden','menu_admin','menu_tipo'];
}
