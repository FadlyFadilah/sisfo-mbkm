<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'prodi_create',
            ],
            [
                'id'    => 18,
                'title' => 'prodi_edit',
            ],
            [
                'id'    => 19,
                'title' => 'prodi_show',
            ],
            [
                'id'    => 20,
                'title' => 'prodi_delete',
            ],
            [
                'id'    => 21,
                'title' => 'prodi_access',
            ],
            [
                'id'    => 22,
                'title' => 'periode_create',
            ],
            [
                'id'    => 23,
                'title' => 'periode_edit',
            ],
            [
                'id'    => 24,
                'title' => 'periode_show',
            ],
            [
                'id'    => 25,
                'title' => 'periode_delete',
            ],
            [
                'id'    => 26,
                'title' => 'periode_access',
            ],
            [
                'id'    => 27,
                'title' => 'program_create',
            ],
            [
                'id'    => 28,
                'title' => 'program_edit',
            ],
            [
                'id'    => 29,
                'title' => 'program_show',
            ],
            [
                'id'    => 30,
                'title' => 'program_delete',
            ],
            [
                'id'    => 31,
                'title' => 'program_access',
            ],
            [
                'id'    => 32,
                'title' => 'data_mahasiswa_mbkm_access',
            ],
            [
                'id'    => 33,
                'title' => 'mahasiswa_create',
            ],
            [
                'id'    => 34,
                'title' => 'mahasiswa_edit',
            ],
            [
                'id'    => 35,
                'title' => 'mahasiswa_show',
            ],
            [
                'id'    => 36,
                'title' => 'mahasiswa_delete',
            ],
            [
                'id'    => 37,
                'title' => 'mahasiswa_access',
            ],
            [
                'id'    => 38,
                'title' => 'pengajuan_create',
            ],
            [
                'id'    => 39,
                'title' => 'pengajuan_edit',
            ],
            [
                'id'    => 40,
                'title' => 'pengajuan_show',
            ],
            [
                'id'    => 41,
                'title' => 'pengajuan_delete',
            ],
            [
                'id'    => 42,
                'title' => 'pengajuan_access',
            ],
            [
                'id'    => 43,
                'title' => 'laporan_create',
            ],
            [
                'id'    => 44,
                'title' => 'laporan_edit',
            ],
            [
                'id'    => 45,
                'title' => 'laporan_show',
            ],
            [
                'id'    => 46,
                'title' => 'laporan_delete',
            ],
            [
                'id'    => 47,
                'title' => 'laporan_access',
            ],
            [
                'id'    => 48,
                'title' => 'rekapitulasi_data_create',
            ],
            [
                'id'    => 49,
                'title' => 'rekapitulasi_data_edit',
            ],
            [
                'id'    => 50,
                'title' => 'rekapitulasi_data_show',
            ],
            [
                'id'    => 51,
                'title' => 'rekapitulasi_data_delete',
            ],
            [
                'id'    => 52,
                'title' => 'rekapitulasi_data_access',
            ],
            [
                'id'    => 53,
                'title' => 'file_create',
            ],
            [
                'id'    => 54,
                'title' => 'file_edit',
            ],
            [
                'id'    => 55,
                'title' => 'file_show',
            ],
            [
                'id'    => 56,
                'title' => 'file_delete',
            ],
            [
                'id'    => 57,
                'title' => 'file_access',
            ],
            [
                'id'    => 58,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}