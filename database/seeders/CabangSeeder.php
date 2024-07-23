<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CabangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_cabang')->insert([
            [
                'id' => 1,
                'nama' => 'BANDUNG',
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [
                'id' => 2,
                'nama' => 'MEDAN',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nama' => 'KARAWANG',
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [
                'id' => 4,
                'nama' => 'JAKARTA',
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [
                'id' => 5,
                'nama' => 'BEKASI',
                'created_at' => now(),
                'updated_at' => now(),

            ],
        ]);
    }
}
