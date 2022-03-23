<?php

namespace App\Http\Controllers;

use App\Models\Convenio;
use App\Models\Facultad;
use App\Models\Semestre;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function index()
    {

    }

    /* Convenios */
    public function convenio()
    {
        return view('admin.convenio.general');
    }

    public function convenio_reporte(Request $request)
    {
        $facultad = intval($request->input('facultad'));
        $semestre = intval($request->input('semestre'));

        $convenios = Convenio::query()
            ->with('semestre', 'facultad')
            ->orderBy('semestre_id', 'desc')
            ->orderBy(Facultad::select('nombre')->whereColumn('facultades.id', 'convenios.facultad_id'));

        if ($facultad > 0) {
            $convenios = $convenios->where('facultad_id', $facultad);
        }
        if ($semestre > 0) {
            $convenios = $convenios->where('semestre_id', $semestre);
        }
        $convenios = $convenios->get();

        $facultad_nombre = $facultad === 0 ? 'Todos' : Facultad::query()->where('id', $facultad)->first()->nombre;
        $semestre_nombre = $semestre === 0 ? 'Todos' : Semestre::query()->where('id', $semestre)->first()->nombre;

        $pdf = PDF::loadView('reporte.convenio.reporte_principal', [
            'convenios' => $convenios,
            'facultad' => $facultad_nombre,
            'semestre' => $semestre_nombre]);
        return $pdf->setPaper('a3')->stream();
    }

}
