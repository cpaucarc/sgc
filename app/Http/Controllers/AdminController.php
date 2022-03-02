<?php

namespace App\Http\Controllers;

use App\Models\Entidad;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return redirect()->route('admin.facultades');
    }

    public function escuelas()
    {
        return view('admin.escuelas');
    }

    public function facultades()
    {
        return view('admin.facultades');
    }

    public function entidades()
    {
        return view('admin.entidades');
    }

    public function entidad_responsable($id)
    {
        $entidad = Entidad::with('oficina')->findOrFail($id);
        return view('admin.entidad-responsable', compact('entidad'));
    }

    public function entidad_proveedor($id)
    {
        $entidad = Entidad::with('oficina')->findOrFail($id);
        return view('admin.entidad-proveedor', compact('entidad'));
    }

    public function entidad_cliente($id)
    {
        $entidad = Entidad::with('oficina')->findOrFail($id);
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
}
