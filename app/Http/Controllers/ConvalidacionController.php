<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConvalidacionController extends Controller
{
    public function index()
    {
        return view('convalidacion.index');
    }
}
