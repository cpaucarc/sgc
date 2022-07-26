<?php

namespace App\Models;

use Database\Seeders\FrecuenciaSeeder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicador extends Model
{
    use HasFactory;

    protected $table = "indicadores";
    public $timestamps = false;
    public $fillable = ['objetivo', 'titulo_interes', 'titulo_total', 'titulo_resultado',
        'cod_ind_inicial', 'formula', 'minimo', 'satisfactorio', 'sobresaliente', 'unidad_medida_id',
        'esta_implementado', 'frecuencia_medicion_id', 'frecuencia_reporte_id', 'proceso_id'];

    public function medicion()
    {
        return $this->belongsTo(Frecuencia::class, 'frecuencia_medicion_id', 'id');
    }

    public function reporte()
    {
        return $this->belongsTo(Frecuencia::class, 'frecuencia_reporte_id', 'id');
    }

    public function proceso()
    {
        return $this->belongsTo(Proceso::class);
    }

    // Indicador tiene mucho analisis: uno a muchos
    public function analisis()
    {
        return $this->hasManyThrough(
            AnalisisIndicador::class,
            Indicadorable::class,
        );
    }

    // relación muchos a muchos polimorfica
    public function escuelas()
    {
        return $this->morphedByMany(Escuela::class, 'indicadorable');
    }

    public function facultades()
    {
        return $this->morphedByMany(Facultad::class, 'indicadorable');
    }

    public function unidadMedida()
    {
        return $this->belongsTo(UnidadMedida::class);
    }
}
