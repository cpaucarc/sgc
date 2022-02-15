<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaInvestigacion extends Model
{
    use HasFactory;

    protected $table = "area_investigacion";
    public $timestamps = false;
    public $fillable = ['nombre', 'facultad_id'];
}
