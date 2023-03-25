@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.pengajuan.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.pengajuans.update", [$pengajuan->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="program_id">{{ trans('cruds.pengajuan.fields.program') }}</label>
                            <select class="form-control select2" name="program_id" id="program_id" required>
                                @foreach($programs as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('program_id') ? old('program_id') : $pengajuan->program->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('program'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('program') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pengajuan.fields.program_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="semester">{{ trans('cruds.pengajuan.fields.semester') }}</label>
                            <input class="form-control" type="text" name="semester" id="semester" value="{{ old('semester', $pengajuan->semester) }}" required>
                            @if($errors->has('semester'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('semester') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pengajuan.fields.semester_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="no_hp">{{ trans('cruds.pengajuan.fields.no_hp') }}</label>
                            <input class="form-control" type="text" name="no_hp" id="no_hp" value="{{ old('no_hp', $pengajuan->no_hp) }}">
                            @if($errors->has('no_hp'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('no_hp') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection