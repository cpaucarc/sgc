<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responsable extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $fillable = ['actividad_id', 'entidad_id'];

    public function actividad()
    {
        return $this->belongsTo(Actividad::class)
            ->with('proceso', 'tipo');
    }

    public function entidad()
    {
        return $this->belongsTo(Entidad::class);
    }
}
