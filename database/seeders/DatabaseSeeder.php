<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Mario',
            'email' => 'mario@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('prueba123'),
        ]);
        Company::insert([
            ['nombre' => 'Steam'],
            ['nombre' => 'Xbox'],
            ['nombre' => 'Playstation'],
            ['nombre' => 'Nintendo'],
        ]);
         
    }
}
