<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalisisCurso extends Model
{
    use HasFactory;

    protected $table = "analisis_cursos";
    public $timestamps = false;
    public $fillable = ['analisis_indicador_id', 'curso_id'];
}
