<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

//    protected $table = "estados";
    public $timestamps = false;
    public $fillable = ['nombre', 'color', 'categoria_id'];

    public function categoriaEstado()
    {
        return $this->belongsTo(CategoriaEstado::class);
    }
}
