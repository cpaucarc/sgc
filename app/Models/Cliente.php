<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cliente extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $fillable = ['responsable_id', 'salida_id', 'entidad_id'];

    public function salida()
    {
        return $this->belongsTo(Salida::class);
    }

    public function entidad()
    {
        return $this->belongsTo(Entidad::class);
    }
}
