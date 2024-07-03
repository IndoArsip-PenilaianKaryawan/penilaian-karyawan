<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_karyawan')->insert([
            [
                'id' => 1,
                'nama' => 'Aditya',
                'no_pegawai' => '12345678',
                'id_bidang' => 3210101,
                'id_atasan' => 4,
                'id_jabatan' => 3,
                'id_approval_1' => 3,
                'id_approval_2' => 2,
            ],
        ]);
    }
}
