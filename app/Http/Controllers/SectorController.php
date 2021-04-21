<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SectorController extends Controller
{
    public function index()
    {
        return view('sectors');
    }
}
