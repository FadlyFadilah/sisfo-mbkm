<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPengajuanRequest;
use App\Http\Requests\StorePengajuanRequest;
use App\Http\Requests\UpdatePengajuanRequest;
use App\Models\Mahasiswa;
use App\Models\Pengajuan;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class PengajuanController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('pengajuan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mahasiswa = Mahasiswa::where('user_id', auth()->user()->id)->first();
        if ($mahasiswa === NULL) {
            return back()->with('error', 'Isi Dahulu Data Mahasiswa');
        }
        $pengajuans = Pengajuan::with(['mahasiswa', 'program'])->where('mahasiswa_id', $mahasiswa->id)->get();

        return view('frontend.pengajuans.index', compact('pengajuans'));
    }

    public function create()
    {
        abort_if(Gate::denies('pengajuan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $mahasiswa = Mahasiswa::where('user_id', auth()->user()->id)->first();
        $programs = Program::pluck('nama_program', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.pengajuans.create', compact('programs', 'mahasiswa'));
    }

    public function store(StorePengajuanRequest $request)
    {
        $attr = $request->all();
        $mahasiswa = Mahasiswa::where('user_id', auth()->user()->id)->first();
        $attr['mahasiswa_id'] = $mahasiswa->id;
        $attr['verif'] = "Pending";

        $pengajuan = Pengajuan::create($attr);

        return redirect()->route('frontend.pengajuans.index')->with('message', 'Berhasil membuat pengajuan!');
    }

    public function edit(Pengajuan $pengajuan)
    {
        abort_if(Gate::denies('pengajuan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $programs = Program::pluck('nama_program', 'id')->prepend(trans('global.pleaseSelect'), '');

        $pengajuan->load('program');

        return view('frontend.pengajuans.edit', compact('pengajuan', 'programs'));
    }

    public function update(UpdatePengajuanRequest $request, Pengajuan $pengajuan)
    {
        $attr = $request->all();
        $mahasiswa = Mahasiswa::where('user_id', auth()->user()->id)->first();
        $attr['mahasiswa_id'] = $mahasiswa->id;
        $pengajuan->update($attr);

        return redirect()->route('frontend.pengajuans.index')->with('message', 'Berhasil mengubah pengajuan!');
    }

    public function show(Pengajuan $pengajuan)
    {
        abort_if(Gate::denies('pengajuan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pengajuan->load('mahasiswa', 'program', 'pengajuanLaporans');

        return view('frontend.pengajuans.show', compact('pengajuan'));
    }

    public function destroy(Pengajuan $pengajuan)
    {
        abort_if(Gate::denies('pengajuan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pengajuan->delete();

        return back()->with('message', 'Berhasil menghapus pengajuan!');
    }

    public function massDestroy(MassDestroyPengajuanRequest $request)
    {
        $pengajuans = Pengajuan::find(request('ids'));

        foreach ($pengajuans as $pengajuan) {
            $pengajuan->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
