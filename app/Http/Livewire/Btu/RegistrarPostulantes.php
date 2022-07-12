<?php

namespace App\Http\Livewire\Btu;

use App\Models\BolsaPostulante;
use App\Models\Entidadable;
use App\Models\Escuela;
use App\Models\Facultad;
use App\Models\Semestre;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RegistrarPostulantes extends Component
{
    public $escuelas_id = [], $facultades_id = [];
    public $facultades = null, $facultad = 0;
    public $escuelas = null, $escuela = 0;
    public $semestres = null, $semestre = 0;
    public $inicio, $fin, $postulantes, $beneficiados;

    protected $rules = [
        'escuela' => 'required|gt:0',
        'semestre' => 'required|gt:0',
        'inicio' => 'required|date|before:fin',
        'fin' => 'required|date|after:inicio',
        'postulantes' => 'required|integer',
        'beneficiados' => 'required|integer',
    ];

    public function mount()
    {
        $this->facultades_id = User::facultades_id(Auth::user()->id);
        $this->escuelas_id = User::escuelas_id(Auth::user()->id);

        if (count($this->escuelas_id) > 0) {
            $this->escuelas = Escuela::query()->orderBy('nombre')
                ->whereIn('id', $this->escuelas_id)->get();
            $this->escuela = $this->escuelas->first()->id;
        } elseif (count($this->facultades_id) > 0) {
            $this->facultades = Facultad::query()->orderBy('nombre')
                ->whereIn('id', $this->facultades_id)->get();
            $this->facultad = $this->facultades->first()->id;

            $this->escuelas = Escuela::query()->orderBy('nombre')
                ->where('facultad_id', $this->facultad)->get();
            $this->escuela = $this->escuelas->first()->id;
        } else {
            abort(403, 'No tienes los permisos para estar en esta página');
        }

        $this->updatedEscuela($this->escuela);

        $this->semestres = Semestre::orderBy('nombre', 'desc')->get();
        $this->semestre = $this->semestres->where('activo', true)->first()->id;

        $this->inicio = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->fin = Carbon::now()->endOfMonth()->format('Y-m-d');
    }

    public function registrar()
    {
        $this->validate();
        try {
            $postulantes = BolsaPostulante::query()
                ->where('escuela_id', $this->escuela)
                ->whereBetween('fecha_inicio', [$this->inicio, $this->fin])
                ->whereBetween('fecha_fin', [$this->inicio, $this->fin])
                ->get();

            if (count($postulantes) < 1) {
                BolsaPostulante::create([
                    'fecha_inicio' => $this->inicio,
                    'fecha_fin' => $this->fin,
                    'postulantes' => $this->postulantes,
                    'beneficiados' => $this->beneficiados,
                    'semestre_id' => $this->semestre,
                    'escuela_id' => $this->escuela
                ]);
                $this->reset(['inicio', 'fin', 'postulantes', 'beneficiados']);

                $msg = 'La información de Bolsa de Trabajo se registró correctamente.';
                $this->emit('guardado', ['titulo' => 'Bolsa de Trabajo agregado', 'mensaje' => $msg]);
                return redirect()->route('btu.index');

            } else {
                $this->emit('error', 'Ya se registraron los datos de Bolsa de Trabajo en las fechas ingresadas.');
            }
        } catch (\Exception $e) {
            $this->emit('error', "Hubo un error inesperado: \n" . $e);
        }
    }

    public function updatedEscuela($value)
    {
        if ($value > 0) {
            $this->ultimo_registro = BolsaPostulante::query()
                ->where('escuela_id', $this->escuela)
                ->orderBy('id', 'desc')
                ->first();
        } else {
            $this->ultimo_registro = null;
        }
    }

    public function render()
    {
        return view('livewire.btu.registrar-postulantes');
    }
}
