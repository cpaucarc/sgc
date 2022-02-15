<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semestre extends Model
{
    use HasFactory;

    public $fillable = ['nombre', 'fecha_inicio', 'fecha_fin'];
    public $timestamps = false;

    protected $dates = [
        'fecha_inicio',
        'fecha_fin',
    ];
}
