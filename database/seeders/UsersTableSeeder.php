<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'username'       => 'admin',
                'password'       => bcrypt('password'),
            ],
        ];

        User::insert($users);
    }
}