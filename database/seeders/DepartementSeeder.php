<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_departement')->insert([
            [
                'id' => 32101,
                'nama_departement' => 'INFORMATION TECHNOLOGY',
            ],
            [
                'id' => 32102,
                'nama_departement' => 'HUMAN RESOURCES & GENERAL AFFAIRS',
            ],
            [
                'id' => 32103,
                'nama_departement' => 'CONVENTIONAL ARCHIVE',
            ],
            [
                'id' => 32104,
                'nama_departement' => 'ELECTRONIC ARCHIVE',
            ],
            [
                'id' => 32105,
                'nama_departement' => 'FINANCE & ACCOUNTING',
            ],
            [
                'id' => 32106,
                'nama_departement' => 'INTERNAL AUDIT',
            ],
            [
                'id' => 32107,
                'nama_departement' => 'OFFICE STRATEGIC MANAGEMENT',
            ],
            [
                'id' => 32108,
                'nama_departement' => 'REPOSITORY',
            ],
        ]);
    }
}
