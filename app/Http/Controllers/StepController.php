<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StepController extends Controller
{
    public function index()
    {
        return view('steps');
    }
}