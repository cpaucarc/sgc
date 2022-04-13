<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConvalidacionPostulante extends Model
{
    use HasFactory;

    protected $table = 'convalidacion_postulantes';
    public $fillable = ['es_estudiante_interno', 'dni_estudiante', 'convalidacion_id', 'estudiante_externo_id', 'estado_id'];
    public $timestamps = false;
}
