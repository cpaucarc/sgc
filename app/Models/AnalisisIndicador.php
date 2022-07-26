<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalisisIndicador extends Model
{
    use HasFactory;

    protected $table = "analisis_indicador";
    public $fillable = ['fecha_medicion_inicio', 'fecha_medicion_fin', 'minimo', 'sobresaliente',
        'interes', 'total', 'resultado', 'interpretacion', 'observacion', 'elaborado_por', 'revisado_por',
        'aprobado_por', 'user_id', 'semestre_id', 'indicadorable_id'];

    public $dates = [
        'fecha_medicion_inicio',
        'fecha_medicion_fin'
    ];

    public function semestre()
    {
        return $this->belongsTo(Semestre::class);
    }

    public function curso()
    {
        return $this->belongsToMany(Curso::class, 'analisis_cursos');
    }

    public function capacitacion()
    {
        return $this->belongsToMany(Capacitacion::class, 'analisis_capacitaciones');
    }

    public function servicio()
    {
        return $this->belongsToMany(Servicio::class, 'analisis_servicios');
    }
}
