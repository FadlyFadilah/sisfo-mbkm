@extends('layouts.frontend')

@section('content')
    <div class="container h-auto">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card text-white bg-olive">
                        <div class="card-header">{{ __('Dashboard') }}</div>
    
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
    
                            SELAMAT DATANG DI SISTEM INFORMASI MERDEKA BELAJAR KAMPUS MERDEKA POLITEKNIK TEDC
                        </div>
                        <div class="card-body">
                            Langkah - Langkah Penggunaan </br>
                            1. Klik Menu di kanan atas </br>
                            2. Isi menu Mahasiswa </br>
                            3. Lalu kalian bisa mengajukan surat rekomendasi </br>
                            4. Jika sudah melakukan kegiatan MBKM kalian bisa mengupload laporan dan sertifikat di menu laporan </br>
    
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </div>
@endsection
