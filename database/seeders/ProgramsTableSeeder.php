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
            ],
            [
                'id'             => 2,
                'nama_program'   => 'Studi Independen',
            ],
            [
                'id'             => 3,
                'nama_program'   => 'Pertukaran Mahasiswa Merdeka',
            ],
            [
                'id'             => 4,
                'nama_program'   => 'Indonesian International Student Mobility Awards',
            ],
            [
                'id'             => 5,
                'nama_program'   => 'Praktisi Mengajar',
            ],
        ];

        Program::insert($programs);
    }
}