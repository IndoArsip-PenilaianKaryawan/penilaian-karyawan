<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_periode')->insert([
            [
                'id' => 1,
                'nama_periode' => 'Semester 1',
                'tahun' => '2024',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
