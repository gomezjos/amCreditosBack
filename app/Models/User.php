<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements Authenticatable
{
    use HasFactory, Notifiable;
    protected $table        = "sys_usuarios";
    protected $primaryKey   = "usua_idusua";
    protected $password     = 'password';
    //protected $fillable     = ['usua_idusua','usua_nombre','usua_clave','usua_codigo','usua_imei','usua_idperf','usua_idempr','usua_idven','usua_estado','usua_vigen','usua_facven','usua_idempre','usua_version','usua_fechaf','usua_pass','usua_acceso','usua_opc','usua_chpw'];
    protected $guarded = [];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'usua_clave'
    ];

    public function getAuthIdentifierName()
    {
        // Implementación del método
    }

    public function getAuthIdentifier()
    {
        // Implementación del método
    }

    public function getAuthPassword()
    {
        return $this->usua_clave;
    }

    public function getRememberToken()
    {
        // Implementación del método
    }

    public function setRememberToken($value)
    {
        // Implementación del método
    }

    public function getRememberTokenName()
    {
        // Implementación del método
    }
}
