<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JuradoSustentacion extends Model
{
    use HasFactory;

    protected $table = "jurado_sustentacion";
    public $timestamps = false;
    public $fillable = ['nota_jurado', 'jurado_id', 'sustentacion_id', 'cargo_jurado_id'];

    public function jurado()
    {
        return $this->belongsTo(Jurado::class)
            ->with('colegio');
    }

    public function cargoJurado()
    {
        return $this->belongsTo(CargoJurado::class);
    }

}
