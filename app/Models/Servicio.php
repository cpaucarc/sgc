<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $table = "servicios";
    public $timestamps = false;
    public $fillable = ['uuid','nombre'];

    public function atenciones()
    {
        return $this->hasMany(BienestarAtencion::class)->orderBy('mes');
    }
}
