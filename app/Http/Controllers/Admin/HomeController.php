<?php

namespace App\Http\Controllers\Admin;

use App\Models\File;
use App\Models\Mahasiswa;
use App\Models\Pengajuan;
use App\Models\Prodi;
use App\Models\Program;
use Illuminate\Support\Facades\DB;

class HomeController
{
    public function index()
    {
        $programs = Program::withCount(['programPengajuans' => function ($query) {
            $query->whereHas('mahasiswa.periode', function ($query) {
                $query->where('status', 'Aktif');
            });
        }])->get();
        $files = File::with(['media'])->first();

        return view('home', compact('programs', 'files'));
    }

    public function chart()
    {
        $pengajuanData = Pengajuan::select('verif', DB::raw('count(*) as total'))
            ->whereHas('mahasiswa.periode', function ($query) {
                $query->where('status', 'Aktif');
            })
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
            ->whereHas('mahasiswa.periode', function ($query) {
                $query->where('status', 'Aktif');
            })
            ->groupBy('programs.nama_program')
            ->selectRaw('programs.nama_program, COUNT(*) as count')
            ->orderBy('count', 'desc')
            ->get();

        return response()->json($data);
    }

    public function chartMahasiswaByProdi()
    {
        $data = Pengajuan::select('prodis.nama_prodi', DB::raw('COUNT(*) as jumlah_pengajuan'))
            ->join('mahasiswas', 'pengajuans.mahasiswa_id', '=', 'mahasiswas.id')
            ->join('prodis', 'mahasiswas.prodi_id', '=', 'prodis.id')
            ->whereHas('mahasiswa.periode', function ($query) {
                $query->where('status', 'Aktif');
            })
            ->groupBy('prodis.nama_prodi')
            ->get();

        $chartData = [];
        foreach ($data as $item) {
            $chartData[] = [
                'prodi' => $item->nama_prodi,
                'jumlah_pengajuan' => $item->jumlah_pengajuan,
            ];
        }

        return response()->json($chartData);
    }

    public function detail($nama)
    {
        $program = Program::where('nama_program', $nama)->first();
        $id = $program->id;
        $prodis = Prodi::withCount(['mahasiswas' => function ($query) use ($id) {
            $query->whereHas('mahasiswaPengajuans', function ($query) use ($id) {
                $query->where('program_id', $id);
            })->whereHas('periode', function ($query) {
                $query->where('status', 'Aktif');
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
        $mahasiswas = Mahasiswa::with('user', 'periode', 'prodi')
            ->where('prodi_id', $prodi_id)
            ->whereHas('mahasiswaPengajuans.program', function ($query) use ($program_id) {
                $query->where('id', $program_id);
            })
            ->whereHas('periode', function ($query) {
                $query->where('status', 'Aktif');
            })
            ->get();
        return view('show', compact('mahasiswas', 'nama', 'prodi'));
    }
}
