<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocenteDedicacion extends Model
{
    use HasFactory;

    protected $table = "docente_dedicacion";
    public $timestamps = false;
    public $fillable = ['nombre'];
}
