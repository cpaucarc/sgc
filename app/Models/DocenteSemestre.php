<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocenteSemestre extends Model
{
    use HasFactory;

    protected $table = 'docente_semestre';
    public $timestamps = false;
    public $fillable = ['cumple_40h', 'cumplio_40h', 'cumplio_labores', 'docente_id', 'semestre_id', 'departamento_id'];
}
