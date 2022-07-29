<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Salida extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $fillable = ['codigo', 'nombre', 'descripcion', 'proceso_id'];

    public function clientes()
    {
        return $this->belongsToMany(Entidad::class, 'clientes');
    }

    // relacion uno a muchos polimorfica
    public function documentos()
    {
        return $this->morphMany(DocumentoEnviado::class, 'documentable')
            ->with('documento')
            ->whereHas('documento', function ($query) {
                $query->where('user_id', Auth::user()->id);
            });
    }

    public static function documentos_por_semestre($semestre, $entidades, $salida)
    {
        return DocumentoEnviado::query()
            ->where('documentable_id', $salida)
            ->where('documentable_type', 'App\\Models\\Salida')
            ->whereIn('documento_id', function ($query) use ($semestre, $entidades) {
                $query->select('id')->from('documentos')->where('semestre_id', $semestre)->whereIn('entidad_id', $entidades);
            })->count();
    }
}
