<?php

return [
    'userManagement' => [
        'title'          => 'Manajemen User',
        'title_singular' => 'Manajemen User',
    ],
    'permission' => [
        'title'          => 'Izin',
        'title_singular' => 'Izin',
        'fields'         => [
            'id'                => 'No',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'Peranan',
        'title_singular' => 'Peranan',
        'fields'         => [
            'id'                 => 'No',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'Daftar Pengguna',
        'title_singular' => 'User',
        'fields'         => [
            'id'                       => 'No',
            'id_helper'                => ' ',
            'name'                     => 'Name',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
            'roles'                    => 'Roles',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
        ],
    ],
    'prodi' => [
        'title'          => 'Program Studi',
        'title_singular' => 'Program Studi',
        'fields'         => [
            'id'                => 'No',
            'id_helper'         => ' ',
            'nama_prodi'        => 'Nama Program Studi',
            'nama_prodi_helper' => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'periode' => [
        'title'          => 'Tahun Periode',
        'title_singular' => 'Tahun Periode',
        'fields'         => [
            'id'                   => 'No',
            'id_helper'            => ' ',
            'tahun_periode'        => 'Tahun Periode',
            'tahun_periode_helper' => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
        ],
    ],
    'program' => [
        'title'          => 'Program',
        'title_singular' => 'Program',
        'fields'         => [
            'id'                  => 'No',
            'id_helper'           => ' ',
            'nama_program'        => 'Nama Program',
            'nama_program_helper' => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
        ],
    ],
    'dataMahasiswaMbkm' => [
        'title'          => 'Data Mahasiswa Mbkm',
        'title_singular' => 'Data Mahasiswa Mbkm',
    ],
    'mahasiswa' => [
        'title'          => 'Mahasiswa',
        'title_singular' => 'Mahasiswa',
        'fields'         => [
            'id'                   => 'No',
            'id_helper'            => ' ',
            'user'                 => 'User',
            'user_helper'          => ' ',
            'nama_lengkap'         => 'Nama Lengkap',
            'nama_lengkap_helper'  => ' ',
            'nim'                  => 'NIM',
            'nim_helper'           => ' ',
            'prodi'                => 'Program Studi',
            'prodi_helper'         => ' ',
            'jenis_kelamin'        => 'Jenis Kelamin',
            'jenis_kelamin_helper' => ' ',
            'tanggal_lahir'        => 'Tanggal Lahir',
            'tanggal_lahir_helper' => ' ',
            'periode'              => 'Tahun Periode',
            'periode_helper'       => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
        ],
    ],
    'pengajuan' => [
        'title'          => 'Pengajuan',
        'title_singular' => 'Pengajuan',
        'fields'         => [
            'id'                => 'No',
            'id_helper'         => ' ',
            'mahasiswa'         => 'Mahasiswa',
            'mahasiswa_helper'  => ' ',
            'program'           => 'Program',
            'program_helper'    => ' ',
            'semester'          => 'Semester',
            'semester_helper'   => ' ',
            'no_hp'             => 'No Hp',
            'no_hp_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'laporan' => [
        'title'          => 'Laporan',
        'title_singular' => 'Laporan',
        'fields'         => [
            'id'                => 'No',
            'id_helper'         => ' ',
            'pengajuan'         => 'Pengajuan',
            'pengajuan_helper'  => ' ',
            'laporan'           => 'Laporan MBKM',
            'laporan_helper'    => ' ',
            'sertifikat'        => 'Sertifikat Program',
            'sertifikat_helper' => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'rekapitulasiData' => [
        'title'          => 'Rekapitulasi Data',
        'title_singular' => 'Rekapitulasi Data',
    ],

];