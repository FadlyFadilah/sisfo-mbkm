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
                'nama_prodi' => 'Teknik Komputer',
            ],
            [
                'id'    => 2,
                'nama_prodi' => 'Teknik Mesin',
            ],
            [
                'id'    => 3,
                'nama_prodi' => 'Mesin Otomotif',
            ],
            [
                'id'    => 4,
                'nama_prodi' => 'Akuntansi',
            ],
            [
                'id'    => 5,
                'nama_prodi' => 'Teknik Elektronika',
            ],
            [
                'id'    => 6,
                'nama_prodi' => 'Teknik Kimia',
            ],
            [
                'id'    => 7,
                'nama_prodi' => 'Rekam Medik dan Informasi Kesehatan',
            ],
            [
                'id'    => 8,
                'nama_prodi' => 'Konstruksi Bangunan',
            ],
            [
                'id'    => 9,
                'nama_prodi' => 'Teknik Informatika',
            ],
            [
                'id'    => 10,
                'nama_prodi' => 'Komputerisasi Akutansi',
            ],
            [
                'id'    => 11,
                'nama_prodi' => 'Mekanik Industri dan Desain',
            ],
            [
                'id'    => 12,
                'nama_prodi' => 'Teknik Otomasi',
            ],
        ];

        Prodi::insert($prodis);
    }
}