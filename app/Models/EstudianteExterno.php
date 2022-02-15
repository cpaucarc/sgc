<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstudianteExterno extends Model
{
    use HasFactory;

    protected $table = 'estudiante_externo';
    public $timestamps = false;
    public $fillable = ['nombres', 'apellidos', 'correo', 'codigo', 'institucion_id'];
}
