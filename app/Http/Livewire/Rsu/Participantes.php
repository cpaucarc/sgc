<?php

namespace App\Http\Livewire\Rsu;

use App\Models\Oge;
use App\Models\ResponsabilidadSocial;
use App\Models\RsuParticipante;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Participantes extends Component
{
    public $rsu_id;
    public $es_responsable;
    public $en_docentes = false; // Variable para saber en que API buscar, y que vista mostrar (Estudiantes, Docentes)

    public $open = false; // Abrir modal de datos del participante
    public $datos_participante = null;

    public $add = true; // Abrir modal para agregar participantes
    public $mensaje_estudiantes = null;
    public $dni = ""; // DNI ingresados al input

    public function mount($rsu_id, $es_responsable)
    {
        $this->rsu_id = $rsu_id;
        $this->es_responsable = $es_responsable;
    }

    public function render()
    {
        $rsu = ResponsabilidadSocial::query()
            ->select('id')
            ->withCount('participantes')
            ->with('participantes')
            ->where('id', $this->rsu_id)
            ->first();

        return view('livewire.rsu.participantes', compact('rsu'));
    }

    public function abrirModal()
    {
        $this->add = true;
    }

    public function mostrarDatos($dni)
    {
        $this->datos_participante = Oge::datos($dni);
        $this->open = true;
    }

    public function buscarEnDocentes($es_docente)
    {
        $this->en_docentes = $es_docente;
    }

    public function agregarEstudiantes()
    {
        try {
            if (strlen($this->dni) === 0) {
                $this->mensaje_estudiantes = "Ingrese al menos el DNI de un estudiante";
                $this->emit('error', "Ingrese al menos el DNI de un estudiante");
                return;
            }

            if (strlen($this->dni) < 8) {
                $this->mensaje_estudiantes = "Parece que el DNI ingresado tiene menos de 8 digitos";
                $this->emit('error', "Parece que el DNI ingresado tiene menos de 8 digitos");
                return;
            }

            $arrayDni = explode(",", $this->dni);
            $arrayDniIncorrectos = array();
            foreach ($arrayDni as $d) {
                if (!is_numeric($d)) {
                    $arrayDniIncorrectos[] = "♦ '" . $d . "' debería contener solo números.";
                    continue;
                }

                if (strlen($d) !== 8)
                    $arrayDniIncorrectos[] = "► '" . $d . "' debería contener 8 caracteres.";
            }

            if (count($arrayDniIncorrectos)) {
                $this->mensaje_estudiantes = implode("\r\n", $arrayDniIncorrectos);
                $this->emit('error', implode("\r\n", $arrayDniIncorrectos));
                return;
            }

            $arrayDniExistente = array(); // array de DNI que si existen en OGE
            $arrayDniInexistente = array(); // array de DNI que no se han encontrado
            foreach ($arrayDni as $d) {
                $response = Http::withToken(env('OGE_TOKEN'))
                    ->get(env('OGE_API') . 'ensenianza_aprendizaje/01?codigo=' . $d);
                $response = $response->json();

                if (isset($response['dni'])) {
                    $arrayDniExistente[] = [
                        'fecha_incorporacion' => now()->format('Y-m-d'),
                        'es_responsable' => false,
                        'es_estudiante' => true,
                        'dni_participante' => $d,
                        'responsabilidad_social_id' => $this->rsu_id
                    ];
                } else {
                    $arrayDniInexistente[] = "• No encontramos ningún estudiante con DNI " . $d . ", revise si está bien escrito.";
                }
            }

            // si hay elementos en $arrayDniExistente, guardar en BD
            if (count($arrayDniExistente)) {
                RsuParticipante::insert($arrayDniExistente);
                $this->emit('guardado', "Se añadieron correctamente " . count($arrayDniExistente) . " de " . count($arrayDni) . " nuevos participantes.");
                $this->mensaje_estudiantes = null;
            }

            // si hay elementos en $arrayDniInexistente, mostrar en el msg
            if (count($arrayDniInexistente)) {
                $this->mensaje_estudiantes = implode("\r\n", $arrayDniInexistente);
            }

            // si hay elementos en $arrayDniInexistente, mantener abierto modal

            // si no hay elementos en $arrayDniInexistente, cerrar modal
//            if (!count($arrayDniInexistente)) {
//                $this->add = false;
//            }
        } catch (\Exception $e) {
            $this->emit('error', "Hubo un error inesperado\n" . $e);
        }
    }
}
