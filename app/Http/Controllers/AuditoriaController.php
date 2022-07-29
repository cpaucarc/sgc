<?php

namespace App\Http\Controllers;

use App\Models\AuditoriaInterna;
use App\Models\AuditoriaInternaDetalle;
use App\Models\Cliente;
use App\Models\DocumentoEnviado;
use App\Models\Entidad;
use App\Models\Facultad;
use App\Models\Responsable;
use App\Models\Semestre;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AuditoriaController extends Controller
{
    public function index()
    {
        return view('auditoria.index');
    }

    public function create()
    {
        return view('auditoria.create');
    }

    public function auditoria_interna($uuid)
    {
        $facultad = Facultad::query()->with('entidades')->where('uuid', 'like', $uuid . '%')->first();
        $semestre = Semestre::query()->where('activo', true)->first();

        return view('auditoria.interna', compact('uuid', 'facultad', 'semestre'));
    }

    public function auditoria_interna_pdf($facultad, $semestre)
    {
        try {
            $fac = Facultad::findOrFail($facultad);
            $sem = Semestre::findOrFail($semestre);
            $auditoria = AuditoriaInterna::where('facultad_id', $facultad)->where('semestre_id', $semestre)->first();

            $auditoria_detalles = AuditoriaInternaDetalle::query()
                ->with('responsable_salida', 'responsable_salida.salida', 'responsable_salida.responsable')
                ->where('auditoria_interna_id', $auditoria->id)->get();

            Log::info('detalles', $auditoria_detalles->toArray());

            $entidades = array();
            foreach ($auditoria_detalles as $det) {
                if (!in_array($det->responsable_salida->responsable->entidad->nombre, $entidades)) {
                    $entidades[] = $det->responsable_salida->responsable->entidad->nombre;
                }
            }

            Log::info('$entidades', $entidades);

            $detalles = array();
            foreach ($entidades as $entidad) {
                $detalle = array();
                $detalle['entidad'] = $entidad;
                $salidas = array();
                foreach ($auditoria_detalles as $auditoria_detalle) {
                    if ($entidad === $auditoria_detalle->responsable_salida->responsable->entidad->nombre) {
                        $salida = [
                            'proceso' => $auditoria_detalle->responsable_salida->responsable->actividad->proceso->nombre,
                            'actividad' => $auditoria_detalle->responsable_salida->responsable->actividad->nombre,
                            'salida' => $auditoria_detalle->responsable_salida->salida->nombre,
                            'documentos' => $auditoria_detalle->documentos,
                            'observacion' => $auditoria_detalle->observacion ?? 'Ninguno',
                        ];
                        $salidas[] = $salida;
                    }
                }
                $detalle['salidas'] = $salidas;
                $detalles[] = $detalle;
            }

            Log::info('$detalles', $detalles);

            $nombre_documento = "Auditoria-Interna-" . $fac->abrev . '-' . $sem->nombre . '.pdf'; // Auditoria-Interna-FCM-2021-1.pdf

            $pdf = PDF::loadView('auditoria.interna_pdf', [
                'facultad' => $fac,
                'semestre' => $sem,
                'auditoria' => $auditoria,
                'detalles' => $detalles
            ]);
            return $pdf->setPaper('a3')->download($nombre_documento);

        } catch (\Exception $e) {
            Log::info('Auditoria Controller: => ', ['Error PDF' => $e]);
            abort(404, 'Hubo un error inesperado.\\n' . $e);
        }
    }
}
