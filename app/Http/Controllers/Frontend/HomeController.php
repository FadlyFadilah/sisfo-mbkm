<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Mahasiswa;
use App\Models\Pengajuan;
use App\Models\Program;
use Illuminate\Support\Facades\DB;

class HomeController
{
    public function index()
    {
        $programs = Program::select('nama_program', 'desc')->get();
        return view('frontend.home', compact('programs'));
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
}