<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComedorController extends Controller
{
    public function index()
    {
        return view('bienestar.index');
    }

    public function salud()
    {
        return view('bienestar.salud');
    }
}
