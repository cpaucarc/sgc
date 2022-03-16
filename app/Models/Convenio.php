<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Convenio extends Model
{
    use HasFactory;

    protected $table = 'convenios';
    public $fillable = ['realizados', 'vigentes', 'culminados', 'semestre_id', 'facultad_id'];

    public function semestre()
    {
        return $this->belongsTo(Semestre::class);
    }

    public function facultad()
    {
        return $this->belongsTo(Facultad::class)->orderBy('nombre');
    }
}
