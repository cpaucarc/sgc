<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $fillable = ['nombre', 'facultad_id'];

    public function facultad()
    {
        return $this->belongsTo(Facultad::class);
    }
}
