<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                'password' => '123345678',
                'name' => 'Admin',
            ],
        ]);
    }
}
