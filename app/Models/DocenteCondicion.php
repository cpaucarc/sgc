<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocenteCondicion extends Model
{
    use HasFactory;

    protected $table = "docente_condicion";
    public $timestamps = false;
    public $fillable = ['nombre'];
}
