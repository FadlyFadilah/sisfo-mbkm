<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPeriodeRequest;
use App\Http\Requests\StorePeriodeRequest;
use App\Http\Requests\UpdatePeriodeRequest;
use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class PeriodeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('periode_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $periodes = Periode::all();

        return view('admin.periodes.index', compact('periodes'));
    }

    public function create()
    {
        abort_if(Gate::denies('periode_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.periodes.create');
    }

    public function store(StorePeriodeRequest $request)
    {
        $periode = Periode::create($request->all());

        return redirect()->route('admin.periodes.index')->with('message', 'Berhasil membuat tahun periode!');
    }

    public function edit(Periode $periode)
    {
        abort_if(Gate::denies('periode_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.periodes.edit', compact('periode'));
    }

    public function update(UpdatePeriodeRequest $request, Periode $periode)
    {
        $periode->update($request->all());

        return redirect()->route('admin.periodes.index')->with('message', 'Berhasil mengubah tahun periode!');
    }

    public function show(Periode $periode)
    {
        abort_if(Gate::denies('periode_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $periode->load('periodeMahasiswas');

        return view('admin.periodes.show', compact('periode'));
    }

    public function destroy(Periode $periode)
    {
        abort_if(Gate::denies('periode_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $periode->delete();

        return back()->with('message', 'Berhasil menghapus tahun periode!');
    }

    public function massDestroy(MassDestroyPeriodeRequest $request)
    {
        $periodes = Periode::find(request('ids'));

        foreach ($periodes as $periode) {
            $periode->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}