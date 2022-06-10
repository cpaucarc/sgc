<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $table = "cursos";
    public $timestamps = false;
    public $fillable = ['escuela_id', 'curricula', 'codigo', 'nombre', 'ciclo_id', 'horas_teoria', 'horas_prac'];
}
