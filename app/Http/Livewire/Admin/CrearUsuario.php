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
    public $nombres, $codigo, $correo, $contrasena = "password";

    protected $rules = [
        'nombres' => 'required|max:250',
        'codigo' => 'required|max:15|min:5',
        'correo' => 'required|email|unique:users,email',
        'contrasena' => 'required|min:4'
    ];

    public function render()
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/users/1');

        return view('livewire.admin.crear-usuario', compact('response'));
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
            'codigo' => $this->codigo,
            'email' => $this->correo,
            'password' => Hash::make($this->contrasena),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $this->reset('open', 'nombres', 'codigo', 'correo', 'contrasena');
        $this->emitTo('admin.lista-usuarios', 'render');
    }

}
