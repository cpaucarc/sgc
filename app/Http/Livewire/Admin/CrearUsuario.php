<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;

class CrearUsuario extends Component
{
    public $open = false;
    public $nombres = "", $dni = "", $correo = "", $contrasena = "";
    public $en_docente = true;
    public $mensaje = null;

    protected $rules = [
        'nombres' => 'required|max:250',
        'dni' => 'required|max:8|min:8',
        'correo' => 'required|email|unique:users,email',
        'contrasena' => 'required|min:4'
    ];

    public function render()
    {
        return view('livewire.admin.crear-usuario');
    }

    /* Funciones */
    public function openModal()
    {
        $this->open = true;
    }

    public function crearUsuario()
    {
        $this->validate();
        User::create([
            'name' => $this->nombres,
            'uuid' => Str::uuid(),
            'dni' => $this->dni,
            'email' => $this->correo,
            'password' => Hash::make($this->contrasena),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $this->reset('open', 'nombres', 'dni', 'correo', 'contrasena');
        $this->emitTo('admin.lista-usuarios', 'render');
    }

    public function buscar()
    {
        if (strlen($this->dni) === 8) {
            $url = $this->en_docente ? 'proceso_docente/01?codigo=' . $this->dni
                : 'ensenianza_aprendizaje/01?codigo=' . $this->dni;

            $response = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . $url);
            $response = $response->json();

            $this->asignarDatos($response);
        } else {
            $this->mensaje = "El DNI deberia tener 8 digitos, solo hay " . strlen($this->dni);
        }
    }

    public function asignarDatos($datos)
    {
        if (isset($datos['dni'])) {
            $this->mensaje = null;
            $this->nombres = ucwords(strtolower($datos['nombre_completo']));
            $this->correo = strtolower($datos['correo_institucional']);
            $this->contrasena = $this->dni;
        } else {
            $this->mensaje = "No hay registros que coincidan con el DNI " . $this->dni
                . "\nabc";
            $this->reset('nombres', 'dni', 'correo', 'contrasena');
        }
    }

}
