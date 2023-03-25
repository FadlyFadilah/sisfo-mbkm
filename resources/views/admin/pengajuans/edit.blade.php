@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.pengajuan.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.pengajuans.update", [$pengajuan->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="mahasiswa_id">{{ trans('cruds.pengajuan.fields.mahasiswa') }}</label>
                <select class="form-control select2 {{ $errors->has('mahasiswa') ? 'is-invalid' : '' }}" name="mahasiswa_id" id="mahasiswa_id" required>
                    @foreach($mahasiswas as $id => $entry)
                        <option value="{{ $id }}" {{ (old('mahasiswa_id') ? old('mahasiswa_id') : $pengajuan->mahasiswa->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('mahasiswa'))
                    <span class="text-danger">{{ $errors->first('mahasiswa') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.pengajuan.fields.mahasiswa_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="program_id">{{ trans('cruds.pengajuan.fields.program') }}</label>
                <select class="form-control select2 {{ $errors->has('program') ? 'is-invalid' : '' }}" name="program_id" id="program_id" required>
                    @foreach($programs as $id => $entry)
                        <option value="{{ $id }}" {{ (old('program_id') ? old('program_id') : $pengajuan->program->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('program'))
                    <span class="text-danger">{{ $errors->first('program') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.pengajuan.fields.program_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="semester">{{ trans('cruds.pengajuan.fields.semester') }}</label>
                <input class="form-control {{ $errors->has('semester') ? 'is-invalid' : '' }}" type="text" name="semester" id="semester" value="{{ old('semester', $pengajuan->semester) }}" required>
                @if($errors->has('semester'))
                    <span class="text-danger">{{ $errors->first('semester') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.pengajuan.fields.semester_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="no_hp">{{ trans('cruds.pengajuan.fields.no_hp') }}</label>
                <input class="form-control {{ $errors->has('no_hp') ? 'is-invalid' : '' }}" type="text" name="no_hp" id="no_hp" value="{{ old('no_hp', $pengajuan->no_hp) }}">
                @if($errors->has('no_hp'))
                    <span class="text-danger">{{ $errors->first('no_hp') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.pengajuan.fields.no_hp_helper') }}</span>
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