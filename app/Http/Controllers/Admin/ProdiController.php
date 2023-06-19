<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProdiRequest;
use App\Http\Requests\StoreProdiRequest;
use App\Http\Requests\UpdateProdiRequest;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ProdiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('prodi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prodis = Prodi::all();

        return view('admin.prodis.index', compact('prodis'));
    }

    public function create()
    {
        abort_if(Gate::denies('prodi_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.prodis.create');
    }

    public function store(StoreProdiRequest $request)
    {
        $prodi = Prodi::create($request->all());

        return redirect()->route('admin.prodis.index')->with('message', 'Berhasil membuat prodi!');
    }

    public function edit(Prodi $prodi)
    {
        abort_if(Gate::denies('prodi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.prodis.edit', compact('prodi'));
    }

    public function update(UpdateProdiRequest $request, Prodi $prodi)
    {
        $prodi->update($request->all());

        return redirect()->route('admin.prodis.index')->with('message', 'Berhasil mengubah prodi!');
    }

    public function show(Prodi $prodi)
    {
        abort_if(Gate::denies('prodi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prodi->load('mahasiswas');

        return view('admin.prodis.show', compact('prodi'));
    }

    public function destroy(Prodi $prodi)
    {
        abort_if(Gate::denies('prodi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prodi->delete();

        return back()->with('message', 'Berhasil menghapus prodi!');
    }

    public function massDestroy(MassDestroyProdiRequest $request)
    {
        $prodis = Prodi::find(request('ids'));

        foreach ($prodis as $prodi) {
            $prodi->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}