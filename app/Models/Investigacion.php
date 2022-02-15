<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investigacion extends Model
{
    use HasFactory;

    protected $table = "investigaciones";
    public $fillable = ['titulo', 'resumen', 'fecha_publicacion', 'escuela_id', 'sublinea_id', 'estado_id'];

    public $dates = ['fecha_publicacion'];
}
