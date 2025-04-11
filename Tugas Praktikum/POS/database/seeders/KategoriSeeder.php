<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['kategori_kode' => 'FNB', 'kategori_nama' => 'Food Beverage'],
            ['kategori_kode' => 'BNH', 'kategori_nama' => 'Beauty Health'],
            ['kategori_kode' => 'HNC', 'kategori_nama' => 'Home Care'],
            ['kategori_kode' => 'BNK', 'kategori_nama' => 'Baby Kid'],
        ];
        DB::table('m_kategori')->insert($data);
    }
}
