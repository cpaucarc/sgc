<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadMedida extends Model
{
    use HasFactory;

    protected $table = "unidad_medida";
    public $timestamps = false;
    public $fillable = ['nombre'];
}
