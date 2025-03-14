<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['kategori_id' => 1, 'barang_kode' => 'BRG001', 'barang_nama' => 'Laptop', 'harga_beli' => 7000000, 'harga_jual' => 8000000],
            ['kategori_id' => 1, 'barang_kode' => 'BRG002', 'barang_nama' => 'Smartphone', 'harga_beli' => 4000000, 'harga_jual' => 4500000],
            ['kategori_id' => 2, 'barang_kode' => 'BRG003', 'barang_nama' => 'Jaket Kulit', 'harga_beli' => 500000, 'harga_jual' => 600000],
            ['kategori_id' => 2, 'barang_kode' => 'BRG004', 'barang_nama' => 'Kaos Polos', 'harga_beli' => 50000, 'harga_jual' => 75000],
            ['kategori_id' => 3, 'barang_kode' => 'BRG005', 'barang_nama' => 'Roti Manis', 'harga_beli' => 10000, 'harga_jual' => 15000],
            ['kategori_id' => 3, 'barang_kode' => 'BRG006', 'barang_nama' => 'Mie Instan', 'harga_beli' => 2500, 'harga_jual' => 3500],
            ['kategori_id' => 4, 'barang_kode' => 'BRG007', 'barang_nama' => 'Blender', 'harga_beli' => 200000, 'harga_jual' => 250000],
            ['kategori_id' => 4, 'barang_kode' => 'BRG008', 'barang_nama' => 'Setrika', 'harga_beli' => 150000, 'harga_jual' => 200000],
            ['kategori_id' => 5, 'barang_kode' => 'BRG009', 'barang_nama' => 'Topi Baseball', 'harga_beli' => 75000, 'harga_jual' => 100000],
            ['kategori_id' => 5, 'barang_kode' => 'BRG010', 'barang_nama' => 'Jam Tangan', 'harga_beli' => 300000, 'harga_jual' => 400000],
        ];
        DB::table('m_barang')->insert($data);
    }
}
