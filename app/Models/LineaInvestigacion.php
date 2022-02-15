<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineaInvestigacion extends Model
{
    use HasFactory;

    protected $table = "linea_investigacion";
    public $timestamps = false;
    public $fillable = ['nombre', 'area_id'];
}
