<?php

namespace App\Http\Controllers\Admin;

use App\Models\Prodi;
use App\Models\Program;

class HomeController
{
    public function index()
    {
        $programs = Program::withCount('programPengajuans')->get();
        return view('home', compact('programs'));
    }
    public function detail($id)
    {
        $prodis = Prodi::withCount(['prodiMahasiswas' => function ($query) use ($id) {
            $query->whereHas('mahasiswaPengajuans', function ($query) use ($id) {
                $query->where('program_id', $id);
            });
        }])->get();

        return view('details', compact('prodis'));
        
    }
}
