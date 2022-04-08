<?php

namespace App\Http\Livewire\Bachiller\Solicitud;

use App\Models\Documento;
use App\Models\DocumentoSolicitud;
use App\Models\Solicitud;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class RequisitosEnviados extends Component
{
    use WithFileUploads;

    public $solicitud = null;
    public $modal = false;
    public $requisito_id = null;
    public $archivo = null;

    protected $listeners = [
        'requisitoGuardado' => 'render'
    ];


    public function render()
    {
        $this->solicitud = Solicitud::query()
            ->with('documentos')
            ->where('tipo_solicitud_id', 1) // 3 : Bachiller
            ->where('codigo_estudiante', Auth::user()->codigo)
            ->first();
        return view('livewire.bachiller.solicitud.requisitos-enviados');
    }

    public function seleccionar($estado, $requisito)
    {
        $this->modal = $estado;
        $this->requisito_id = $requisito;
    }

    protected $rules = [
        'archivo' => 'required',
    ];

    public function actualizarDocumento()
    {
        $this->validate();

        $documentoSolicitud = DocumentoSolicitud::query()
            ->where('requisito_id', $this->requisito_id)
            ->where('solicitud_id', $this->solicitud->id)
            ->first();

        if ($documentoSolicitud) {
            $documento = Documento::query()->where('id', $documentoSolicitud->documento_id)->first();

            if ($documento) {
                $url = str_replace('solicitud', 'public/solicitud', $documento->enlace_interno);
                Storage::delete($url);
                /*Guardar en Documentos*/
                $rutaCarpeta = '/public/solicitud/bachiller';

                //verificar si existe la carpeta storage/app/public/solicitud/bachiller, crear si no existe
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
                $documento->update([
                    'nombre' => $nombreFinal,
                    'enlace_interno' => 'solicitud/bachiller/' . $nombreFinal,
                ]);

                //Guardar en documento_solicitud
                $documentoSolicitud->update([
                    'requisito_id' => $this->requisito_id,
                    'documento_id' => $documento->id,
                    'solicitud_id' => $this->solicitud->id,
                    'estado_id' => 4, // 4: En evaluación (Categoria: 2:solicitud)
                ]);


                $this->reset(['archivo', 'requisito_id']);
                $this->modal = false;

                $this->emit('requisitoGuardado');

                $this->emit('guardado', 'El requisito se envió correctamente.');
            }

        }
    }
}
