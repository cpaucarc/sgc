<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicadorable extends Model
{
    use HasFactory;

    protected $table = "indicadorables";
    public $timestamps = false;
    public $fillable = ['cod_ind_final', 'minimo', 'sobresaliente', 'indicadorable_id', 'indicadorable_type', 'indicador_id'];

    public function indicador()
    {
        return $this->belongsTo(Indicador::class);
    }

    public function analisis()
    {
        return $this->hasMany(AnalisisIndicador::class);
    }

}
