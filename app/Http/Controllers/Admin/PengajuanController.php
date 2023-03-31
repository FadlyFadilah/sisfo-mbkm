<?php

namespace App\Http\Controllers\Admin;

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

        $pengajuans = Pengajuan::with(['mahasiswa', 'program'])->get();

        return view('admin.pengajuans.index', compact('pengajuans'));
    }

    public function create()
    {
        abort_if(Gate::denies('pengajuan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mahasiswas = Mahasiswa::pluck('nama_lengkap', 'id')->prepend(trans('global.pleaseSelect'), '');

        $programs = Program::pluck('nama_program', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.pengajuans.create', compact('mahasiswas', 'programs'));
    }

    public function store(StorePengajuanRequest $request)
    {
        $pengajuan = Pengajuan::create($request->all());

        return redirect()->route('admin.pengajuans.index')->with('message', 'Berhasil membuat pengajuan!');
    }

    public function edit(Pengajuan $pengajuan)
    {
        abort_if(Gate::denies('pengajuan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mahasiswas = Mahasiswa::pluck('nama_lengkap', 'id')->prepend(trans('global.pleaseSelect'), '');

        $programs = Program::pluck('nama_program', 'id')->prepend(trans('global.pleaseSelect'), '');

        $pengajuan->load('mahasiswa', 'program');

        return view('admin.pengajuans.edit', compact('mahasiswas', 'pengajuan', 'programs'));
    }

    public function update(UpdatePengajuanRequest $request, Pengajuan $pengajuan)
    {
        $pengajuan->update($request->all());

        return redirect()->route('admin.pengajuans.index')->with('message', 'Berhasil mengubah pengajuan!');
    }

    public function show(Pengajuan $pengajuan)
    {
        abort_if(Gate::denies('pengajuan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pengajuan->load('mahasiswa', 'program', 'pengajuanLaporans');

        return view('admin.pengajuans.show', compact('pengajuan'));
    }

    public function verif(Request $request, Pengajuan $pengajuan)
    {
        $pengajuan->verif = $request->input('verif');

        $pengajuan->save();

        return back()->with('message', 'Berhasil menverifikasi pengajuan!');
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