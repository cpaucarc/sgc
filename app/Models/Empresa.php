<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    public $fillable = ['nombre', 'ruc', 'telefono', 'correo', 'direccion', 'ubicacion', 'user_id'];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function rsu()
    {
        return $this->hasMany(ResponsabilidadSocial::class);
    }

}
