<?php

namespace App\Http\Livewire\Actividad;

use App\Models\Cliente;
use App\Models\Documento;
use App\Models\DocumentoEnviado;
use App\Models\Responsable;
use App\Models\ResponsableSalida;
use App\Models\Salida;
use Database\Seeders\SalidaSeeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class ActividadSalidas extends Component
{
    use WithFileUploads;

    public $responsable_id, $semestre_id;
    public $open = false;

    public $resp_salida_seleccionado = null;
    public $archivo;

    protected $rules = [
        'archivo' => 'required',
    ];

    public function mount($responsable_id, $semestre_id)
    {
        $this->responsable_id = $responsable_id;
        $this->semestre_id = $semestre_id;
    }

    public function render()
    {
        $responsable_salidas = ResponsableSalida::query()->with('salida')
            ->where('responsable_id', $this->responsable_id)->get();
        return view('livewire.actividad.actividad-salidas', compact('responsable_salidas'));
    }

    /* Funciones */
    public function abrirModal($responsable_salida_id)
    {
        $this->open = true;

        $this->resp_salida_seleccionado = ResponsableSalida::query()
            ->with('salida', 'clientes')
            ->with(['documentos' => function ($query) {
                $query->whereIn('documento_id', function ($query2) {
                    $query2->select('id')->from('documentos')->where('semestre_id', $this->semestre_id);
                });
            }])
            ->where('id', $responsable_salida_id)
            ->first();
    }

    public function enviarArchivo()
    {
        $this->validate();
        $rutaCarpeta = 'public/';

        //verificar si existe la carpeta storage/app/public/salidas, crear si no existe
        if (!Storage::exists($rutaCarpeta)) {
            Storage::makeDirectory($rutaCarpeta);
        }

        //copiar archivo a la carpeta storage/app/public/salidas
        $extensionArchivo = $this->archivo->getClientOriginalExtension();
        $nombreArchivo = $this->archivo->getClientOriginalName();
        $nuevo_nombre = 'salida-' . Str::uuid() . '.' . $extensionArchivo;

        $this->archivo->storeAs($rutaCarpeta, $nuevo_nombre);

        $documento = Documento::create([
            'nombre' => $nombreArchivo,
            'enlace_interno' => $nuevo_nombre,
            'entidad_id' => Responsable::query()->where('id', $this->responsable_id)->first()->entidad_id,
            'semestre_id' => $this->semestre_id,
            'user_id' => Auth::user()->id,
        ]);

        //Guardar en la relacion polimorfica
        $documento_enviado = new DocumentoEnviado(['documento_id' => $documento->id]);
        $this->resp_salida_seleccionado->documentos()->save($documento_enviado);

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
