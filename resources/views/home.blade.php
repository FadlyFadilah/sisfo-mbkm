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
                }
            });
            $.ajax({
                url: '/admin/chartbar',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
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
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(xhr.responseText);
                }
            });
            $.ajax({
                url: '/admin/chartbarprodi',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
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
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(xhr.responseText); 
                    // Tampilkan pesan jika tidak ada data yang diterima
                    $('#bar-chart-containerr').html('Tidak ada data yang tersedia.');
                }
            });
        });
    </script>
    @parent
@endsection
