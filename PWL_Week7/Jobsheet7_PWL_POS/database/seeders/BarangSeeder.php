<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $data = [
            ['barang_id' => 1, 'kategori_id' => 1, 'barang_kode' => 'TV001', 'barang_nama' => 'Televisi', 'harga_beli' => 2000000, 'harga_jual' => 2500000],
            ['barang_id' => 2, 'kategori_id' => 1, 'barang_kode' => 'HP001', 'barang_nama' => 'Handphone', 'harga_beli' => 3000000, 'harga_jual' => 3500000],
            ['barang_id' => 3, 'kategori_id' => 2, 'barang_kode' => 'SW001', 'barang_nama' => 'Sweater', 'harga_beli' => 150000, 'harga_jual' => 200000],
            ['barang_id' => 4, 'kategori_id' => 2, 'barang_kode' => 'JNS001', 'barang_nama' => 'Jeans', 'harga_beli' => 200000, 'harga_jual' => 250000],
            ['barang_id' => 5, 'kategori_id' => 3, 'barang_kode' => 'MSG001', 'barang_nama' => 'Mie Instan', 'harga_beli' => 2500, 'harga_jual' => 3500],
            ['barang_id' => 6, 'kategori_id' => 3, 'barang_kode' => 'SUS001', 'barang_nama' => 'Susu Kotak', 'harga_beli' => 5000, 'harga_jual' => 7000],
            ['barang_id' => 7, 'kategori_id' => 4, 'barang_kode' => 'PEN001', 'barang_nama' => 'Pulpen', 'harga_beli' => 2000, 'harga_jual' => 4000],
            ['barang_id' => 8, 'kategori_id' => 4, 'barang_kode' => 'BKU001', 'barang_nama' => 'Buku Tulis', 'harga_beli' => 5000, 'harga_jual' => 8000],
            ['barang_id' => 9, 'kategori_id' => 5, 'barang_kode' => 'BOL001', 'barang_nama' => 'Bola Sepak', 'harga_beli' => 100000, 'harga_jual' => 150000],
            ['barang_id' => 10, 'kategori_id' => 5, 'barang_kode' => 'RKT001', 'barang_nama' => 'Raket Badminton', 'harga_beli' => 150000, 'harga_jual' => 200000],
        ];
        DB::table('m_barang')->insert($data);
    }
}
