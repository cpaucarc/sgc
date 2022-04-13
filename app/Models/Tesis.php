<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tesis extends Model
{
    use HasFactory;

    protected $table = "tesis";
    public $timestamps = false;
    public $fillable = ['numero_registro', 'titulo', 'anio', 'dni_estudiante', 'escuela_id', 'asesor_id', 'tipo_tesis_id'];

    public function escuela()
    {
        return $this->belongsTo(Escuela::class);
    }

    public function tipoTesis()
    {
        return $this->belongsTo(TipoTesis::class);
    }

    public function jurado()
    {
        return $this->belongsTo(Jurado::class);
    }
}
