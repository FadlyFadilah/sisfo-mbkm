<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProgramRequest;
use App\Http\Requests\StoreProgramRequest;
use App\Http\Requests\UpdateProgramRequest;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ProgramController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('program_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $programs = Program::all();

        return view('admin.programs.index', compact('programs'));
    }

    public function create()
    {
        abort_if(Gate::denies('program_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.programs.create');
    }

    public function store(StoreProgramRequest $request)
    {
        $program = Program::create($request->all());

        return redirect()->route('admin.programs.index')->with('message', 'Berhasil membuat program!');
    }

    public function edit(Program $program)
    {
        abort_if(Gate::denies('program_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.programs.edit', compact('program'));
    }

    public function update(UpdateProgramRequest $request, Program $program)
    {
        $program->update($request->all());

        return redirect()->route('admin.programs.index')->with('message', 'Berhasil mengubah program!');
    }

    public function show(Program $program)
    {
        abort_if(Gate::denies('program_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $program->load('programPengajuans');

        return view('admin.programs.show', compact('program'));
    }

    public function destroy(Program $program)
    {
        abort_if(Gate::denies('program_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $program->delete();

        return back()->with('message', 'Berhasil menghapus program!');
    }

    public function massDestroy(MassDestroyProgramRequest $request)
    {
        $programs = Program::find(request('ids'));

        foreach ($programs as $program) {
            $program->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}