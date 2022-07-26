<?php

namespace App\Http\Livewire\Docente;

use App\Lib\UsuarioHelper;
use App\Models\Departamento;
use App\Models\Docente;
use App\Models\Oge;
use App\Models\Persona;
use App\Models\Semestre;
use Livewire\Component;

class ListaDocentesDepto extends Component
{
    public $open = false;
    public $search = "";

    public $docentes_seleccionados = []; // array con el DNI de los docentes
    public $dnis_usados = [];
    public $docentesAPI = null;

    public $semestre_actual = null;
    public $depto = null;

    public $categorias = [
        "AUXILIAR" => 1,
        "ASOCIADO" => 2,
        "PRINCIPAL" => 3,
        "DC A1" => 4,
        "DC A2" => 5,
        "DC B1" => 6,
        "DC B2" => 7,
        "JEFE DE PRACTICAS" => 8,
        "SERVICIO ACADEMICO PROFESIONAL" => 9
    ]; // Son los mismos datos de la DB
    public $condicion = [
        "CONTRATADO" => 1,
        "NOMBRADO" => 2
    ]; // serán usados para obtener su ID, por el nombre de c/accion
    public $dedicacion = [
        "TIEMPO COMPLETO" => 1,
        "TIEMPO PARCIAL" => 2,
        "DEDICACION EXCLUSIVA" => 3,
    ]; // y permitirá reducir la carga de consultas.

    public function mount()
    {
        $this->semestre_actual = Semestre::query()->where('activo', true)->first()->nombre;
        // TODO: reemplazar por deptosDelUsuario() [si no existe, crearlo]
        $this->depto = Departamento::query()
            ->with('facultad')
            ->where('id', UsuarioHelper::escuelasDelUsuario()->pluck('depto_id')[0])
            ->first();
    }

    public function render()
    {
        $docentes = Docente::query()
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

        if (!count($this->dnis_usados)) {
            foreach ($docentes as $dc) {
                $this->dnis_usados[] = $dc->persona->dni;
            }
        }

        return view('livewire.docente.lista-docentes-depto', compact('docentes'));
    }

    public function abrirModal()
    {
        $docentesOGE = Oge::listaDocentes($this->depto->id, $this->semestre_actual);

        $docentes_filtrados = [];
        foreach ($docentesOGE as $dct) {
            if (strlen(trim($dct['dni'])) !== 8)
                continue;
            if (in_array($dct['dni'], $this->dnis_usados))
                continue;
            $docentes_filtrados[] = $dct;
        }
        $this->docentesAPI = $docentes_filtrados;
        $this->open = true;
    }

    public function guardarDocentes()
    {
        $docentes = [];
        foreach ($this->docentesAPI as $dcte) {
            if (!in_array($dcte['dni'], $this->docentes_seleccionados))
                continue;

            $persona = Persona::create([
                'apellido_paterno' => $dcte['apellido_paterno'],
                'apellido_materno' => $dcte['apellido_materno'],
                'nombres' => $dcte['nombres'],
                'dni' => $dcte['dni'],
                'correo' => strlen(trim($dcte['correo_institucional'])) > 0 ? $dcte['correo_institucional'] : null,
                'celular' => strlen(trim($dcte['celular'])) > 0 ? $dcte['celular'] : null,
            ]);

            $docentes[] = [
                'grado' => $dcte['grado'],
                'persona_id' => $persona->id,
                'departamento_id' => $this->depto->id,
                'categoria_id' => $this->categorias[$dcte['categoria']],
                'condicion_id' => $this->condicion[$dcte['condicion']],
                'dedicacion_id' => $this->dedicacion[$dcte['dedicacion']],
            ];

            $this->dnis_usados[] = $dcte['dni'];
        }
        Docente::insert($docentes);
        $this->reset('open', 'docentes_seleccionados', 'docentesAPI');
    }
}
