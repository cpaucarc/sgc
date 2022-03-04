<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proceso extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $fillable = ['nombre'];

    public static function getNombreById($id)
    {
        return Proceso::where('id', $id)->pluck('nombre')->first();
    }

    public function actividades()
    {
        return $this->hasMany(Actividad::class);
    }
}
