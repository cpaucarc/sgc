<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EncuestaLink extends Model
{
    use HasFactory;

//    public $timestamps = false;
    protected $table = 'encuesta_links';
    public $fillable = ['link', 'fecha_expiracion', 'encuestable_id', 'encuestable_type'];
    protected $dates = ['fecha_expiracion',];

    public function encuestable()
    {
        return $this->morphTo();
    }
}
