<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestigacionFinanciacion extends Model
{
    use HasFactory;

    protected $table = "investigacion_financiacion";
//    public $timestamps = false;
    public $fillable = ['presupuesto', 'investigacion_id', 'financiador_id'];
}
