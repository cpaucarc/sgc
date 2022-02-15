<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    protected $table = "solicitudes";
    public $fillable = ['codigo_estudiante', 'tipo_solicitud_id', 'estado_id'];
}
