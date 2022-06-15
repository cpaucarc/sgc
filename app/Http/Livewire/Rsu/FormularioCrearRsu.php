<?php

namespace App\Http\Livewire\Rsu;

use App\Lib\UsuarioHelper;
use App\Models\Entidadable;
use App\Models\Escuela;
use App\Models\Oficina;
use App\Models\ResponsabilidadSocial;
use App\Models\RsuParticipante;
use App\Models\Semestre;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;

class FormularioCrearRsu extends Component
{
    public $titulo;
    public $descripcion;
    public $lugar;
    public $fecha_de_inicio;
    public $fecha_de_finalizacion;
    public $escuela; //Id de la escuela
    public $en_empresa = false;
    public $empresa_id = 0;
    public $empresa_nombre = "";
    public $escuelas = null;

    protected $listeners = ['enviarEmpresa' => 'recibirEmpresa'];

    protected $rules = [
        'titulo' => 'required',
        'descripcion' => 'nullable',
        'lugar' => 'required',
        'fecha_de_inicio' => 'required|date|after:now',
        'fecha_de_finalizacion' => 'required|date|after:fecha_de_inicio',
        'escuela' => 'required|integer|gt:0',
        'empresa_id' => 'required_if:en_empresa,1|nullable|integer'
    ];

    public function mount()
    {
        $this->escuelas = UsuarioHelper::escuelasDelUsuario();

        // Si solo hay una escuela, asignarlo por defecto y ya no mostrar el select en la vista
        if (count($this->escuelas) === 1) {
            $this->escuela = $this->escuelas->first()->id;
        }
    }

    public function render()
    {
        return view('livewire.rsu.formulario-crear-rsu');
    }

    /* Funciones */
    public function updatedEnEmpresa($value)
    {
        if (!$value) {
            $this->empresa_id = 0;
            $this->empresa_nombre = "";
        }
    }

    public function recibirEmpresa($empresa_id, $empresa_nombre)
    {
        $this->empresa_id = $empresa_id;
        $this->empresa_nombre = $empresa_nombre;
    }

    public function guardarRSU()
    {
        $this->validate();
        $rsu = ResponsabilidadSocial::create([
            'titulo' => $this->titulo,
            'uuid' => Str::uuid(),
            'descripcion' => $this->descripcion,
            'lugar' => $this->lugar,
            'fecha_inicio' => $this->fecha_de_inicio,
            'fecha_fin' => $this->fecha_de_finalizacion,
            'semestre_id' => Semestre::orderBy('nombre', 'desc')->first()->id,
            'escuela_id' => $this->escuela,
            'empresa_id' => $this->en_empresa ? $this->empresa_id : null
        ]);

        //Oficinas al cual pertenece el usuario actual
        $oficinas = Oficina::whereIn('id', function ($query) {
            $query->select('oficina_id')->from('entidades')
                ->whereIn('id', function ($query2) {
                    $query2->select('entidad_id')->from('entidad_user')
                        ->where('user_id', Auth::user()->id);
                });
        })->pluck('id');

        RsuParticipante::create([
            'fecha_incorporacion' => now()->format('Y-m-d'),
            'es_responsable' => true,
            'es_estudiante' => $oficinas->contains(9), // Tabla Oficinas: 9-Estudiante
            'dni_participante' => Auth::user()->dni,
            'responsabilidad_social_id' => $rsu->id
        ]);

        $this->emit('guardado', "La RSU llamada '" . $this->titulo . "' fue creado con éxito.");

        return redirect()->route('rsu.index');
    }

}
