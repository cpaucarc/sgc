<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ResponsableSalida extends Model
{
    use HasFactory;

    public $table = 'responsables_salidas';
    public $timestamps = false;
    public $fillable = ['responsable_id', 'salida_id'];

    public function responsable()
    {
        return $this->belongsTo(Responsable::class)
            ->with('actividad', 'entidad');
    }

    public function salida()
    {
        return $this->belongsTo(Salida::class);
    }

    public function clientes()
    {
        return $this->hasMany(Cliente::class)->with('entidad');
    }

    // relacion uno a muchos polimorfica
    public function documentos()
    {
        return $this->morphMany(DocumentoEnviado::class, 'documentable')
            ->with('documento');
    }

    public static function cant_documentos_por_semestre($semestre, $entidades, $resp_salida)
    {
        return DocumentoEnviado::query()
            ->where('documentable_id', $resp_salida)
            ->where('documentable_type', 'App\\Models\\ResponsableSalida')
            ->whereIn('documento_id', function ($query) use ($semestre, $entidades) {
                $query->select('id')->from('documentos')->where('semestre_id', $semestre)->whereIn('entidad_id', $entidades);
            })->count();
    }
}
