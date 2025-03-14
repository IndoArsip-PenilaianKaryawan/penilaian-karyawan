<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_admin')->insert([
            [
                'id' => 1,
                'username' => 'admin',
                'password' => Hash::make('12345678'),
                'name' => 'Admin',
            ],
        ]);
    }
}
