<?php

namespace App\Http\Livewire\Actividad;

use App\Models\Cliente;
use App\Models\Documento;
use App\Models\DocumentoEnviado;
use App\Models\Responsable;
use App\Models\Salida;
use Database\Seeders\SalidaSeeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ActividadSalidas extends Component
{
    use WithFileUploads;

    public $responsable;
    public $semestre_id;
    public $open = false;

    public $salida_seleccionado = null;
    public $clientes;
    public $documentos;

    public $archivo;

    protected $rules = [
        'archivo' => 'required',
    ];

    public function mount($responsable_id, $semestre_id)
    {
        $this->responsable = Responsable::find($responsable_id);
        $this->semestre_id = $semestre_id;
    }

    public function render()
    {
        $salidas = Salida::query()
            ->whereIn('id', function ($query) {
                $query->select('salida_id')->from('clientes')
                    ->where('responsable_id', $this->responsable->id);
            })
            ->get();

        return view('livewire.actividad.actividad-salidas', compact('salidas'));
    }

    /* Funciones */
    public function abrirModal($salida_id)
    {
        $this->open = true;

        $this->salida_seleccionado = Salida::query()
            ->where('id', $salida_id)
            ->first();

        $this->documentos = DocumentoEnviado::query()
            ->with('documento')
            ->where('documentable_id', $salida_id)
            ->where('documentable_type', "App\\Models\\Salida")
            ->whereHas('documento', function ($query) {
                $query->where('user_id', Auth::user()->id)
                    ->where('entidad_id', $this->responsable->entidad_id);
            })
            ->get();

        $this->clientes = Cliente::query()
            ->with('entidad')
            ->where('salida_id', $salida_id)
            ->where('responsable_id', $this->responsable->id)
            ->get()
            ->pluck('entidad.nombre');
    }

    public function enviarArchivo()
    {
        $this->validate();
        $rutaCarpeta = '/public/salidas';

        //verificar si existe la carpeta storage/app/public/salidas, crear si no existe
        if (!Storage::exists($rutaCarpeta)) {
            Storage::makeDirectory($rutaCarpeta);
        }

        //copiar archivo a la carpeta storage/app/public/salidas
        $nombreArchivo = $this->archivo->getClientOriginalName();
        if (!$nombreArchivo) {
            $nombreArchivo = "Archivo adjunto";
        }

        $existe = Storage::disk('public')->exists('salidas/' . $nombreArchivo);
        $num = 0;
        if ($existe) {
            $aux = $nombreArchivo;
            while ($existe) {
                $num++;
                $aux = $num . '_' . $aux;
                $existe = Storage::disk('public')->exists('salidas/' . $aux);
                $aux = $nombreArchivo;
            }
            $nombreArchivo = $num . '_' . $nombreArchivo;
        }

        $this->archivo->storeAs($rutaCarpeta, $nombreArchivo);

        $documento = Documento::create([
            'nombre' => $nombreArchivo,
            'enlace_interno' => 'salidas' . '/' . $nombreArchivo,
            'entidad_id' => $this->responsable->entidad_id,
            'semestre_id' => $this->semestre_id,
            'user_id' => Auth::user()->id,
        ]);

        //Guardar en la relacion polimorfica
        $documento_enviado = new DocumentoEnviado(['documento_id' => $documento->id]);
        $this->salida_seleccionado->documentos()->save($documento_enviado);

        $this->open = false;
        $this->emit('guardado', "El documento '$nombreArchivo' fue guardado.");
    }

    public function eliminarArchivo($doc_id)
    {
        $documento_enviado = DocumentoEnviado::where('documento_id', $doc_id);
        $documento_enviado->delete();

        $documento = Documento::find($doc_id);

        Storage::disk('public')->delete($documento->enlace_interno);
        $documento->delete();

        $this->open = false;
        $this->emit('guardado', "El documento fue eliminado.");
    }
}
