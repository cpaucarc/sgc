<?php

namespace App\Http\Livewire\Admin;

use App\Models\Docente;
use App\Models\Oge;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;

class CrearUsuario extends Component
{
    public $open = false;
    public $nombres = "", $dni = "", $correo = "", $ap_paterno = "", $ap_materno = "", $celular = null;
    public $nombre_usuario = "", $contrasena = "";
    public $persona = null;
    public $mensaje = null;

    protected $rules = [
        'nombres' => 'required|max:250',
        'ap_paterno' => 'required|max:250',
        'ap_materno' => 'required|max:250',
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
        try {
            $this->nombre_usuario = explode(" ", $this->nombres)[0] . " " . $this->ap_paterno;
            if (is_null($this->persona)) {
                $this->persona = Persona::create([
                    "dni" => $this->dni,
                    "nombres" => $this->nombres,
                    "apellido_paterno" => $this->ap_paterno,
                    "apellido_materno" => $this->ap_materno,
                    "correo" => $this->correo,
                    "celular" => $this->celular,
                ]);
            }

            $usuario = User::query()->where('persona_id', $this->persona->id)->exists();

            if ($usuario) {
                $this->mensaje = "Esta persona ya tiene asignado un usuario en el sistema";
            } else {
                User::create([
                    'name' => $this->nombre_usuario,
                    'uuid' => Str::uuid(),
                    'persona_id' => $this->persona->id,
                    'email' => $this->correo,
                    'password' => Hash::make($this->contrasena),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                $msg = "El usuario " . $this->nombre_usuario . " fue creado corretamente";
                $this->emit('guardado', ['titulo' => 'Usuario creado', 'mensaje' => $msg]);

                $this->reset('open', 'nombres', 'ap_paterno', 'ap_materno', 'dni', 'correo', 'celular', 'persona', 'contrasena');
                $this->emitTo('admin.lista-usuarios', 'render');
            }
        } catch (\Exception $e) {
            $this->emit('error', "Hubo un error inesperado: \n" . $e);
        }
    }

    public function buscar()
    {
        if (strlen($this->dni) === 8) {

            $this->mensaje = null;

            $persona = Persona::where('dni', $this->dni)->first();

            if (!is_null($persona)) {
                $this->persona = $persona;
                $this->dni = $persona->dni;
                $this->nombres = $persona->nombres;
                $this->ap_paterno = $persona->apellido_paterno;
                $this->ap_materno = $persona->apellido_materno;
                $this->correo = $persona->correo;
                $this->celular = $persona->celular;
            } else {
                $response = Oge::datos($this->dni);
                $this->asignarDatos($response);
            }

            $this->contrasena = $this->dni;
        } else {
            $this->mensaje = "El DNI deberia tener 8 digitos, actualmente hay " . strlen($this->dni) . " digitos.";
        }
    }

    public function asignarDatos($datos)
    {
        if (!is_null($datos) && isset($datos['dni'])) {
            $this->dni = strtoupper($datos['dni']);
            $this->nombres = strtoupper($datos['nombres']);
            $this->ap_paterno = strtoupper($datos['apellido_paterno']);
            $this->ap_materno = strtoupper($datos['apellido_materno']);
            $this->correo = $this->obtenerCorreo($datos['correo_institucional'], $datos['email']);
            $this->celular = $datos['celular'];
        } else {
            $this->mensaje = "No hay registros que coincidan con el DNI " . $this->dni;
            $this->reset('nombres', 'ap_paterno', 'ap_materno', 'dni', 'correo', 'contrasena', 'celular');
        }
    }

    public function obtenerCorreo($correo_institucional, $correo_personal)
    {
        if (strlen($correo_institucional) > 0) {
            return strtolower($correo_institucional);
        }

        if (strlen($correo_personal) > 0) {
            return strtolower($correo_personal);
        }

        return "";
    }

}
