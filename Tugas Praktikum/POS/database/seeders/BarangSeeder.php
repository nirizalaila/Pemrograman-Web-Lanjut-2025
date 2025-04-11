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
            ['kategori_id' => 1, 'barang_kode' => 'BRG001', 'barang_nama' => 'Spicy Ramen', 'harga_beli' => 30000, 'harga_jual' => 45000],
            ['kategori_id' => 1, 'barang_kode' => 'BRG002', 'barang_nama' => 'Dubai Chocolate', 'harga_beli' => 15000, 'harga_jual' => 25000],
            ['kategori_id' => 1, 'barang_kode' => 'BRG003', 'barang_nama' => 'Vanilla Latte', 'harga_beli' => 10000, 'harga_jual' => 18000],
            ['kategori_id' => 1, 'barang_kode' => 'BRG004', 'barang_nama' => 'Milk Coffee', 'harga_beli' => 50000, 'harga_jual' => 15000],
            ['kategori_id' => 2, 'barang_kode' => 'BRG005', 'barang_nama' => 'Body Lotion', 'harga_beli' => 20000, 'harga_jual' => 35000],
            ['kategori_id' => 2, 'barang_kode' => 'BRG006', 'barang_nama' => 'Lipstick', 'harga_beli' => 35000, 'harga_jual' => 50000],
            ['kategori_id' => 2, 'barang_kode' => 'BRG007', 'barang_nama' => 'Tootpaste', 'harga_beli' => 7000, 'harga_jual' => 15000],
            ['kategori_id' => 2, 'barang_kode' => 'BRG008', 'barang_nama' => 'Micellar Water', 'harga_beli' => 20000, 'harga_jual' => 40000],
            ['kategori_id' => 3, 'barang_kode' => 'BRG009', 'barang_nama' => 'Sapu', 'harga_beli' => 10000, 'harga_jual' => 25000],
            ['kategori_id' => 3, 'barang_kode' => 'BRG010', 'barang_nama' => 'Sabun', 'harga_beli' => 5000, 'harga_jual' => 15000],
            ['kategori_id' => 3, 'barang_kode' => 'BRG011', 'barang_nama' => 'Pewangi Ruangan', 'harga_beli' => 12000, 'harga_jual' => 20000],
            ['kategori_id' => 3, 'barang_kode' => 'BRG012', 'barang_nama' => 'Setrika', 'harga_beli' => 30000, 'harga_jual' => 50000],
            ['kategori_id' => 4, 'barang_kode' => 'BRG013', 'barang_nama' => 'Susu', 'harga_beli' => 30000, 'harga_jual' => 50000],
            ['kategori_id' => 4, 'barang_kode' => 'BRG014', 'barang_nama' => 'Pampers', 'harga_beli' => 40000, 'harga_jual' => 75000],
            ['kategori_id' => 4, 'barang_kode' => 'BRG015', 'barang_nama' => 'Tas Sekolah', 'harga_beli' =>60000, 'harga_jual' => 100000],
            ['kategori_id' => 4, 'barang_kode' => 'BRG016', 'barang_nama' => 'Mainan', 'harga_beli' => 20000, 'harga_jual' => 40000],
        ];
        DB::table('m_barang')->insert($data);
    }
}
