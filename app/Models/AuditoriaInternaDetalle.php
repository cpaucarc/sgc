<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditoriaInternaDetalle extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'auditoria_interna_detalle';
    protected $fillable = ['observacion', 'auditoria_interna_id', 'responsable_salida_id', 'documentos'];

    public function responsable_salida()
    {
        return $this->belongsTo(ResponsableSalida::class);
    }
}
