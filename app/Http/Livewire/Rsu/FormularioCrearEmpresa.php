<?php

namespace App\Http\Livewire\Rsu;

use App\Models\Empresa;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FormularioCrearEmpresa extends Component
{
    public $nombre;
    public $ruc;
    public $telefono;
    public $correo;
    public $direccion;
    public $ubicacion;
    protected $rules = [
        'nombre' => 'required',
        'ruc' => 'nullable|min:11|max:11',
        'telefono' => 'nullable|min:9|max:13',
        'correo' => 'nullable|email',
        'direccion' => 'nullable',
        'ubicacion' => 'nullable',
    ];

    public function render()
    {
        return view('livewire.rsu.formulario-crear-empresa');
    }

    public function guardarEmpresa()
    {
        $this->validate();
        try {
            Empresa::create([
                'nombre' => $this->nombre,
                'ruc' => $this->ruc,
                'telefono' => $this->telefono,
                'correo' => $this->correo,
                'direccion' => $this->direccion,
                'ubicacion' => $this->ubicacion,
                'user_id' => Auth::user()->id
            ]);

            $msg = "La empresa llamada '" . $this->nombre . "' fue creado con éxito.";
            $this->emit('guardado', ['titulo' => 'Empresa creado', 'mensaje' => $msg]);
            return redirect()->route('rsu.business');
        } catch (\Exception $e) {
            $this->emit('error', "Hubo un error inesperado: \n" . $e);
        }
    }
}
