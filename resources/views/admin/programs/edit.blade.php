@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.program.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.programs.update", [$program->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="nama_program">{{ trans('cruds.program.fields.nama_program') }}</label>
                <input class="form-control {{ $errors->has('nama_program') ? 'is-invalid' : '' }}" type="text" name="nama_program" id="nama_program" value="{{ old('nama_program', $program->nama_program) }}" required>
                @if($errors->has('nama_program'))
                    <span class="text-danger">{{ $errors->first('nama_program') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.program.fields.nama_program_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="desc">Deskripsi Program</label>
                <textarea class="form-control {{ $errors->has('desc') ? 'is-invalid' : '' }}" name="desc" id="desc">{{ old('desc', $program->desc) }}</textarea>
                @if($errors->has('desc'))
                    <span class="text-danger">{{ $errors->first('desc') }}</span>
                @endif
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection