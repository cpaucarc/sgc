<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalisisServicio extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $fillable = ['analisis_indicador_id', 'servicio_id'];
}
