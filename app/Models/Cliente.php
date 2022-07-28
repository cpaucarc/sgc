<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cliente extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $fillable = ['responsable_salida_id', 'entidad_id'];

    public function entidad()
    {
        return $this->belongsTo(Entidad::class);
    }

    public function respsalida()
    {
        return $this->hasOne(ResponsableSalida::class, 'id', 'responsable_salida_id')
            ->with('responsable', 'responsable.actividad', 'responsable.actividad.proceso', 'salida');
    }
}
