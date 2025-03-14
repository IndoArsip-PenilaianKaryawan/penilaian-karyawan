<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use NilaiSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            AdminSeeder::class,
            PeriodeSeeder::class,
            JabatanSeeder::class,
            KompetensiSeeder::class,
            DepartementSeeder::class,
            BidangSeeder::class,
            CabangSeeder::class,
            KaryawanSeeder::class,
            NilaiKaryawanSeeder::class,

        ]);
    }
}
