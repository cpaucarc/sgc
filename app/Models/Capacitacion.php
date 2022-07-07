<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capacitacion extends Model
{
    use HasFactory;

    public $table = 'capacitaciones';
    public $fillable = ['uuid', 'nombre','fecha_inicio','fecha_fin', 'departamento_id', 'semestre_id'];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    public function semestre()
    {
        return $this->belongsTo(Semestre::class);
    }

    public function docentes()
    {
        return $this->belongsToMany(Docente::class);
    }
}
