<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurado extends Model
{
    use HasFactory;

//    protected $table = "jurados";
    public $timestamps = false;
    public $fillable = ['codigo_colegiatura', 'codigo_docente', 'colegio_id'];

    public function colegio()
    {
        return $this->belongsTo(Colegio::class);
    }
}
