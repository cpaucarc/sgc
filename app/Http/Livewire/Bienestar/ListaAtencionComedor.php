<?php

namespace App\Http\Livewire\Bienestar;

use App\Models\BienestarAtencion;
use App\Models\Comedor;
use App\Models\Servicio;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListaAtencionComedor extends Component
{
    public $mes, $anios = null, $anio, $escuelas, $servicios, $servicio = 0;
    protected $listeners = [
        "cargarDatos" => "render",
        "eliminar"
    ];

    public function mount()
    {
        $this->mes = 0;
        $this->anio = now()->year;
        $this->escuelas = User::escuelas_id(Auth::user()->id);
        $this->servicios = Servicio::query()->select('id', 'nombre')->get();
    }

    public function render()
    {
        $atenciones = BienestarAtencion::query()
            ->with('servicio', 'escuela')
            ->whereIn('escuela_id', $this->escuelas)
            ->where('anio', 'like', '%' . $this->anio . '%');

        if ($this->mes > 0)
            $atenciones = $atenciones->where('mes', 'like', '%' . $this->mes . '%');

        if ($this->servicio > 0)
            $atenciones = $atenciones->whereIn('servicio_id', function ($query) {
                $query->from('servicios')->select('id')->where('id', $this->servicio);
            });

        $atenciones = $atenciones->orderBy('anio', 'desc')->orderBy('mes', 'desc')->paginate(15);

        $this->anios = BienestarAtencion::query()->orderBy('anio')->distinct()->pluck('anio');

        return view('livewire.bienestar.lista-atencion-comedor', compact('atenciones'));
    }

    public function eliminar($id)
    {
        BienestarAtencion::find($id)->delete();
    }

}
