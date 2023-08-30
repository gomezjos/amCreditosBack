<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RazonSocial extends Model
{
    use HasFactory;
    protected $table = "sys_razonsocial";
    protected $primaryKey = "razon_idrazon";
    protected $fillable = ["razon_idrazon","razon_nombre","razon_urltoke","razon_urlbase","razon_apiuser","razon_subscriptionkey","razon_apipassword","razon_iva"];
}
