<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;

class ProgramsTableSeeder extends Seeder
{
    public function run()
    {
        $programs = [
            [
                'id'             => 1,
                'nama_program'   => 'Magang',
                'desc'           => 'Dapatkan pengalaman dunia kerja secara langsung sebagai persiapan kariermu.',
            ],
            [
                'id'             => 2,
                'nama_program'   => 'Studi Independen',
                'desc'           => 'Jalankan proyek penelitian dengan studi kasus nyata dari para pelaku industri ternama.',
            ],
            [
                'id'             => 3,
                'nama_program'   => 'Pertukaran Mahasiswa Merdeka',
                'desc'           => 'Program pertukaran mahasiswa dalam negeri  yang memberikan pengalaman langsung untuk lebih memaknai keberagaman budaya nusantara.',
            ],
            [
                'id'             => 4,
                'nama_program'   => 'Indonesian International Student Mobility Awards',
                'desc'           => 'Program pertukaran dengan universitas lain dari seluruh dunia untuk bertukar budaya.',
            ],
            [
                'id'             => 5,
                'nama_program'   => 'Praktisi Mengajar',
                'desc'           => 'Ruang kolaborasi antara Praktisi sebagai representasi industri dengan dosen Perguruan Tinggi dalam bentuk pengajaran mata kuliah agar mahasiswa lebih siap untuk masuk ke dunia kerja.',
            ],
        ];

        Program::insert($programs);
    }
}