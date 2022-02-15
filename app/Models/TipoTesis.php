<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoTesis extends Model
{
    use HasFactory;

    protected $table = "tipo_tesis";
    public $timestamps = false;
    public $fillable = ['nombre'];
}
