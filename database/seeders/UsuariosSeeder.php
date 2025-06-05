<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'user_nombre'   => 'Alexis',
            'user_paterno'  => 'Morales',
            'user_materno'  => 'Bote',
            'username'      => 'jamb',
            'email'         => 'alexis@gmail.com',
            'password'      => Hash::make('123456789'),
        ]);
    }
}
