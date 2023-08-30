<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfiles extends Model
{
    use HasFactory;
    protected $table = 'sys_perfiles';
    protected $primaryKey = 'perf_idperf';
    protected $fillable = ['perf_idperf','perf_nombre','perf_descri'];
}
