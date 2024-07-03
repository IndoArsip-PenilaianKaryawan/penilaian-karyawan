<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KompetensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_kompetensi')->insert([
            [
                'id' => 1,
                'nama_kompetensi' => 'INTEGRITAS',
                'deskripsi' => 'jujur, bertanggung jawab dan dapat diandalkan',
            ],
            [
                'id' => 2,
                'nama_kompetensi' => 'KERJASAMA TIM',
                'deskripsi' => 'kooperatif, partisipatif, dan kontributif',
            ],
            [
                'id' => 3,
                'nama_kompetensi' => 'BERORIENTASI LAYANAN',
                'deskripsi' => 'memberikan solusi sesuai kebutuhan pelanggan',
            ],
            [
                'id' => 4,
                'nama_kompetensi' => 'KOMITMEN',
                'deskripsi' => 'Loyal, rajin, sadar biaya, tidak banyak mengeluh',
            ],
            [
                'id' => 5,
                'nama_kompetensi' => 'PERBAIKAN BERKELANJUTAN',
                'deskripsi' => 'semangat belajar dan berubah lebih baik',
            ],
            [
                'id' => 6,
                'nama_kompetensi' => 'INISIATIF',
                'deskripsi' => 'mampu melakukan tugas tanpa menunggu instruksi',
            ],
            [
                'id' => 7,
                'nama_kompetensi' => 'KUALITAS PEKERJAAN',
                'deskripsi' => 'akurat, efektif, efisien, dan tepat waktu',
            ],
            [
                'id' => 8,
                'nama_kompetensi' => 'KUANTITAS PEKERJAAN',
                'deskripsi' => 'volume pekerjaan yang diselesaikan',
            ],
            [
                'id' => 9,
                'nama_kompetensi' => 'KERAPIHAN PEKERJAAN',
                'deskripsi' => 'pekerjaan tertata rapi, terorganisir dengan baik',
            ],
            [
                'id' => 10,
                'nama_kompetensi' => 'PENGETAHUAN & KETERAMPILAN',
                'deskripsi' => 'pengetahuan dan keterampilan untuk melaksanakan pekerjaan',
            ],
        ]);
    }
}
