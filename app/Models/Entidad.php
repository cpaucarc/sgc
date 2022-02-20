<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entidad extends Model
{
    use HasFactory;

    protected $table = "entidades";
    public $timestamps = false;
    public $fillable = ['nombre', 'oficina_id'];

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'entidad_user')
            ->withPivot('activo');
    }
}
