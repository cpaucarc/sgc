<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponsabilidadSocial extends Model
{
    use HasFactory;

    protected $table = "responsabilidad_social";
    public $fillable = ['titulo', 'descripcion', 'lugar', 'fecha_inicio', 'fecha_fin', 'semestre_id', 'escuela_id', 'empresa_id'];

    protected $dates = ['fecha_inicio', 'fecha_fin',];
}
