<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BolsaPostulante extends Model
{
    use HasFactory;

    protected $table = "bolsa_postulantes";
    public $timestamps = false;
    public $fillable = ['fecha_inicio', 'fecha_fin', 'postulantes', 'beneficiados', 'semestre_id', 'escuela_id'];

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
