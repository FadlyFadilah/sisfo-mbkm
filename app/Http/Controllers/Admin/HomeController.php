<?php

namespace App\Http\Controllers\Admin;

use App\Models\Mahasiswa;
use App\Models\Pengajuan;
use App\Models\Prodi;
use App\Models\Program;
use Illuminate\Support\Facades\DB;

class HomeController
{
    public function index()
    {
        $programs = Program::withCount('programPengajuans')->get();

        return view('home', compact('programs'));
    }

    public function chart()
    {
        $pengajuanData = Pengajuan::select('verif', DB::raw('count(*) as total'))
            ->groupBy('verif')
            ->get();

        $chartData = [];
        foreach ($pengajuanData as $data) {
            $chartData[] = [
                'label' => $data->verif,
                'value' => $data->total
            ];
        }

        return response()->json($chartData);
    }

    public function chartbar()
    {
        $data = Pengajuan::join('programs', 'pengajuans.program_id', '=', 'programs.id')
            ->groupBy('programs.nama_program')
            ->selectRaw('programs.nama_program, COUNT(*) as count')
            ->orderBy('count', 'desc')
            ->get();

        return response()->json($data);
    }

    public function chartMahasiswaByProdi()
    {
        $mahasiswa = Mahasiswa::whereHas('mahasiswaPengajuans')->get();
        $prodiList = [];

        foreach ($mahasiswa as $mhs) {
            $prodi = $mhs->prodi->nama_prodi; // Menggunakan nama_prodi sebagai field prodi
            if (!in_array($prodi, $prodiList)) {
                $prodiList[] = $prodi;
            }
        }

        $data = [];

        foreach ($prodiList as $prodi) {
            $data[] = [
                'nama_prodi' => $prodi, // Menggunakan nama_prodi sebagai field prodi
                'jumlah_pengajuan' => $mahasiswa->where('prodi.nama_prodi', $prodi)->count(),
            ];
        }

        return response()->json($data);
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
        $mahasiswas = Mahasiswa::with('user', 'periode', 'prodi')->where('prodi_id', $prodi_id)->whereHas('mahasiswaPengajuans.program', function ($query) use ($program_id) {
            $query->where('id', $program_id);
        })->get();
        return view('show', compact('mahasiswas', 'nama', 'prodi'));
    }
}
