<?php

namespace Database\Seeders;

use App\Models\Prodi;
use Illuminate\Database\Seeder;

class ProdisTableSeeder extends Seeder
{
    public function run()
    {
        $prodis = [
            [
                'id'    => 1,
                'nama_prodi' => 'Alat Berat',
            ],
            [
                'id'    => 2,
                'nama_prodi' => 'Teknik Komputer ( B )',
            ],
            [
                'id'    => 3,
                'nama_prodi' => 'Teknik Mesin',
            ],
            [
                'id'    => 4,
                'nama_prodi' => 'Mekanik Otomotif ( B )',
            ],
            [
                'id'    => 5,
                'nama_prodi' => 'Akuntansi',
            ],
            [
                'id'    => 6,
                'nama_prodi' => 'Teknik Elektronika ( B )',
            ],
            [
                'id'    => 7,
                'nama_prodi' => 'Teknik Kimia (Industri)',
            ],
            [
                'id'    => 8,
                'nama_prodi' => 'Rekam Medik dan Informasi Kesehatan',
            ],
            [
                'id'    => 9,
                'nama_prodi' => 'Konstruksi Bangunan (Teknik Sipil)',
            ],
            [
                'id'    => 10,
                'nama_prodi' => 'Teknik Informatika',
            ],
            [
                'id'    => 11,
                'nama_prodi' => 'Komputerisasi Akutansi ( B )',
            ],
            [
                'id'    => 12,
                'nama_prodi' => 'Mekanik Industri dan Desain (Teknik Mesin) ( B )',
            ],
            [
                'id'    => 13,
                'nama_prodi' => 'Teknik Otomasi Industri ( B )',
            ],
            [
                'id'    => 14,
                'nama_prodi' => 'Mekatronik',
            ]
        ];

        Prodi::insert($prodis);
    }
}