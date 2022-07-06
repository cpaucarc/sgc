<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapacitacionDocente extends Model
{
    use HasFactory;

    public $table = 'capacitacion_docente';
    public $fillable = ['capacitacion_id', 'docente_id', 'participa','departamento_id'];
}
