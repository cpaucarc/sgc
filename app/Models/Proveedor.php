<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = "proveedores";
    public $timestamps = false;
    public $fillable = ['responsable_id', 'entidad_id', 'entrada_id'];

    public function entidad()
    {
        return $this->belongsTo(Entidad::class);
    }

    public function entrada()
    {
        return $this->belongsTo(Entrada::class);
    }

    public function responsable()
    {
        return $this->belongsTo(Responsable::class)
            ->with('entidad', 'actividad', 'actividad.proceso');
    }
}
