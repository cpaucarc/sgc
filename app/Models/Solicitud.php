<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    protected $table = "solicitudes";
    public $fillable = ['dni_estudiante', 'tipo_solicitud_id', 'estado_id'];

    public function estado()
    {
        return $this->belongsTo(Estado::class)
            ->with('categoriaEstado');
    }

    public function documentos()
    {
        return $this->hasMany(DocumentoSolicitud::class)
            ->with('documento', 'requisito');
    }
}
