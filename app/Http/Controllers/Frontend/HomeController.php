<?php

namespace App\Http\Controllers\Frontend;

use App\Models\File;
use App\Models\Mahasiswa;
use App\Models\Pengajuan;
use App\Models\Program;
use Illuminate\Support\Facades\DB;

class HomeController
{
    public function index()
    {
        $programs = Program::withCount(['programPengajuans' => function ($query) {
            $query->whereHas('mahasiswa.periode', function ($query) {
                $query->where('status', 'Aktif');
            })->whereNot('verif', 'tolak');
        }])->get();
        $files = File::with(['media'])->first();

        return view('frontend.home', compact('programs', 'files'));
    }

    public function chart()
    {
        $id = Mahasiswa::where('user_id', auth()->id())->first();
        $pengajuanData = Pengajuan::select('verif', DB::raw('count(*) as total'))
            ->where('mahasiswa_id', $id->id)
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
            ->whereNot('verif', 'tolak')
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
            ->whereNot('verif', 'tolak')
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
}
