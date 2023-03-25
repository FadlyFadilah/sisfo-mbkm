@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.mahasiswa.title_singular') }}
    </div>
    
    <div class="card-body">
        <form method="POST" action="{{ route("admin.mahasiswas.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.mahasiswa.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                    <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mahasiswa.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="nama_lengkap">{{ trans('cruds.mahasiswa.fields.nama_lengkap') }}</label>
                <input class="form-control {{ $errors->has('nama_lengkap') ? 'is-invalid' : '' }}" type="text" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap', '') }}" required>
                @if($errors->has('nama_lengkap'))
                <span class="text-danger">{{ $errors->first('nama_lengkap') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mahasiswa.fields.nama_lengkap_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="nim">{{ trans('cruds.mahasiswa.fields.nim') }}</label>
                <input class="form-control {{ $errors->has('nim') ? 'is-invalid' : '' }}" type="text" name="nim" id="nim" value="{{ old('nim', '') }}" required>
                @if($errors->has('nim'))
                <span class="text-danger">{{ $errors->first('nim') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mahasiswa.fields.nim_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="prodi_id">{{ trans('cruds.mahasiswa.fields.prodi') }}</label>
                <select class="form-control select2 {{ $errors->has('prodi') ? 'is-invalid' : '' }}" name="prodi_id" id="prodi_id" required>
                    @foreach($prodis as $id => $entry)
                        <option value="{{ $id }}" {{ old('prodi_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('prodi'))
                    <span class="text-danger">{{ $errors->first('prodi') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mahasiswa.fields.prodi_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.mahasiswa.fields.jenis_kelamin') }}</label>
                @foreach(App\Models\Mahasiswa::JENIS_KELAMIN_RADIO as $key => $label)
                <div class="form-check {{ $errors->has('jenis_kelamin') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="radio" id="jenis_kelamin_{{ $key }}" name="jenis_kelamin" value="{{ $key }}" {{ old('jenis_kelamin', '') === (string) $key ? 'checked' : '' }} required>
                    <label class="form-check-label" for="jenis_kelamin_{{ $key }}">{{ $label }}</label>
                </div>
                @endforeach
                @if($errors->has('jenis_kelamin'))
                <span class="text-danger">{{ $errors->first('jenis_kelamin') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mahasiswa.fields.jenis_kelamin_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="tanggal_lahir">{{ trans('cruds.mahasiswa.fields.tanggal_lahir') }}</label>
                <input class="form-control date {{ $errors->has('tanggal_lahir') ? 'is-invalid' : '' }}" type="text" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                @if($errors->has('tanggal_lahir'))
                    <span class="text-danger">{{ $errors->first('tanggal_lahir') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mahasiswa.fields.tanggal_lahir_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="periode_id">{{ trans('cruds.mahasiswa.fields.periode') }}</label>
                <select class="form-control select2 {{ $errors->has('periode') ? 'is-invalid' : '' }}" name="periode_id" id="periode_id" required>
                    @foreach($periodes as $id => $entry)
                        <option value="{{ $id }}" {{ old('periode_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('periode'))
                    <span class="text-danger">{{ $errors->first('periode') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mahasiswa.fields.periode_helper') }}</span>
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