<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tesis extends Model
{
    use HasFactory;

    protected $table = "tesis";
    public $timestamps = false;
    public $fillable = ['numero_registro', 'titulo', 'anio', 'codigo_estudiante', 'escuela_id', 'asesor_id', 'tipo_tesis_id'];

}
