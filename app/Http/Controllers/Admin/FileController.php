<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreFileRequest;
use App\Http\Requests\UpdateFileRequest;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class FileController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('file_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $files = File::with(['media'])->get();

        return view('admin.files.index', compact('files'));
    }

    public function create()
    {
        abort_if(Gate::denies('file_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.files.create');
    }

    public function store(StoreFileRequest $request)
    {
        $file = File::create($request->all());

        if ($request->input('file_laporan', false)) {
            $file->addMedia(storage_path('tmp/uploads/' . basename($request->input('file_laporan'))))->toMediaCollection('file_laporan');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $file->id]);
        }

        return redirect()->route('admin.home');
    }

    public function edit(File $file)
    {
        abort_if(Gate::denies('file_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.files.edit', compact('file'));
    }

    public function update(UpdateFileRequest $request, File $file)
    {
        $file->update($request->all());

        if ($request->input('file_laporan', false)) {
            if (! $file->file_laporan || $request->input('file_laporan') !== $file->file_laporan->file_name) {
                if ($file->file_laporan) {
                    $file->file_laporan->delete();
                }
                $file->addMedia(storage_path('tmp/uploads/' . basename($request->input('file_laporan'))))->toMediaCollection('file_laporan');
            }
        } elseif ($file->file_laporan) {
            $file->file_laporan->delete();
        }

        return redirect()->route('admin.home');
    }

    public function show(File $file)
    {
        abort_if(Gate::denies('file_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.files.show', compact('file'));
    }

    public function destroy(File $file)
    {
        abort_if(Gate::denies('file_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $file->delete();

        return back();
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('file_create') && Gate::denies('file_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new File();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}