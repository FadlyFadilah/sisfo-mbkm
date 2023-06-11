@extends('layouts.frontend')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/morris.css') }}">
@endsection
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card bg-navy">
                    <div class="card-header">
                        Dashboard
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
                                    <div class="card-body">
                                        <div id="chart-container"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                            <div class="col-md-12">
                                <div class="card bg-navy">
                                    <div class="card-header">
                                        Jumlah Mahasiswa yang mengikuti per-Program
                                    </div>
                                    <div class="card-body">
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
                url: '/chart',
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
        });
    </script>
    @parent
@endsection
