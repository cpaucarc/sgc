<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $table = "cursos";
    public $timestamps = false;
    public $fillable = ['curricula', 'codigo', 'nombre', 'horas_teoria', 'horas_practica', 'escuela_id', 'ciclo_id'];
}
