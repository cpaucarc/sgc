<?php

namespace App\Http\Livewire\Auditoria;

use App\Models\Auditoria;
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
    public $facultad = 0, $facultades = null;
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
    }

    public function render()
    {
        return view('livewire.auditoria.registrar-auditoria');
    }

    public function guardarAuditoria()
    {
        $this->validate();

        try {
            $rutaCarpeta = '/public/auditoria';
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

                $archivo->storeAs($rutaCarpeta, $archivo->getClientOriginalName());

                $documento = Documento::create([
                    'nombre' => $archivo->getClientOriginalName(),
                    'enlace_interno' => 'auditoria' . '/' . $archivo->getClientOriginalName(),
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

            return redirect()->route('auditoria.index');

        } catch (\Exception $e) {
            $this->emit('error', 'Hubo un problema:\\n' . $e);
            return;
        }
    }
}
