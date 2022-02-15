<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = "proveedores";
    public $timestamps = false;
    public $fillable = ['actividad_id', 'oficina_id', 'entrada_id'];
}
