@extends('layouts.admin')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
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
                            @foreach ($programs as $item)
                                @php
                                    $colors = ['bg-info', 'bg-success', 'bg-warning', 'bg-danger', 'bg-indigo', 'bg-navy', 'bg-purple', 'bg-fuchsia', 'bg-pink', 'bg-lime', 'bg-teal', 'bg-olive'];
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
                                        <a href="{{ route('admin.home.details', $item->id) }}" class="small-box-footer">More info <i
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
@endsection
@section('scripts')
    @parent
@endsection
