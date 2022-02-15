<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaEstado extends Model
{
    use HasFactory;

    protected $table = "categoria_estado";
    public $timestamps = false;
    public $fillable = ['nombre'];
}
