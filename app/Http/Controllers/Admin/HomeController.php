<?php

namespace App\Http\Controllers\Admin;

use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\Program;

class HomeController
{
    public function index()
    {
        $programs = Program::withCount('programPengajuans')->get();
        return view('home', compact('programs'));
    }
    public function detail($nama)
    {
        $program = Program::where('nama_program', $nama)->first();
        $id = $program->id;
        $prodis = Prodi::withCount(['prodiMahasiswas' => function ($query) use ($id) {
            $query->whereHas('mahasiswaPengajuans', function ($query) use ($id) {
                $query->where('program_id', $id);
            });
        }])->get();

        return view('details', compact('prodis', 'nama'));
    }

    public function show($nama, $prodi)
    {
        $programm = Program::where('nama_program', $nama)->first();
        $prodii = Prodi::where('nama_prodi', $prodi)->first();
        $prodi_id = $prodii->id;
        $program_id = $programm->id;
        $mahasiswas = Mahasiswa::with('user')->where('prodi_id', $prodi_id)->whereHas('mahasiswaPengajuans.program', function ($query) use ($program_id) {
            $query->where('id', $program_id);
        })->get();
        return view('show', compact('mahasiswas', 'nama', 'prodi'));
    }
}
