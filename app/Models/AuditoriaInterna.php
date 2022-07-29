<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditoriaInterna extends Model
{
    use HasFactory;
    protected $table = 'auditorias_internas';
    protected $fillable = ['auditor_dni', 'auditor_nombre', 'observacion', 'facultad_id', 'semestre_id', 'user_id'];

    public function facultad()
    {
        return $this->belongsTo(Facultad::class);
    }

    public function semestre()
    {
        return $this->belongsTo(Semestre::class);
    }

    public function detalles()
    {
        return $this->hasMany(AuditoriaInternaDetalle::class);
    }
}
