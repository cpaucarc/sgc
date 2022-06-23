<?php

namespace App\Http\Livewire\Actividad;

use App\Models\Documento;
use App\Models\DocumentoEnviado;
use App\Models\Proceso;
use App\Models\Proveedor;
use App\Models\Semestre;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ListaActividadProveedor extends Component
{
    use WithFileUploads;

    public $semestres = null;
    public $semestre_seleccionado = null;
    public $entidades = [];
    public $procesos = null;
    public $proceso_seleccionado = null;

    public $proveedor_seleccionado = null;
    public $documentos;
    public $archivo;
    public $open = false;

    protected $rules = [
        'archivo' => 'required',
    ];

    public function mount()
    {
        $this->semestres = Semestre::orderBy('nombre', 'desc')->get();
        $this->semestre_seleccionado = $this->semestres->where('activo', 1)->first()->id;

        $this->entidades = Auth::user()->entidades->pluck('id');

        $this->procesos = Proceso::query()
            ->whereIn('id', function ($query) {
                $query->select('proceso_id')->from('actividades')
                    ->whereIn('id', function ($query2) {
                        $query2->select('actividad_id')->from('responsables')
                            ->whereIn('id', function ($query3) {
                                $query3->select('responsable_id')->from('proveedores')
                                    ->whereIn('id', $this->entidades);
                            });
                    });
            })
            ->orderBy('nombre')->get();
        $this->proceso_seleccionado = $this->procesos->first()->id;
    }

    public function render()
    {
        $proveer = Proveedor::query()
            ->addSelect(['cantidad' => Documento::select(DB::raw('count(1)'))
                ->whereColumn('entidad_id', 'entidad_id')
                ->where('semestre_id', $this->semestre_seleccionado)
                ->where('user_id', Auth::user()->id)
                ->whereIn('id', function ($query) {
                    $query->select('documento_id')->from('documento_enviado')
                        ->whereColumn('documentable_id', 'entrada_id')
                        ->where('documentable_type', "App\\Models\\Entrada");
                })
                ->limit(1)
            ])
            ->with('responsable', 'responsable.actividad', 'entrada')
            ->whereIn('entidad_id', $this->entidades)
            ->get();

        return view('livewire.actividad.lista-actividad-proveedor', compact('proveer'));
    }

    /* Funciones */
    public function abrirModal($proveedor_id)
    {
        $this->proveedor_seleccionado = Proveedor::query()
            ->with('entrada', 'responsable', 'responsable.actividad')
            ->where('id', $proveedor_id)
            ->first();

        $this->documentos = DocumentoEnviado::query()
            ->with('documento')
            ->where('documentable_id', $this->proveedor_seleccionado->entrada_id)
            ->where('documentable_type', "App\\Models\\Entrada")
            ->whereHas('documento', function ($query) {
                $query->where('user_id', Auth::user()->id)
                    ->where('entidad_id', $this->proveedor_seleccionado->entidad_id)
                    ->where('semestre_id', $this->semestre_seleccionado);
            })
            ->get();

        $this->open = true;
    }

    public function enviarArchivo()
    {
        $this->validate();
        $rutaCarpeta = '/public/entradas';

        //verificar si existe la carpeta storage/app/public/entradas, crear si no existe
        if (!Storage::exists($rutaCarpeta)) {
            Storage::makeDirectory($rutaCarpeta);
        }

        //copiar archivo a la carpeta storage/app/public/entradas
        $nombreArchivo = $this->archivo->getClientOriginalName();
        if (!$nombreArchivo) {
            $nombreArchivo = "Archivo adjunto";
        }

        $existe = Storage::disk('public')->exists('entradas/' . $nombreArchivo);
        $num = 0;
        if ($existe) {
            $aux = $nombreArchivo;
            while ($existe) {
                $num++;
                $aux = $num . '_' . $aux;
                $existe = Storage::disk('public')->exists('entradas/' . $aux);
                $aux = $nombreArchivo;
            }
            $nombreArchivo = $num . '_' . $nombreArchivo;
        }

        $this->archivo->storeAs($rutaCarpeta, $nombreArchivo);

        $documento = Documento::create([
            'nombre' => $nombreArchivo,
            'enlace_interno' => 'entradas' . '/' . $nombreArchivo,
            'entidad_id' => $this->proveedor_seleccionado->entidad_id,
            'semestre_id' => $this->semestre_seleccionado,
            'user_id' => Auth::user()->id,
        ]);

        //Guardar en la relacion polimorfica
        $documento_enviado = new DocumentoEnviado(['documento_id' => $documento->id]);
        $this->proveedor_seleccionado->entrada->documentos()->save($documento_enviado);

        $this->open = false;
        $this->emit('guardado', "El documento '$nombreArchivo' fue enviado.");
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
