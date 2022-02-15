<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradoEstudiante extends Model
{
    use HasFactory;

    protected $table = "grado_estudiante";
    public $fillable = ['codigo_estudiante', 'grado_academico_id'];
}
