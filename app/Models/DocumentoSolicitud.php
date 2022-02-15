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
}
