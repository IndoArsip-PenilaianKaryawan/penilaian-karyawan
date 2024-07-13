<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
                'password' => Hash::make('12345678') ,
                'id_bidang' => NULL,
                'id_jabatan' => 1,  // ceo
                'id_atasan' => NULL,
                'id_approval_1' => NULL,
                'id_approval_2' => NULL,
                'is_penilai' => true,
            ],
            [
                'id' => 2,
                'nama' => 'Budi',
                'no_pegawai' => '12345679',
                'password' => Hash::make('12345679'),
                'id_bidang' => 3210101,  // IT
                'id_jabatan' => 2,  // direktur
                'id_atasan' => 1,  // Aditya
                'id_approval_1' => 1,  // Aditya
                'id_approval_2' => 1,  // Aditya
                'is_penilai' => true,
            ],
            [
                'id' => 3,
                'nama' => 'Citra',
                'no_pegawai' => '12345680',
                'password' => Hash::make('12345680'),
                'id_bidang' => 3210101,  // IT
                'id_jabatan' => 3,  // manager
                'id_atasan' => 2,  // Budi
                'id_approval_1' => 2,  // Budi
                'id_approval_2' => 1,  // Aditya
                'is_penilai' => true,
            ],
            [
                'id' => 4,
                'nama' => 'Dewi',
                'no_pegawai' => '12345681',
                'password' => Hash::make('12345681'),
                'id_bidang' => 3210101,  // IT
                'id_jabatan' => 4,  // kepala bagian
                'id_atasan' => 3,  // Citra
                'id_approval_1' => 3,  // Citra
                'id_approval_2' => 2,  // Budi
                'is_penilai' => true,
            ],
            [
                'id' => 5,
                'nama' => 'Eka',
                'no_pegawai' => '12345682',
                'password' => NULL,
                'id_bidang' => 3210101,  // IT
                'id_jabatan' => 5,  // karyawan
                'id_atasan' => 4,  // Dewi
                'id_approval_1' => 4,  // Dewi
                'id_approval_2' => 3,  // Citra
                'is_penilai' => false,
            ],
            [
                'id' => 6,
                'nama' => 'Fajar',
                'no_pegawai' => '12345683',
                'password' => Hash::make('12345683'),
                'id_bidang' => 3210201,  // HRD
                'id_jabatan' => 2,  // direktur
                'id_atasan' => 1,  // Aditya
                'id_approval_1' => 1,  // Aditya
                'id_approval_2' => 1,  // Aditya
                'is_penilai' => true,
            ],
            [
                'id' => 7,
                'nama' => 'Gita',
                'no_pegawai' => '12345684',
                'password' => Hash::make('12345684'),
                'id_bidang' => 3210201,  // HRD
                'id_jabatan' => 3,  // manager
                'id_atasan' => 6,  // Fajar
                'id_approval_1' => 6,  // Fajar
                'id_approval_2' => 1,  // Aditya
                'is_penilai' => true,
            ],    
        ]);
    }
}
