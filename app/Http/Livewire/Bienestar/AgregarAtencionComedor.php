<?php

namespace App\Http\Livewire\Bienestar;

use App\Models\BienestarAtencion;
use App\Models\Servicio;
use App\Models\Comedor;
use App\Models\Escuela;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AgregarAtencionComedor extends Component
{
    public $fecha, $cantidad, $total = null, $escuela = 0, $escuelas = null;
    public $servicios = null, $servicio = 0, $selectComedor = false;

    protected $rules = [
        'servicio' => 'required|gt:0',
        'escuela' => 'required|gt:0',
        'cantidad' => 'required|gt:0',
    ];

    public function mount()
    {
        $this->fecha = now()->format('Y-m');
        $this->escuelas = Escuela::find(User::escuelas_id(Auth::user()->id));
        $this->escuela = $this->escuelas->first()->id;
        $this->servicios = Servicio::query()->select('id', 'nombre')->orderBy('nombre', 'desc')->get();
        $this->servicio = $this->servicios->first()->id;
    }

    public function render()
    {
        $this->selectComedor = $this->servicio == 5; // 5: Comedor Universitario

        return view('livewire.bienestar.agregar-atencion-comedor');
    }

    public function guardar()
    {
        $this->validate();
        try {
            $atencion = BienestarAtencion::query()
                ->where('servicio_id', $this->servicio)
                ->where('mes', Carbon::createFromFormat('Y-m', $this->fecha)->month)
                ->where('anio', Carbon::createFromFormat('Y-m', $this->fecha)->year)
                ->where('escuela_id', $this->escuela)
                ->first();

            if (is_null($atencion)) {
                BienestarAtencion::create([
                    'servicio_id' => $this->servicio,
                    'mes' => Carbon::createFromFormat('Y-m', $this->fecha)->month,
                    'anio' => Carbon::createFromFormat('Y-m', $this->fecha)->year,
                    'atenciones' => $this->cantidad,
                    'total' => $this->servicio == 5 ? $this->total : null,
                    'escuela_id' => $this->escuela
                ]);
            } else {
                $atencion->atenciones = $this->cantidad;
                $atencion->total = $this->total;
                $atencion->save();
            }

            $this->reset('cantidad', 'total');

            $msg = 'El registro del servicio de Bienestar Universitario fue agregado correctamente';
            $this->emit('guardado', ['titulo' => 'Registro de servicio de Bienestar agregado', 'mensaje' => $msg]);
            $this->emitTo('bienestar.lista-atencion-comedor', "cargarDatos");
        } catch (\Exception $e) {
            $this->emit('error', "Hubo un error inesperado: \n" . $e);
        }
    }
}
