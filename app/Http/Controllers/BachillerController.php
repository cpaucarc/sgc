<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BachillerController extends Controller
{
    public function index()
    {
        return view('bachiller.index');
    }

    public function request()
    {
        return view('bachiller.request');
    }

    public function requests()
    {
        return view('bachiller.requests');
    }
}
