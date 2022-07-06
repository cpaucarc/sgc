<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BienestarAtencion extends Model
{
    use HasFactory;

    public $dateFormat = 'Y-m';

    public $table = 'bienestar_atenciones';
    public $timestamps = false;
    public $fillable = ['servicio_id', 'mes', 'anio', 'atenciones', 'total', 'escuela_id'];
    public $dates = ['fecha'];

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }

    public function escuela()
    {
        return $this->belongsTo(Escuela::class);
    }
}
