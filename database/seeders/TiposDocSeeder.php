<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposDocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cat_tipos_documentos')->insert([
            ['nombre' => 'Contrato'],
            ['nombre' => 'Factura'],
            ['nombre' => 'Recibo'],
            ['nombre' => 'Oficio'],
            // Agrega más tipos según tus necesidades
        ]);
    }
}
