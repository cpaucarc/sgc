<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentoSolicitud extends Model
{
    use HasFactory;

    protected $table = 'documento_solicitud';
    public $timestamps = false;
    public $fillable = ['feedback', 'requisito_id', 'documento_id', 'solicitud_id', 'estado_id'];

    public function requisito()
    {
        return $this->belongsTo(Requisito::class);
    }

    public function documento()
    {
        return $this->belongsTo(Documento::class);
    }

    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class);
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class)
            ->with('categoriaEstado');
    }
}
