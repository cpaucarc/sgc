<?php

namespace App\Http\Livewire\Docente;

use App\Lib\UsuarioHelper;
use App\Models\Departamento;
use App\Models\Docente;
use App\Models\DocenteSemestre;
use App\Models\Persona;
use App\Models\Semestre;
use Livewire\Component;

class ListaDocenteSemestre extends Component
{

    public $depto;
    public $semestres = null;
    public $semestre, $semestre_activo;
    public $search = "";

    protected $listeners = ['agregarDocente', 'quitarDocente'];

    public function mount()
    {
        $this->semestres = Semestre::query()->orderBy('nombre', 'desc')->get();
        $this->semestre = $this->semestres->where('activo', true)->first()->id;
        $this->semestre_activo = $this->semestre;

        // TODO: reemplazar por deptosDelUsuario() [si no existe, crearlo]
        $this->depto = Departamento::query()
            ->with('facultad')
            ->where('id', UsuarioHelper::escuelasDelUsuario()->pluck('depto_id')[0])
            ->first();
    }

    public function render()
    {
        $docentes = Docente::query()
            ->addSelect(['cumple_40h' => DocenteSemestre::select('cumple_40h')
                ->whereColumn('docente_id', 'docentes.id')
                ->where('semestre_id', $this->semestre)
                ->take(1)
            ])
            ->with('persona', 'categoria', 'condicion', 'dedicacion')
            ->whereHas('persona', function ($query) {
                $query->where('apellido_paterno', 'like', '%' . $this->search . '%')
                    ->orWhere('apellido_materno', 'like', '%' . $this->search . '%')
                    ->orWhere('nombres', 'like', '%' . $this->search . '%');
            })
            ->where('departamento_id', $this->depto->id)
            ->orderBy(Persona::select('apellido_paterno')->whereColumn('personas.id', 'docentes.persona_id'))
            ->orderBy(Persona::select('apellido_materno')->whereColumn('personas.id', 'docentes.persona_id'))
            ->get();

        return view('livewire.docente.lista-docente-semestre', compact('docentes'));
    }

    public function agregarDocente($docente_id, $cumple_40h)
    {
        try {
            DocenteSemestre::create([
                'cumple_40h' => $cumple_40h,
                'docente_id' => $docente_id,
                'semestre_id' => $this->semestre,
                'departamento_id' => $this->depto->id,
            ]);
            $msg = $cumple_40h ? 'El docente fue agregado y cumple con el formato de 40h' :
                'El docente fue agregado pero no cumple con el formato de 40h';
            $this->emit('guardado', ['titulo' => 'Docente agregado', 'mensaje' => $msg]);
        } catch (\Exception $e) {
            $this->emit('error', "Hubo un error inesperado: \n" . $e);
        }
    }


    public function quitarDocente($docente_id)
    {
        try {
            $ds = DocenteSemestre::query()
                ->where('docente_id', $docente_id)
                ->where('semestre_id', $this->semestre)
                ->where('departamento_id', $this->depto->id)
                ->first();

            $ds->delete();

            $this->emit('guardado', ['titulo' => 'Docente quitado', 'mensaje' => 'El docente fue quitado de la lista de los docentes que dictan en este semestre']);
        } catch (\Exception $e) {
            $this->emit('error', "Hubo un error inesperado: \n" . $e);
        }
    }
}
