@extends('layouts.frontend')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                @if ($mahasiswa === null)
                    <h3 class="text-uppercase">{{ auth()->user()->name }} | {{ auth()->user()->username }}</h3>
                @else
                    <h3 class="text-uppercase">{{ $mahasiswa->nama_lengkap }} | {{ $mahasiswa->nim }}</h3>
                @endforelse
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                            aria-controls="home" aria-selected="true">Identitas Mahasiswa</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                        <form method="POST" action="{{ route('frontend.mahasiswas.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            @if ($mahasiswa === null)
                                <div class="form-group">
                                    <label class="required"
                                        for="nama_lengkap">{{ trans('cruds.mahasiswa.fields.nama_lengkap') }}</label>
                                    <input class="form-control" type="text" name="nama_lengkap" id="nama_lengkap"
                                        value="{{ old('nama_lengkap', '') }}" required>
                                    @if ($errors->has('nama_lengkap'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('nama_lengkap') }}
                                        </div>
                                    @endif
                                    <span
                                        class="help-block">{{ trans('cruds.mahasiswa.fields.nama_lengkap_helper') }}</span>
                                </div>
                                <div class="form-group">
                                    <label class="required" for="nim">{{ trans('cruds.mahasiswa.fields.nim') }}</label>
                                    <input class="form-control" type="text" name="nim" id="nim"
                                        value="{{ old('nim', '') }}" required>
                                    @if ($errors->has('nim'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('nim') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.mahasiswa.fields.nim_helper') }}</span>
                                </div>
                                <div class="form-group">
                                    <label class="required"
                                        for="prodi_id">{{ trans('cruds.mahasiswa.fields.prodi') }}</label>
                                    <select class="form-control select2 {{ $errors->has('prodi') ? 'is-invalid' : '' }}"
                                        name="prodi_id" id="prodi_id" required>
                                        @foreach ($prodis as $id => $entry)
                                            <option value="{{ $id }}"
                                                {{ old('prodi_id') == $id ? 'selected' : '' }}>{{ $entry }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('prodi'))
                                        <span class="text-danger">{{ $errors->first('prodi') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.mahasiswa.fields.prodi_helper') }}</span>
                                </div>
                                <div class="form-group">
                                    <label class="required">{{ trans('cruds.mahasiswa.fields.jenis_kelamin') }}</label>
                                    @foreach (App\Models\Mahasiswa::JENIS_KELAMIN_RADIO as $key => $label)
                                        <div>
                                            <input type="radio" id="jenis_kelamin_{{ $key }}"
                                                name="jenis_kelamin" value="{{ $key }}"
                                                {{ old('jenis_kelamin', '') === (string) $key ? 'checked' : '' }} required>
                                            <label for="jenis_kelamin_{{ $key }}">{{ $label }}</label>
                                        </div>
                                    @endforeach
                                    @if ($errors->has('jenis_kelamin'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('jenis_kelamin') }}
                                        </div>
                                    @endif
                                    <span
                                        class="help-block">{{ trans('cruds.mahasiswa.fields.jenis_kelamin_helper') }}</span>
                                </div>
                                <div class="form-group">
                                    <label class="required" for="tanggal_lahir">{{ trans('cruds.mahasiswa.fields.tanggal_lahir') }}</label>
                                    <input class="form-control {{ $errors->has('tanggal_lahir') ? 'is-invalid' : '' }}" type="text"
                                        name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                                    @if ($errors->has('tanggal_lahir'))
                                        <span class="text-danger">{{ $errors->first('tanggal_lahir') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.mahasiswa.fields.tanggal_lahir_helper') }}</span>
                                </div>
                                <div class="form-group">
                                    <label class="required"
                                        for="periode_id">{{ trans('cruds.mahasiswa.fields.periode') }}</label>
                                    <select class="form-control select2 {{ $errors->has('periode') ? 'is-invalid' : '' }}"
                                        name="periode_id" id="periode_id" required>
                                        @foreach ($periodes as $id => $entry)
                                            <option value="{{ $id }}"
                                                {{ old('periode_id') == $id ? 'selected' : '' }}>{{ $entry }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('periode'))
                                        <span class="text-danger">{{ $errors->first('periode') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.mahasiswa.fields.periode_helper') }}</span>
                                </div>
                            @else
                                <div class="form-group">
                                    <label class="required"
                                        for="nama_lengkap">{{ trans('cruds.mahasiswa.fields.nama_lengkap') }}</label>
                                    <input class="form-control" type="text" name="nama_lengkap" id="nama_lengkap"
                                        value="{{ old('nama_lengkap', $mahasiswa->nama_lengkap) }}" required>
                                    @if ($errors->has('nama_lengkap'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('nama_lengkap') }}
                                        </div>
                                    @endif
                                    <span
                                        class="help-block">{{ trans('cruds.mahasiswa.fields.nama_lengkap_helper') }}</span>
                                </div>
                                <div class="form-group">
                                    <label class="required"
                                        for="nim">{{ trans('cruds.mahasiswa.fields.nim') }}</label>
                                    <input class="form-control" type="text" name="nim" id="nim"
                                        value="{{ old('nim', $mahasiswa->nim) }}" required>
                                    @if ($errors->has('nim'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('nim') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.mahasiswa.fields.nim_helper') }}</span>
                                </div>
                                <div class="form-group">
                                    <label class="required"
                                        for="prodi_id">{{ trans('cruds.mahasiswa.fields.prodi') }}</label>
                                    <select class="form-control select2 {{ $errors->has('prodi') ? 'is-invalid' : '' }}"
                                        name="prodi_id" id="prodi_id" required>
                                        @foreach ($prodis as $id => $entry)
                                            <option value="{{ $id }}"
                                                {{ (old('prodi_id') ? old('prodi_id') : $mahasiswa->prodi->id ?? '') == $id ? 'selected' : '' }}>
                                                {{ $entry }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('prodi'))
                                        <span class="text-danger">{{ $errors->first('prodi') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.mahasiswa.fields.prodi_helper') }}</span>
                                </div>
                                <div class="form-group">
                                    <label class="required">{{ trans('cruds.mahasiswa.fields.jenis_kelamin') }}</label>
                                    @foreach (App\Models\Mahasiswa::JENIS_KELAMIN_RADIO as $key => $label)
                                        <div>
                                            <input type="radio" id="jenis_kelamin_{{ $key }}"
                                                name="jenis_kelamin" value="{{ $key }}"
                                                {{ old('jenis_kelamin', $mahasiswa->jenis_kelamin) === (string) $key ? 'checked' : '' }}
                                                required>
                                            <label for="jenis_kelamin_{{ $key }}">{{ $label }}</label>
                                        </div>
                                    @endforeach
                                    @if ($errors->has('jenis_kelamin'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('jenis_kelamin') }}
                                        </div>
                                    @endif
                                    <span
                                        class="help-block">{{ trans('cruds.mahasiswa.fields.jenis_kelamin_helper') }}</span>
                                </div>
                                <div class="form-group">
                                    <label class="required" for="tanggal_lahir">{{ trans('cruds.mahasiswa.fields.tanggal_lahir') }}</label>
                                    <input class="form-control datepicker {{ $errors->has('tanggal_lahir') ? 'is-invalid' : '' }}" type="text" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir', $mahasiswa->tanggal_lahir) }}" required>
                                    @if($errors->has('tanggal_lahir'))
                                        <span class="text-danger">{{ $errors->first('tanggal_lahir') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.mahasiswa.fields.tanggal_lahir_helper') }}</span>
                                </div>
                                <div class="form-group">
                                    <label class="required"
                                        for="periode_id">{{ trans('cruds.mahasiswa.fields.periode') }}</label>
                                    <select class="form-control select2 {{ $errors->has('periode') ? 'is-invalid' : '' }}"
                                        name="periode_id" id="periode_id" required>
                                        @foreach ($periodes as $id => $entry)
                                            <option value="{{ $id }}"
                                                {{ (old('periode_id') ? old('periode_id') : $mahasiswa->periode->id ?? '') == $id ? 'selected' : '' }}>
                                                {{ $entry }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('periode'))
                                        <span class="text-danger">{{ $errors->first('periode') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.mahasiswa.fields.periode_helper') }}</span>
                                </div>
                            @endif
                            <div class="form-group">
                                <button class="btn btn-danger" type="submit">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#tanggal_lahir').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 1900, // Tahun minimum yang diizinkan
                maxYear: parseInt(moment().format('YYYY'),
                    10), // Tahun maksimum yang diizinkan, di sini diatur sebagai tahun saat ini
                locale: {
                    format: 'YYYY-MM-DD', // Format tanggal yang diharapkan
                    separator: ' - ',
                    applyLabel: 'Pilih',
                    cancelLabel: 'Batal',
                    fromLabel: 'Dari',
                    toLabel: 'Hingga',
                    customRangeLabel: 'Custom',
                    weekLabel: 'W',
                    daysOfWeek: ['Mg', 'Sn', 'Sl', 'Rb', 'Km', 'Jm', 'Sa'],
                    monthNames: [
                        'Januari',
                        'Februari',
                        'Maret',
                        'April',
                        'Mei',
                        'Juni',
                        'Juli',
                        'Agustus',
                        'September',
                        'Oktober',
                        'November',
                        'Desember'
                    ],
                    firstDay: 1
                }
            });
        });
    </script>
@endsection
