<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oficina extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $fillable = ['nombre'];

    public function actividad_responsable()
    {
        return $this->belongsToMany(Actividad::class, 'responsables')
            ->with('tipo');
    }
}
