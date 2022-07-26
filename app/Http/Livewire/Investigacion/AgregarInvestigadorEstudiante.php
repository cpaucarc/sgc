<?php

namespace App\Http\Livewire\Investigacion;

use App\Models\Investigacion;
use App\Models\InvestigacionInvestigador;
use App\Models\Investigador;
use App\Models\ResponsabilidadSocial;
use App\Models\RsuParticipante;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class AgregarInvestigadorEstudiante extends Component
{
    public $investigacion_id;
    public $mensaje_estudiantes = null;
    public $dni = ""; // DNI de estudiantes ingresados al input
    public $dni_usados; // DNI de los estudiantes que ya estan registrados como investigadores

    public function mount($investigacion_id)
    {
        $this->investigacion_id = $investigacion_id;
        $investigaciones = Investigacion::query()
            ->select('id')
            ->with(['investigadores' => function ($query) {
                $query->where('es_docente', false);
            }])
            ->where('id', $this->investigacion_id)
            ->first();
        $this->dni_usados = $investigaciones->investigadores->pluck('dni_investigador')->toArray();
    }

    public function render()
    {
        return view('livewire.investigacion.agregar-investigador-estudiante');
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
            $arrayDni = array_unique($arrayDni);

            $arrayDniIncorrectos = array();
            foreach ($arrayDni as $d) {
                if (!is_numeric($d)) {
                    $arrayDniIncorrectos[] = "♦ '" . $d . "' debería contener solo números.";
                    continue;
                }

                if (strlen($d) !== 8)
                    $arrayDniIncorrectos[] = "► '" . $d . "' debería contener 8 caracteres.";

                if (in_array($d, $this->dni_usados))
                    $arrayDniIncorrectos[] = "▼ '" . $d . "' ya está registrado como investigador.";
            }

            if (count($arrayDniIncorrectos)) {
                $this->mensaje_estudiantes = implode("\r\n", $arrayDniIncorrectos);
                $this->emit('error', implode("\r\n", $arrayDniIncorrectos));
                return;
            }

            $arrayDniExistente = array(); // array de DNI que si existen en OGE
            $arrayDniInexistente = array(); // array de DNI que no se han encontrado
            $array_aux = $arrayDni;
            foreach ($array_aux as $id => $d) {
                $response = Http::withToken(env('OGE_TOKEN'))
                    ->get(env('OGE_API') . 'ensenianza_aprendizaje/01?codigo=' . $d);
                $response = $response->json();

                if (isset($response['dni'])) {

                    $investigador = Investigador::query()->where('dni_investigador', $d)->first();

                    if (is_null($investigador))
                        $investigador = Investigador::create(['es_docente' => false, 'dni_investigador' => $d]);

                    $arrayDniExistente[] = [
                        'es_responsable' => false,
                        'investigador_id' => $investigador->id,
                        'investigacion_id' => $this->investigacion_id
                    ];
                    $this->dni_usados[] = $d;
                    unset($array_aux[$id]);
                } else {
                    $arrayDniInexistente[] = "• No encontramos ningún estudiante con DNI " . $d . ", revise si está bien escrito.";
                }
            }

            // si hay elementos en $arrayDniExistente, guardar en BD
            if (count($arrayDniExistente)) {
                InvestigacionInvestigador::insert($arrayDniExistente);
                $this->emit('guardado', "Se añadieron correctamente " . count($arrayDniExistente) . " de " . count($arrayDni) . " nuevos investigadores.");
                $this->emitTo("investigacion.lista-investigacion-participantes", "render");
                $this->emitTo("investigacion.lista-investigacion-participantes", "cerrarModal");
                $this->dni = implode(',', $array_aux);
                $this->mensaje_estudiantes = null;
            }

            // si hay elementos en $arrayDniInexistente, mostrar en el msg
            if (count($arrayDniInexistente)) {
                $this->mensaje_estudiantes = implode("\r\n", $arrayDniInexistente);
            }
        } catch (\Exception $e) {
            $this->emit('error', "Hubo un error inesperado\n" . $e);
        }
    }
}
