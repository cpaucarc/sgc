<?php

namespace App\Http\Controllers;

use App\Models\AuditoriaInterna;
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

            $auditoria_interna = AuditoriaInterna::query()
                ->where('facultad_id', $facultad)
                ->where('semestre_id', $semestre)
                ->first();

            $pdf = PDF::loadView('auditoria.interna_pdf', [
                'auditoria_interna' => $auditoria_interna
            ]);
            return $pdf->setPaper('a3')->stream('');

        } catch (\Exception $e) {
            Log::info('Auditoria Controller: => ', ['Error PDF' => $e]);
            abort(404, 'Hubo un error inesperado.\\n' . $e);
        }
    }
}
