<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responsable extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $fillable = ['actividad_id', 'oficina_id'];
}
