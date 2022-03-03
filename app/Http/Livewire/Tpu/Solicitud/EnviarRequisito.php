<?php

namespace App\Http\Livewire\Tpu\Solicitud;

use App\Models\Documento;
use App\Models\DocumentoSolicitud;
use App\Models\Semestre;
use App\Models\Solicitud;
use App\Models\Tesis;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EnviarRequisito extends Component
{
    use WithFileUploads;

    public $open = false;
    public $requisitos = null;
    public $archivo = null;
    public $requisitoSeleccionado = 0;
    public $solicitud = null;
    public $entidad = null;
    public $semestreActual = null;
    public $documentos = null;

    public $goAddTesis = false;

    public $randomID = 0;

    public $tesis = null;

    protected $rules = [
        'archivo' => 'required',
        'requisitoSeleccionado' => 'required|gt:0'
    ];

    public function mount()
    {
        $this->solicitud = Solicitud::query()
            ->where('codigo_estudiante', Auth::user()->codigo)
            ->first();

        $this->semestreActual = Semestre::query()
            ->where('fecha_fin', '>=', Carbon::now())
            ->where('fecha_inicio', '<=', Carbon::now())
            ->first();

        $this->entidad = Auth::user()->entidades()->first();
    }

    public function requisitosFaltantes()
    {
        $this->requisitos = DB::table('requisitos')
            ->select('id', 'nombre')
            ->where('proceso_id', 5)  // 5 : Título profesional
            ->whereNotIn('id', function ($query) {
                $query->select('requisito_id')
                    ->from('documento_solicitud')
                    ->whereIn('solicitud_id', function ($query2) {
                        $query2->select('id')
                            ->from('solicitudes')
                            ->where('codigo_estudiante', Auth::user()->codigo);
                    });
            })
            ->get();

        if ($this->requisitoSeleccionado == 14) { // 14 : proyecto de investifación.
            $this->goAddTesis = true;
        } else {
            $this->goAddTesis = false;
        }
    }

    public function guardarDocumento()
    {
        $this->validate();
        $this->randomID = rand();

        //Si no hay solicitud, se crea (estado 4: En evaluacion)
        if (is_null($this->solicitud)) {
            $this->solicitud = Solicitud::create([
                'codigo_estudiante' => (Auth::user()->codigo),
                'tipo_solicitud_id' => 3, // 3: Título profesional
                'estado_id' => 4,// 4: En evaluación (Categoria => 2:solicitud)
            ]);
            $this->emit('solicitudCreado');
        }

        /*Guardar en Documentos*/

        //sgc-fcm\storage\app\public\solicitud\tpu\documento.pdf
        $rutaCarpeta = '/public/solicitud/tpu';

        //verificar si existe la carpeta storage/app/public/solicitud/tpu, crear si no existe
        if (!Storage::exists($rutaCarpeta)) {
            Storage::makeDirectory($rutaCarpeta);
        }

        //Actualizar nombre del archivo a único
        $archivoRecibido = $this->archivo->getClientOriginalName();
        $archivoRecibidoNombre = pathinfo($archivoRecibido, PATHINFO_FILENAME);
        $archivoRecibidoExt = pathinfo($archivoRecibido, PATHINFO_EXTENSION);
        $nombreFinal = $archivoRecibidoNombre . '_' . now()->format('Ymdhis') . '.' . $archivoRecibidoExt;
        $this->archivo->storeAs($rutaCarpeta, $nombreFinal);

        //Almacenar ruta del archivo
        $documento = Documento::create([
            'nombre' => $nombreFinal,
            'enlace_interno' => 'solicitud/tpu/' . $nombreFinal,
            'entidad_id' => $this->entidad->id,
            'semestre_id' => $this->semestreActual->id,
            'user_id' => Auth::user()->id,
        ]);

        //Guardar en documento_solicitud
        DocumentoSolicitud::create([
            'requisito_id' => $this->requisitoSeleccionado,
            'documento_id' => $documento->id,
            'solicitud_id' => $this->solicitud->id,
            'estado_id' => 4, // 4: En evaluación (Categoria: 2:solicitud)
        ]);

        $this->randomID = 0;
        $this->reset(['archivo', 'requisitos', 'requisitoSeleccionado']);
        $this->open = false;

        $this->emit('requisitoGuardado');
        $this->emit('guardado', 'El requisito se envió correctamente.');
    }

    /*public function documentosEnviados()
    {
        $this->documentos = DocumentoSolicitud::query()
            ->with('documento')
            ->whereHas('solicitud', function ($query) {
                $query->where('codigo_estudiante', Auth::user()->codigo);
            })
            ->whereHas('documento', function ($query) {
                $query->where('user_id', Auth::user()->id)
                    ->where('entidad_id', $this->entidad->id)
                    ->where('semestre_id', $this->semestreActual->id);
            })
            ->get();
    }*/

    public function tesisRegistrado()
    {
        $this->tesis = Tesis::query()
            ->where('codigo_estudiante', Auth::user()->codigo)
            ->orderBy('id', 'desc')
            ->first();
    }

    public function render()
    {
        $this->requisitosFaltantes();
        $this->tesisRegistrado();
//        $this->documentosEnviados();
        return view('livewire.tpu.solicitud.enviar-requisito');
    }
}