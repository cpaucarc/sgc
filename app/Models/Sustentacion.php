<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sustentacion extends Model
{
    use HasFactory;

    protected $table = "sustentaciones";
    public $timestamps = false;
    public $fillable = ['fecha_sustentacion', 'tesis_id', 'estado_id'];

}
