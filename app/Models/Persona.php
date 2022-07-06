<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $fillable = ['apellido_paterno', 'apellido_materno', 'nombres', 'dni', 'correo', 'celular'];
}
