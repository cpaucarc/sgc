<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $fillable = ['grado', 'persona_id', 'departamento_id', 'categoria_id', 'condicion_id', 'dedicacion_id'];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function categoria()
    {
        return $this->belongsTo(DocenteCategoria::class, 'categoria_id');
    }

    public function condicion()
    {
        return $this->belongsTo(DocenteCondicion::class, 'condicion_id');
    }

    public function dedicacion()
    {
        return $this->belongsTo(DocenteDedicacion::class, 'dedicacion_id');
    }
}
