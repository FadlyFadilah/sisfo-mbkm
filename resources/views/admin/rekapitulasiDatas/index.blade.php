@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header bg-navy">
            {{ trans('cruds.rekapitulasiData.title') }}
        </div>

        <div class="card-body">
            <div class="row">
                {{-- <div class="{{ $chartprogram->options['column_class'] }}">
                    <h3>{!! $chartprogram->options['chart_title'] !!}</h3>
                    {!! $chartprogram->renderHtml() !!}
                </div>
                <div class="{{ $chart->options['column_class'] }}">
                    <h3>{!! $chart->options['chart_title'] !!}</h3>
                    {!! $chart->renderHtml() !!}
                </div> --}}
                <div class="col-lg-6">
                    <h3>Export Laporan</h3>
                    <form action="{{ route('admin.export.full') }}" method="post" required>
                        @csrf
                        <div class="modal-body">
                            <label for="prodi">Prodi</label>
                            <select class="form-control {{ $errors->has('prodi') ? 'is-invalid' : '' }}" name="prodi_id"
                                id="prodi_id">
                                @foreach ($prodis as $id => $entry)
                                    <option value="{{ $id }}" {{ old('prodi_id') == $id ? 'selected' : '' }}>
                                        {{ $entry }}</option>
                                @endforeach
                            </select>
                            <br>
                            <label for="tahun_periode">Tahun Periode</label>
                            <select class="form-control {{ $errors->has('periode') ? 'is-invalid' : '' }}" name="periode_id"
                                id="periode_id">
                                @foreach ($periodes as $id => $entry)
                                    <option value="{{ $id }}" {{ old('periode_id') == $id ? 'selected' : '' }}>
                                        {{ $entry }}</option>
                                @endforeach
                            </select>
                            <br>
                            <label for="program">Program</label>
                            <select class="form-control {{ $errors->has('program') ? 'is-invalid' : '' }}"
                                name="program_id" id="program_id">
                                @foreach ($programs as $id => $entry)
                                    <option value="{{ $id }}" {{ old('program_id') == $id ? 'selected' : '' }}>
                                        {{ $entry }}</option>
                                @endforeach
                            </select>
                        </div>
                        <span class="text-danger">langsung saja jika ingin mendownload tanpa filter apapun!</span>

                        <div class="modal-footer justify-content-between">
                            <button type="submit" class="btn btn-flat btn-primary">Download Exel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>{!! $chartprogram->renderJs() !!}{!! $chart->renderJs() !!}
@endsection
