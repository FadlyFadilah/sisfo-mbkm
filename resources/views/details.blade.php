@extends('layouts.admin')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card bg-navy">
                    <div class="card-header">
                        Yang mengikuti Program Merdeka Belakar Kampus Merdeka Berdasarkan Prodi
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row">
                            @foreach ($prodis as $item)
                                @php
                                    $colors = ['bg-info', 'bg-success', 'bg-warning', 'bg-danger', 'bg-indigo', 'bg-purple', 'bg-lime', 'bg-olive'];
                                    $randomIndex = array_rand($colors);
                                    $randomColor = $colors[$randomIndex];
                                @endphp
                                <div class="col-lg-3 col-xs-6">
                                    <!-- small box -->
                                    <div class="small-box {{ $randomColor }}">
                                        <div class="inner">
                                            <h3>{{ $item->prodi_mahasiswas_count ?? '0' }}</h3>

                                            <p>{{ $item->nama_prodi }}</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-pie-graph"></i>
                                        </div>
                                        <a href="{{ route('admin.home.show', ['nama' => $nama, 'prodi' => $item->nama_prodi]) }}"
                                            class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
