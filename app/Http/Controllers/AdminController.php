<?php

namespace App\Http\Controllers;

use App\Models\Convenio;
use App\Models\Entidad;
use App\Models\Facultad;
use App\Models\Semestre;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return redirect()->route('admin.panel.facultades');
    }

    public function escuelas()
    {
        return view('admin.escuelas');
    }

    public function facultades()
    {
        return view('admin.facultades');
    }

    public function semestres()
    {
        return view('admin.semestres');
    }

    public function entidades()
    {
        return view('admin.entidades');
    }

    public function entidad_responsable($id)
    {
        $entidad = Entidad::with('rol')->findOrFail($id);
        return view('admin.entidad-responsable', compact('entidad'));
    }

    public function entidad_proveedor($id)
    {
        $entidad = Entidad::with('rol')->findOrFail($id);
        return view('admin.entidad-proveedor', compact('entidad'));
    }

    public function entidad_cliente($id)
    {
        $entidad = Entidad::with('rol')->findOrFail($id);
        return view('admin.entidad-cliente', compact('entidad'));
    }

    public function procesos()
    {
        return view('admin.procesos');
    }

    public function actividades()
    {
        return view('admin.actividades');
    }

    public function entradas()
    {
        return view('admin.entradas');
    }

    public function salidas()
    {
        return view('admin.salidas');
    }

    public function indicadores()
    {
        return view('admin.indicadores');
    }

    public function indicador($id)
    {
        return view('admin.indicador', compact('id'));
    }

    public function crear_indicador()
    {
        return view('admin.crear-indicador');
    }

    public function editar_indicador($id)
    {
        return view('admin.editar-indicador', compact('id'));
    }

    public function usuarios()
    {
        return view('admin.usuarios');
    }

    public function usuario($uuid)
    {
        return view('admin.usuario', compact('uuid'));
    }

    public function empresas()
    {
        return view('admin.empresas');
    }

}
