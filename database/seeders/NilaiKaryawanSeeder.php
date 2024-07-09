<?php

namespace Database\Seeders;

use App\Models\M_nilai;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NilaiKaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        M_nilai::create([
            'id_karyawan' => 1,
            'indeks' => [3, 4, 5, 6, 7, 8, 9, 10, 11],
            'status_approval_1' => 'Pending',
            'status_approval_2' => 'Pending',
            'id_periode' => 1,
        ]);
    }
}
