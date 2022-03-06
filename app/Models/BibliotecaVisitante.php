<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BibliotecaVisitante extends Model
{
    use HasFactory;

    protected $table = "biblioteca_visitantes";
    public $timestamps = false;
    public $fillable = ['fecha_inicio', 'fecha_fin', 'visitantes', 'semestre_id', 'escuela_id'];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
    ];

    public function semestre()
    {
        return $this->belongsTo(Semestre::class);
    }

    public function escuela()
    {
        return $this->belongsTo(Escuela::class);
    }
}
