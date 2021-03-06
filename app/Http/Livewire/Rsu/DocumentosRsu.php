<?php

namespace App\Http\Livewire\Rsu;

use App\Models\Documento;
use App\Models\DocumentoEnviado;
use App\Models\ResponsabilidadSocial;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class DocumentosRsu extends Component
{
    use WithFileUploads;

    public $rsu_id;
    public $es_responsable;
    public $open = false;

    public $archivo;

    public $listeners = ['render', 'eliminarArchivo'];

    protected $rules = [
        'archivo' => 'required'
    ];

    public function mount($rsu_id, $es_responsable)
    {
        $this->rsu_id = $rsu_id;
        $this->es_responsable = $es_responsable;
    }

    public function render()
    {
        $rsu = ResponsabilidadSocial::query()
            ->select('id')
            ->withCount('documentos')
            ->with('documentos')
            ->where('id', $this->rsu_id)
            ->first();

        return view('livewire.rsu.documentos-rsu', compact('rsu'));
    }

    /* Funciones */
    public function openModal()
    {
        $this->open = true;
    }

    public function enviarArchivo()
    {
        $this->validate();
        $rutaCarpeta = 'public/';

        //verificar si existe la carpeta storage/app/public/rsu, crear si no existe
        if (!Storage::exists($rutaCarpeta)) {
            Storage::makeDirectory($rutaCarpeta);
        }

        //copiar archivo a la carpeta storage/app/public/entradas
        $extensionArchivo = $this->archivo->getClientOriginalExtension();
        $nombreArchivo = $this->archivo->getClientOriginalName();
        $nuevo_nombre = 'rsu-' . Str::uuid() . '.' . $extensionArchivo;
        
        $this->archivo->storeAs($rutaCarpeta, $nuevo_nombre);

        $rsu = ResponsabilidadSocial::find($this->rsu_id);
        $entidad = Auth::user()->entidades()->first();

        $documento = Documento::create([
            'nombre' => $nombreArchivo,
            'enlace_interno' => $nuevo_nombre,
            'entidad_id' => $entidad->id,
            'semestre_id' => $rsu->semestre_id,
            'user_id' => Auth::user()->id,
        ]);

        //Guardar en la relacion polimorfica
        $documento_enviado = new DocumentoEnviado(['documento_id' => $documento->id]);
        $rsu->documentos()->save($documento_enviado);

        $this->open = false;
        $this->emit('guardado', "El documento '$nombreArchivo' fue enviado.");
    }

    public function eliminarArchivo($doc_id)
    {
        DocumentoEnviado::where('documento_id', $doc_id)->delete();

        $documento = Documento::find($doc_id);

        Storage::disk('public')->delete($documento->enlace_interno);
        $documento->delete();

        $this->open = false;
        $this->emit('guardado', "El documento fue eliminado.");
    }

}
