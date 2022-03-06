<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Convalidacion extends Model
{
    use HasFactory;

    protected $table = 'convalidaciones';
    public $fillable = ['vacantes', 'postulantes', 'convalidados', 'semestre_id', 'escuela_id'];

    public function semestre()
    {
        return $this->belongsTo(Semestre::class);
    }

    public function escuela()
    {
        return $this->belongsTo(Escuela::class)
            ->with('facultad');
    }
}
