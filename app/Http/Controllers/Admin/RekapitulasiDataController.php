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
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class RekapitulasiDataController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('rekapitulasi_data_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $prodis = Prodi::pluck('nama_prodi', 'id')->prepend(trans('global.pleaseSelect'), '');

        $periodes = Periode::pluck('tahun_periode', 'id')->prepend(trans('global.pleaseSelect'), '');

        $programs = Program::pluck('nama_program', 'id')->prepend(trans('global.pleaseSelect'), '');

        $settings1 = [
            'chart_title'        => 'Pengajuan Per-Perogram',
            'chart_type'         => 'bar',
            'report_type'        => 'group_by_relationship',
            'model'              => 'App\Models\Pengajuan',
            'group_by_field'     => 'nama_program',
            'aggregate_function' => 'count',
            'filter_field'       => 'created_at',
            'column_class'       => 'col-md-6',
            'entries_number'     => '5',
            'relationship_name'  => 'program',
            'translation_key'    => 'pengajuan', 
        ];
        $chartprogram = new LaravelChart($settings1);

        $settings2 = [
            'chart_title'        => 'Mahasiswa Per-Prodi',
            'chart_type'         => 'bar',
            'report_type'        => 'group_by_relationship',
            'model'              => 'App\Models\Mahasiswa',
            'group_by_field'     => 'nama_prodi',
            'aggregate_function' => 'count',
            'filter_field'       => 'created_at',
            'column_class'       => 'col-md-6',
            'entries_number'     => '5',
            'relationship_name'  => 'prodi',
            'translation_key'    => 'mahasiswa',
        ];

        $chart = new LaravelChart($settings2);

        return view('admin.rekapitulasiDatas.index', compact('programs', 'periodes', 'programs', 'prodis', 'chartprogram', 'chart'));
    }

    public function export(Request $request)
    {
        $prodi = $request->input('prodi_id');
        if ($prodi) {
            $prodii = Prodi::where('id', $prodi)->first();
            $prodiii = $prodii->nama_prodi;
        } else {
            $prodiii = $request->input('prodi_id');
        }
        $tahun = $request->input('periode_id');
        if ($tahun) {
            $tahunn = Periode::where('id', $tahun)->first();
            $tahunnn = $tahunn->tahun_periode;
        } else {
            $tahunnn = $request->input('periode_id');
        }
        $program = $request->input('program_id');
        if ($program) {
            $programm = Program::where('id', $program)->first();
            $programmm = $programm->nama_program;
        } else {
            $programmm = $request->input('program_id');
        }

        return Excel::download(new TiExport($prodi, $tahun, $program), 'Laporan ' . $prodiii . '-' . $tahunnn . '-' . $programmm . '-' .  '.xlsx');
    }
}
