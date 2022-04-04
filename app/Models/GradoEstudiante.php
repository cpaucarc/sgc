<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradoEstudiante extends Model
{
    use HasFactory;

    protected $table = "grado_estudiante";
//    public $timestamps = false;
    public $fillable = ['codigo_estudiante', 'grado_academico_id', 'escuela_id'];

    public function escuela()
    {
        return $this->belongsTo(Escuela::class);
    }

}
