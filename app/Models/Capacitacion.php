<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capacitacion extends Model
{
    use HasFactory;

    public $table = 'capacitaciones';
    public $fillable = ['uuid', 'nombre', 'departamento_id', 'semestre_id'];

    public function docentes()
    {
        return $this->belongsToMany(Docente::class);
    }
}
