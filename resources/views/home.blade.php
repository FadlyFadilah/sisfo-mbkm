@extends('layouts.admin')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/morris.css') }}">
    <style>
        .chart-wrapper {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }
    </style>
@endsection
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card bg-navy">
                    <div class="card-header">
                        Yang mengikuti Program Merdeka Belakar Kampus Merdeka
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card bg-navy">
                                    <div class="card-header">
                                        Pengajuan
                                    </div>
                                    <div class="chart-wrapper">
                                        <div id="chart-container"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card bg-navy">
                                    <div class="card-header">
                                        Pengajuan Per-Program
                                    </div>
                                    <div class="chart-wrapper">
                                        <div id="bar-chart-container"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card bg-navy">
                                    <div class="card-header">
                                        Pengajuan Per-Prodi
                                    </div>
                                    <div class="chart-wrapper">
                                        <div id="bar-chart-containerr"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card bg-navy">
                                    <div class="card-header">
                                        Contoh Format Laporan MBKM
                                    </div>
                                    <div class="chart-wrapper">
                                        @can('file_edit')
                                            @if ($files === null)
                                                <form method="POST" action="{{ route('admin.files.store') }}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="file_laporan">Format Laporan</label>
                                                        <div class="needsclick dropzone {{ $errors->has('file_laporan') ? 'is-invalid' : '' }}"
                                                            id="file_laporan-dropzone">
                                                        </div>
                                                        @if ($errors->has('file_laporan'))
                                                            <span
                                                                class="text-danger">{{ $errors->first('file_laporan') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <button class="btn btn-danger" type="submit">
                                                            {{ trans('global.save') }}
                                                        </button>
                                                    </div>
                                                </form>
                                            @else
                                                <form method="POST" action="{{ route('admin.files.update', [$files->id]) }}"
                                                    enctype="multipart/form-data">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="file_laporan">Format Laporan</label>
                                                        <div class="needsclick dropzone {{ $errors->has('file_laporan') ? 'is-invalid' : '' }}"
                                                            id="file_laporan-dropzone">
                                                        </div>
                                                        @if ($errors->has('file_laporan'))
                                                            <span
                                                                class="text-danger">{{ $errors->first('file_laporan') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <button class="btn btn-danger" type="submit">
                                                            {{ trans('global.save') }}
                                                        </button>
                                                    </div>
                                                </form>
                                            @endif
                                        @endcan
                                        @if ($files === null)
                                            Belum ada dokumen format laporan mbkm
                                        @else
                                            
                                        @if ($files->file_laporan)
                                            <a href="{{ $files->file_laporan->getUrl() }}" target="_blank">
                                                Download Format Laporan
                                            </a>
                                        @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    @foreach ($programs as $item)
                                        @php
                                            $colors = ['bg-info', 'bg-success', 'bg-warning', 'bg-danger', 'bg-indigo', 'bg-purple', 'bg-lime', 'bg-olive'];
                                            $randomIndex = array_rand($colors);
                                            $randomColor = $colors[$randomIndex];
                                        @endphp
                                        <div class="col-lg-3 col-xs-6">
                                            <!-- small box -->
                                            <div class="small-box {{ $randomColor }}">
                                                <div class="inner">
                                                    <h3>{{ $item->program_pengajuans_count ?? '0' }}</h3>

                                                    <p>{{ $item->nama_program }}</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="ion ion-pie-graph"></i>
                                                </div>
                                                <a href="{{ route('admin.home.details', $item->nama_program) }}"
                                                    class="small-box-footer">More info <i
                                                        class="fa fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.3.0/raphael.min.js"></script>
    <script src="{{ asset('js/morris.js') }}"></script>
    <script src="{{ asset('js/morris.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: '/admin/chart',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.length > 0) {
                        Morris.Donut({
                            element: 'chart-container',
                            data: data,
                            colors: ['#ffc107', '#007bff', '#dc3545'],
                            labelColor: '#ffffff'
                        });
                    } else {
                        $('#chart-container').text('Data tidak tersedia');
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(xhr.responseText);
                    // Tampilkan pesan jika tidak ada data yang diterima
                    $('#chart-container').html('Tidak ada data yang tersedia.');
                }
            });
            $.ajax({
                url: '/admin/chartbar',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.length === 0) {
                        $('#bar-chart-container').text('Tidak ada pengajuan');
                    } else {
                        var colors = ['#F0F8FF', '#00FFFF', '#7FFF00', '#DC143C', '#8FBC8F'];
                        Morris.Bar({
                            element: 'bar-chart-container',
                            data: data,
                            xkey: 'nama_program',
                            ykeys: ['count'],
                            labels: ['Pengajuan'],
                            barColors: function(row, series, type) {
                                return colors[row.x];
                            },
                            hideHover: 'auto',
                            resize: true,
                            yLabelFormat: function(y) {
                                return Math.round(y);
                            },
                        });
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(xhr.responseText);
                    // Tampilkan pesan jika tidak ada data yang diterima
                    $('#bar-chart-container').html('Tidak ada data yang tersedia.');
                }
            });
            $.ajax({
                url: '/admin/chartbarprodi',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.length === 0) {
                        $('#bar-chart-containerr').text('Tidak ada pengajuan');
                    } else {
                        var colors = ['#dc3545', '#FFC107', '#007BFF', '#01FF70', '#17A2B8'];
                        var chartData = [];
                        for (var i = 0; i < data.length; i++) {
                            chartData.push({
                                prodi: data[i].prodi,
                                jumlah_pengajuan: Math.round(data[i].jumlah_pengajuan)
                            });
                        }
                        new Morris.Bar({
                            element: 'bar-chart-containerr',
                            data: chartData,
                            xkey: 'prodi',
                            ykeys: ['jumlah_pengajuan'],
                            labels: ['Jumlah Pengajuan'],
                            barColors: function(row, series, type) {
                                return colors[row.x];
                            },
                            hideHover: 'auto',
                            resize: true,
                            yLabelFormat: function(y) {
                                return Math.round(y);
                            },
                        });
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(xhr.responseText);
                    // Tampilkan pesan jika tidak ada data yang diterima
                    $('#bar-chart-containerr').html('Tidak ada data yang tersedia.');
                }
            });
        });
    </script>
    <script>
        Dropzone.options.fileLaporanDropzone = {
            url: '{{ route('admin.files.storeMedia') }}',
            maxFilesize: 5, // MB
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 5
            },
            success: function(file, response) {
                $('form').find('input[name="file_laporan"]').remove()
                $('form').append('<input type="hidden" name="file_laporan" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="file_laporan"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($file) && $file->file_laporan)
                    var file = {!! json_encode($file->file_laporan) !!}
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="file_laporan" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>
    @parent
@endsection
