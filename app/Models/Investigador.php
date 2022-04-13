<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investigador extends Model
{
    use HasFactory;

    protected $table = "investigadores";
    public $timestamps = false;
    public $fillable = ['es_docente', 'dni_investigador'];

}
