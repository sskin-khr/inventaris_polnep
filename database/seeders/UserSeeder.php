<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Admin POLNEP',
            'email'    => 'admin@polnep.ac.id',
            'password' => Hash::make('password123'),
            'role'     => 'admin',
        ]);

        User::create([
            'name'     => 'Staf POLNEP',
            'email'    => 'staf@polnep.ac.id',
            'password' => Hash::make('password123'),
            'role'     => 'user',
        ]);
    }
}