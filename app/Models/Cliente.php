<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $fillable = ['actividad_id', 'salida_id', 'oficina_id'];
}
