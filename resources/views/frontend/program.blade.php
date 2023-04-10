@extends('layouts.frontend')

@section('content')
    <div class="container h-auto">
        <div class="row">
            @foreach ($programs as $item)
                @php
                    $colors = ['bg-info', 'bg-success', 'bg-warning', 'bg-danger', 'bg-indigo', 'bg-purple', 'bg-lime', 'bg-olive'];
                    $randomIndex = array_rand($colors);
                    $randomColor = $colors[$randomIndex];
                @endphp
                <div class="col-md-4">
                    <div class="card text-white {{ $randomColor }}">
                        <div class="card-body">
                            <h5>{{ $item->nama_program }}</h5>
                            <p>{{ $item->desc }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
