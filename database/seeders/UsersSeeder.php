<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_users')->insert([
            [
                'id' => 1, // CEO
                'username' => 'Hilmi',
                'password' => '12345678',
                'name' => 'Hilmi A',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2, // Direktur
                'username' => 'Asyarani',
                'password' => '12345678',
                'name' => 'Asyarani',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3, // Manager
                'username' => 'Budi',
                'password' => '12345678',
                'name' => 'Budiono Siregar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4, // Kepala Bagian
                'username' => 'Doni',
                'password' => '12345678',
                'name' => 'Doni Salman',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
