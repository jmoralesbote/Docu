<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         /* \App\Models\User::factory()->create([
             'user_nombre' => 'Test User',
             'email' => 'test@example.com',
             'password' => '123456789',
         ]); */

         $this->call([
            TiposDocSeeder::class,
            UsuariosSeeder::class,
            // Puedes agregar más seeders aquí
         ]);
    }
}
