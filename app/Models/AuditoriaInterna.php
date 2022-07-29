<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditoriaInterna extends Model
{
    use HasFactory;
    protected $table = 'auditorias_internas';
    protected $fillable = ['auditor_dni', 'auditor_nombre', 'observacion', 'facultad_id', 'semestre_id', 'user_id'];
}
