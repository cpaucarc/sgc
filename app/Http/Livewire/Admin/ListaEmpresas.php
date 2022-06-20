<?php

namespace App\Http\Livewire\Admin;

use App\Models\Empresa;
use Livewire\Component;

class ListaEmpresas extends Component
{
    public $search = "";
    public $cantidad = -1; // Cantidad de RSU donde se encuentra la empresa
    public $users = [];

    public function render()
    {
        $empresas = Empresa::query()
            ->with('usuario:id,name,activo')
            ->withCount('rsu')
            ->where(function ($query) {
                $query->where('nombre', 'like', '%' . $this->search . '%')
                    ->orWhere('ruc', 'like', '%' . $this->search . '%');
            });

        if (count($this->users)) {
            $empresas = $empresas->whereIn('user_id', array_keys($this->users));
        }

        $empresas = $empresas->orderBy('created_at', 'desc')
            ->get();

        if ($this->cantidad > -1) {
            if ($this->cantidad === 2)
                $empresas = $empresas->whereBetween('rsu_count', [2, 5]);
            elseif ($this->cantidad === 3)
                $empresas = $empresas->whereBetween('rsu_count', [6, 10]);
            elseif ($this->cantidad === 4)
                $empresas = $empresas->whereBetween('rsu_count', [11, 50]);
            elseif ($this->cantidad === 5)
                $empresas = $empresas->whereBetween('rsu_count', [51, 100]);
            elseif ($this->cantidad === 6)
                $empresas = $empresas->where('rsu_count', '>', 100);
            else
                $empresas = $empresas->where('rsu_count', $this->cantidad);
        }

        return view('livewire.admin.lista-empresas', compact('empresas'));
    }

    public function agregarUsuario($user_id, $username)
    {
        if (!array_key_exists($user_id, $this->users))
            $this->users[$user_id] = $username;
    }

    public function quitarUsuario($user_id)
    {
        unset($this->users[$user_id]);
    }
}
