<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        for ($i = 1; $i <= 16; $i++) {
            $data[] = [
                'barang_id' => $i,
                'user_id' => rand(1, 3), // User ID dari Admin/Manager/Staff
                'stok_tanggal' => now(),
                'stok_jumlah' => rand(5, 50),
            ];
        }
        DB::table('t_stok')->insert($data);
    }
}
