<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $fillable = ['nombre', 'ruc', 'telefono', 'correo', 'direccion', 'ubicacion'];

}
