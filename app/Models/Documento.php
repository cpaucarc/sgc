<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;

    public $fillable = ['nombre', 'enlace_interno', 'enlace_externo', 'semestre_id', 'entidad_id', 'user_id'];

    public function entidad()
    {
        return $this->belongsTo(Entidad::class);
    }

    //Relación de uno a muchos
    /*public function documento_tesis()
    {
        return $this->hasMany(DocumentoTesis::class);
    }

    //Relación de uno a muchos
    public function documento_solicitud_titulo()
    {
        return $this->hasMany(DocumentoSolicitudTitulo::class);
    }

    //Relación de uno a muchos
    public function formato_requisito()
    {
        return $this->hasMany(FormatoRequisito::class);
    }*/
}
