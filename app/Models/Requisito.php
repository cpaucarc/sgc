<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisito extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $fillable = ['nombre', 'descripcion', 'proceso_id'];
}
