<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandaAdministrativo extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $table = 'demanda_administrativos';
    public $fillable = ['num_docentes', 'num_administrativos', 'departamento_id', 'semestre_id'];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    public function semestre()
    {
        return $this->belongsTo(Semestre::class);
    }
}
