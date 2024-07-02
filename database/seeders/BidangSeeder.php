<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BidangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_bidang')->insert([
            [
                'id' => 3210101,
                'nama_bidang' => 'IT Development',
                'id_departement' => 32101, // INFORMATION TECHNOLOGY
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3210201,
                'nama_bidang' => 'HR Management',
                'id_departement' => 32102, // HUMAN RESOURCES & GENERAL AFFAIRS
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3210301,
                'nama_bidang' => 'Archive Management',
                'id_departement' => 32103, // CONVENTIONAL ARCHIVE
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3210401,
                'nama_bidang' => 'E-Archive Management',
                'id_departement' => 32104, // ELECTRONIC ARCHIVE
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3210501,
                'nama_bidang' => 'Financial Reporting',
                'id_departement' => 32105, // FINANCE & ACCOUNTING
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3210601,
                'nama_bidang' => 'Audit and Compliance',
                'id_departement' => 32106, // INTERNAL AUDIT
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3210701,
                'nama_bidang' => 'Strategic Planning',
                'id_departement' => 32107, // OFFICE STRATEGIC MANAGEMENT
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3210801,
                'nama_bidang' => 'Repository Management',
                'id_departement' => 32108, // REPOSITORY
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
