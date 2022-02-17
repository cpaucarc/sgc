<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentoEnviado extends Model
{
    use HasFactory;

    protected $table = "documento_enviado";
    public $timestamps = false;
    public $fillable = ['documentable_id', 'documentable_type', 'documento_id'];

    //relacion uno a muchos polimorfica con Entrada, Salida
    public function documentable()
    {
        return $this->morphTo();
    }

    public function documento()
    {
        return $this->belongsTo(Documento::class);
    }

}
