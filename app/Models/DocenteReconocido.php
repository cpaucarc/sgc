<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocenteReconocido extends Model
{
    use HasFactory;

    public $table = 'docente_reconocidos';
    public $fillable = ['docente_id', 'reconocido', 'departamento_id', 'semestre_id'];

    public function docentes()
    {
        return $this->belongsToMany(Docente::class);
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    public function semestre()
    {
        return $this->belongsTo(Semestre::class);
    }

}
