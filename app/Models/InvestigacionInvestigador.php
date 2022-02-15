<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestigacionInvestigador extends Model
{
    use HasFactory;

    protected $table = "investigacion_investigadores";
    public $timestamps = false;
    public $fillable = ['es_responsable', 'investigacion_id', 'investigador_id'];
}
