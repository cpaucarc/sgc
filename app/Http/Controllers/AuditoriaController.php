<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
