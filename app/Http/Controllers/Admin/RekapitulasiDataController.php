<?php

namespace App\Http\Controllers\Admin;

use App\Exports\TiExport;
use App\Http\Controllers\Controller;
use App\Models\Periode;
use App\Models\Prodi;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;

class RekapitulasiDataController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('rekapitulasi_data_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $prodis = Prodi::pluck('nama_prodi', 'id')->prepend(trans('global.pleaseSelect'), '');

        $periodes = Periode::pluck('tahun_periode', 'id')->prepend(trans('global.pleaseSelect'), '');

        $programs = Program::pluck('nama_program', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.rekapitulasiDatas.index', compact('prodis', 'periodes', 'programs'));
    }
    
    public function export(Request $request)
    {
        $prodi = $request->input('prodi_id');
        $tahun = $request->input('periode_id');
        $program = $request->input('program_id');

        return Excel::download(new TiExport($prodi, $tahun, $program), 'Laporan.xlsx');
    }
}