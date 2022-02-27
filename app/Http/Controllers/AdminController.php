<?php

namespace App\Http\Controllers;

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
}
