<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comedor extends Model
{
    use HasFactory;

    public $dateFormat = 'Y-m';

    public $table = 'comedor';
    public $timestamps = false;
    public $fillable = ['mes', 'anio', 'atenciones', 'total', 'escuela_id'];
    public $dates = ['fecha'];

    public function escuela()
    {
        return $this->belongsTo(Escuela::class);
    }
}
