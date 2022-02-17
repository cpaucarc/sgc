<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActividadCompletado extends Model
{
    use HasFactory;

    protected $table = "actividad_completado";
    public $fillable = ['responsable_id', 'semestre_id', 'user_id'];
}
