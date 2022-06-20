<?php

namespace App\Http\Livewire\Admin;

use App\Models\Oge;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;

class CrearUsuario extends Component
{
    public $open = false;
    public $nombres = "", $dni = "", $correo = "", $contrasena = "";
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
            $response = Oge::datos($this->dni);
            $this->asignarDatos($response);
        } else {
            $this->mensaje = "El DNI deberia tener 8 digitos, solo hay " . strlen($this->dni);
        }
    }

    public function asignarDatos($datos)
    {
        if (!is_null($datos) && isset($datos['dni'])) {
            $this->mensaje = null;
            $this->nombres = ucwords(strtolower($datos['nombre_completo']));
            $this->correo = isset($datos['correo_institucional']) ? $this->crearCorreo($datos) : strtolower($datos['correo_institucional']);
            $this->contrasena = $this->dni;
        } else {
            $this->mensaje = "No hay registros que coincidan con el DNI " . $this->dni;
            $this->reset('nombres', 'dni', 'correo', 'contrasena');
        }
    }

    public function crearCorreo($datos)
    {
        if (is_null($datos)) {
            return "corre_aleatorio" . rand(1, 99999) . '@mail.com';
        }

        $apellido_paterno = strtolower($datos['apellido_paterno']);
        $apellido_materno = strtolower(substr($datos['apellido_materno'], 0, 1));
        $nombres = strtolower(substr($datos['nombres'], 0, 1));

        return $nombres . $apellido_paterno . $apellido_materno . '@unasam.edu.pe';
    }

}
