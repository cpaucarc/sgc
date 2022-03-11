<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{
    use HasFactory;

    public $fillable = ['uuid', 'responsable', 'es_auditoria_interno', 'facultad_id'];

    public function facultad()
    {
        return $this->belongsTo(Facultad::class);
    }

    // relacion uno a muchos polimorfica
    public function documentos()
    {
        return $this->morphMany(DocumentoEnviado::class, 'documentable')
            ->with('documento');
    }
}
