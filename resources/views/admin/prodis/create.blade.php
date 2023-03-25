@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.prodi.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.prodis.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="nama_prodi">{{ trans('cruds.prodi.fields.nama_prodi') }}</label>
                <input class="form-control {{ $errors->has('nama_prodi') ? 'is-invalid' : '' }}" type="text" name="nama_prodi" id="nama_prodi" value="{{ old('nama_prodi', '') }}" required>
                @if($errors->has('nama_prodi'))
                    <span class="text-danger">{{ $errors->first('nama_prodi') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prodi.fields.nama_prodi_helper') }}</span>
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