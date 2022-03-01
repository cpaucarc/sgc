<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalisisIndicador extends Model
{
    use HasFactory;

    protected $table = "analisis_indicador";
    public $fillable = ['fecha_medicion_inicio', 'fecha_medicion_fin', 'minimo', 'satisfactorio', 'sobresaliente',
        'interes', 'total', 'resultado', 'interpretacion', 'observacion', 'elaborado_por', 'revisado_por',
        'cod_ind_final', 'aprobado_por', 'user_id', 'semestre_id', 'indicadorable_id'];

    public $dates = [
        'fecha_medicion_inicio',
        'fecha_medicion_fin'
    ];
}
