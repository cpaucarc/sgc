<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investigacion extends Model
{
    use HasFactory;

    protected $table = "investigaciones";
    public $fillable = ['titulo', 'uuid', 'resumen', 'fecha_publicacion', 'escuela_id', 'sublinea_id', 'estado_id'];

    public $dates = ['fecha_publicacion'];

    public function escuela()
    {
        return $this->belongsTo(Escuela::class);
    }

    public function sublinea()
    {
        return $this->belongsTo(SublineaInvestigacion::class, 'sublinea_id', 'id')
            ->with('linea');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function financiaciones()
    {
        return $this->belongsToMany(Financiador::class, 'investigacion_financiacion')
            ->withPivot(['presupuesto'])
            ->withTimestamps();
    }

    public function investigadores()
    {
        return $this->belongsToMany(Investigador::class, 'investigacion_investigadores')
            ->withPivot(['es_responsable']);
    }

}
