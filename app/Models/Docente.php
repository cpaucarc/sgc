<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $fillable = ['grado', 'persona_id', 'departamento_id', 'categoria_id', 'condicion_id', 'dedicacion_id'];
}
