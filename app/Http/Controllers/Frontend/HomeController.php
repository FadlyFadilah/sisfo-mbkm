<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Program;

class HomeController
{
    public function index()
    {
        return view('frontend.home');
    }

    public function show()
    {
        $programs = Program::select('nama_program', 'desc')->get();

        return view('frontend.program', compact('programs'));
    }
}