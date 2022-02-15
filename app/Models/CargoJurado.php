<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CargoJurado extends Model
{
    use HasFactory;

    protected $table = "cargo_jurado";
    public $timestamps = false;
    public $fillable = ['nombre'];
}
