<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialBibliografico extends Model
{
    use HasFactory;

    protected $table = "material_bibliografico";
    public $timestamps = false;
    public $fillable = ['fecha_inicio', 'fecha_fin', 'adquirido', 'prestado', 'perdido',
        'restaurados', 'total_libros', 'semestre_id', 'facultad_id'];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
    ];

    public function semestre()
    {
        return $this->belongsTo(Semestre::class);
    }

    public function facultad()
    {
        return $this->belongsTo(Facultad::class);
    }

}
