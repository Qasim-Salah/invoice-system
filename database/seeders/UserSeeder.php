<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create(['name' => 'Qasim Salah',
            'email' => 'Qasim@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('Qasim Salah'), // password
            'remember_token' => Str::random(10),
            'status' => 1,
            'role_id' => 1
        ]);

        User::create(['name' => 'QasimSalah',
            'email' => 'QasimS@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('QasimSalah'), // password
            'remember_token' => Str::random(10),
            'status' => 1,
            'role_id' => 2
        ]);
    }
}
