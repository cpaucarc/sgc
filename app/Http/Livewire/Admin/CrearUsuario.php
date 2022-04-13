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
    public $nombres, $dni, $correo, $contrasena = "password";

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

}
