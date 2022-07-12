<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalisisCapacitacion extends Model
{
    use HasFactory;

    protected $table = "analisis_capacitaciones";
    public $timestamps = false;
    public $fillable = ['analisis_indicador_id', 'capacitacion_id'];
}
