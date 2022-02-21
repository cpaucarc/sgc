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

    // relación uno a muchos polimorfica
    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'entidad_user')
            ->withPivot('activo');
    }

    // relación muchos a muchos polimorfica
    public function escuelas()
    {
        return $this->morphedByMany(Escuela::class, 'indicadorable');
    }

    // relación muchos a muchos polimorfica
    public function facultades()
    {
        return $this->morphedByMany(Facultad::class, 'indicadorable');
    }
}
