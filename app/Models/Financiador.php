<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Financiador extends Model
{
    use HasFactory;

    protected $table = "financiadores";
    public $timestamps = false;
    public $fillable = ['nombre'];
}
