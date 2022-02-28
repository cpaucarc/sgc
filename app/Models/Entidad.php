<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entidad extends Model
{
    use HasFactory;

    protected $table = "entidades";
    public $timestamps = false;
    public $fillable = ['nombre', 'oficina_id'];

    public function oficina()
    {
        return $this->belongsTo(Oficina::class);
    }

    // relación uno a muchos polimorfica
    public function salidas()
    {
//        return $this->belongsToMany(Salida::class, 'clientes');
        return $this->hasMany(Cliente::class)
            ->with('responsable', 'salida');
    }

    // relación uno a muchos polimorfica
    public function entradas()
    {
//        return $this->belongsToMany(Entrada::class, 'proveedores');
        return $this->hasMany(Proveedor::class)
            ->with('responsable', 'entrada');
    }

    // relación uno a muchos polimorfica
    public function actividades()
    {
        return $this->belongsToMany(Actividad::class, 'responsables')
            ->with('proceso', 'tipo');
    }

    // relación uno a muchos polimorfica
    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'entidad_user')
            ->withPivot('activo');
    }

    public function pertenencia()
    {
        return $this->hasOne(Entidadable::class)
            ->with('entidadable');
    }

}
