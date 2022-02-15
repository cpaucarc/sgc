<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SublineaInvestigacion extends Model
{
    use HasFactory;

    protected $table = "sublinea_investigacion";
    public $timestamps = false;
    public $fillable = ['nombre', 'linea_id'];
}
