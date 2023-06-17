@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.periode.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.periodes.update", [$periode->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="tahun_periode">{{ trans('cruds.periode.fields.tahun_periode') }}</label>
                <input class="form-control {{ $errors->has('tahun_periode') ? 'is-invalid' : '' }}" type="text" name="tahun_periode" id="tahun_periode" value="{{ old('tahun_periode', $periode->tahun_periode) }}" required>
                @if($errors->has('tahun_periode'))
                    <span class="text-danger">{{ $errors->first('tahun_periode') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.periode.fields.tahun_periode_helper') }}</span>
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


