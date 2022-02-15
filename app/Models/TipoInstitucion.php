<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoInstitucion extends Model
{
    use HasFactory;

    protected $table = 'tipo_institucion';
    public $timestamps = false;
    public $fillable = ['nombre'];
}
