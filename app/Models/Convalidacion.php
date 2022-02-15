<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Convalidacion extends Model
{
    use HasFactory;

    protected $table = 'convalidaciones';
    public $fillable = ['vacantes', 'semestre_id', 'escuela_id'];
    public $timestamps = false;
}
