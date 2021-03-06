<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class Entidad extends Model
{
    use HasFactory;

    protected $table = "entidades";
    public $timestamps = false;
    public $fillable = ['nombre', 'facultad_id', 'role_id'];

    public function rol()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function facultad()
    {
        return $this->belongsTo(Facultad::class, 'facultad_id', 'id');
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
            ->withPivot('id')->with('proceso', 'tipo');
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
