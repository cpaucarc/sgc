<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicador extends Model
{
    use HasFactory;

    protected $table = "indicadores";
    public $timestamps = false;
    public $fillable = ['objetivo', 'titulo_interes', 'titulo_total', 'titulo_resultado',
        'cod_ind', 'formula', 'minimo', 'satisfactorio', 'sobresaliente', 'unidad_medida_id',
        'frecuencia_medicion_id', 'frecuencia_reporte_id', 'proceso_id'];

}
