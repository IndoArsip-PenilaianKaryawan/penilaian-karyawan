<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_jabatan')->insert([
            [
                'id' => 1,
                'nama_jabatan' => 'CEO',
            ],
            [
                'id' => 2,
                'nama_jabatan' => 'Direktur',
            ],
            [
                'id' => 3,
                'nama_jabatan' => 'Manager',
            ],
            [
                'id' => 4,
                'nama_jabatan' => 'Kepala Bagian',
            ],
            [
                'id' => 5,
                'nama_jabatan' => 'Karyawan',
            ],
        ]);
    }
}
