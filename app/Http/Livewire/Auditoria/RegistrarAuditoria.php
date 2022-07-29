<?php

namespace App\Http\Livewire\Auditoria;

use App\Models\Auditoria;
use App\Models\AuditoriaInterna;
use App\Models\Documento;
use App\Models\DocumentoEnviado;
use App\Models\Entidadable;
use App\Models\Facultad;
use App\Models\Semestre;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class RegistrarAuditoria extends Component
{
    use WithFileUploads;

    public $responsable = null, $archivos = [];
    public $tipo = 1; // 1:interno, 0:externo
    public $facultad_id = [];
    public $facultad = 0, $facultades = null, $uuid = null, $semestre_activo = null;
    public $mensaje = null;

    protected $rules = [
        'tipo' => 'required:between:0,1',
        'responsable' => 'required|string|max:250',
        'facultad' => 'required|gt:0',
        'archivos' => 'required|array|min:1|max:5'
    ];

    public function mount()
    {
        $this->facultad_id = User::facultades_id(Auth::user()->id);
        $this->facultades = Facultad::query()->findOrFail($this->facultad_id);
        $this->facultad = count($this->facultades) ? $this->facultades->first()->id : 0;
        $this->uuid = count($this->facultades) ? explode('-', $this->facultades->first()->uuid)[0] : null;
        $this->semestre_activo = Semestre::query()->where('activo', true)->first()->id;
    }

    public function render()
    {
        $auditoria_interna = $this->tipo == 1 ? AuditoriaInterna::query()
            ->where('semestre_id', $this->semestre_activo)->where('facultad_id', $this->facultad)->first() : null;

        return view('livewire.auditoria.registrar-auditoria', compact('auditoria_interna'));
    }

    public function guardarAuditoria()
    {
        $this->validate();
        try {
            $rutaCarpeta = 'public/';

            if (!Storage::exists($rutaCarpeta))
                Storage::makeDirectory($rutaCarpeta);

            $auditoria = Auditoria::create([
                'uuid' => Str::uuid(),
                'responsable' => $this->responsable,
                'es_auditoria_interno' => $this->tipo,
                'facultad_id' => $this->facultad,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            $documento_ids = [];

            $entidad_id = Auth::user()->entidades()->first()->id;
            $user_id = Auth::user()->id;
            $semestre_id = Semestre::where('activo', true)->first()->id;

            foreach ($this->archivos as $archivo) {

                $extensionArchivo = $archivo->getClientOriginalExtension();
                $nombreArchivo = $archivo->getClientOriginalName();
                $nuevo_nombre = 'auditoria-' . Str::uuid() . '.' . $extensionArchivo;

                $archivo->storeAs($rutaCarpeta, $nuevo_nombre);

                $documento = Documento::create([
                    'nombre' => $nombreArchivo,
                    'enlace_interno' => $nuevo_nombre,
                    'entidad_id' => $entidad_id,
                    'semestre_id' => $semestre_id,
                    'user_id' => $user_id,
                ]);

                $documento_ids[] = $documento->id;
            }

            //Guardar en la relacion polimorfica
            foreach ($documento_ids as $documento_id) {
                $documento_enviado = new DocumentoEnviado(['documento_id' => $documento_id]);
                $auditoria->documentos()->save($documento_enviado);
            }

            $msg = 'La información de Auditoria se registró correctamente.';
            $this->emit('guardado', ['titulo' => 'Auditoria agregado', 'mensaje' => $msg]);
            return redirect()->route('auditoria.index');

        } catch (\Exception $e) {
            $this->emit('error', 'Hubo un problema:\\n' . $e);
            return;
        }
    }

    public function updatedFacultad($fac_id)
    {
        $this->uuid = explode('-', $this->facultades->where('id', $fac_id)->first()->uuid)[0];
    }
}
