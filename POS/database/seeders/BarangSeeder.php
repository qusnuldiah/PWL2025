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
            ['barang_id' => 1, 'kategori_id' => 1, 'supplier_id' => 1, 'barang_kode' => 'BRG001', 'barang_nama' => 'Aqua 600ml', 'harga_beli' => 2000, 'harga_jual' => 3000],
            ['barang_id' => 2, 'kategori_id' => 1, 'supplier_id' => 1, 'barang_kode' => 'BRG002', 'barang_nama' => 'Teh Botol', 'harga_beli' => 2500, 'harga_jual' => 4000],
            ['barang_id' => 3, 'kategori_id' => 1, 'supplier_id' => 1, 'barang_kode' => 'BRG003', 'barang_nama' => 'Susu Kotak', 'harga_beli' => 4000, 'harga_jual' => 6000],

            ['barang_id' => 4, 'kategori_id' => 2, 'supplier_id' => 2, 'barang_kode' => 'BRG004', 'barang_nama' => 'Sabun Mandi', 'harga_beli' => 3000, 'harga_jual' => 5000],
            ['barang_id' => 5, 'kategori_id' => 2, 'supplier_id' => 2, 'barang_kode' => 'BRG005', 'barang_nama' => 'Shampoo', 'harga_beli' => 6000, 'harga_jual' => 8000],
            ['barang_id' => 6, 'kategori_id' => 2, 'supplier_id' => 2, 'barang_kode' => 'BRG006', 'barang_nama' => 'Hand Sanitizer', 'harga_beli' => 5000, 'harga_jual' => 7000],

            ['barang_id' => 7, 'kategori_id' => 3, 'supplier_id' => 3, 'barang_kode' => 'BRG007', 'barang_nama' => 'Pel Lantai', 'harga_beli' => 8000, 'harga_jual' => 12000],
            ['barang_id' => 8, 'kategori_id' => 3, 'supplier_id' => 3, 'barang_kode' => 'BRG008', 'barang_nama' => 'Sabun Cuci', 'harga_beli' => 7000, 'harga_jual' => 10000],
            ['barang_id' => 9, 'kategori_id' => 3, 'supplier_id' => 3, 'barang_kode' => 'BRG009', 'barang_nama' => 'Tisu Basah', 'harga_beli' => 2000, 'harga_jual' => 4000],

            ['barang_id' => 10, 'kategori_id' => 4, 'supplier_id' => 4, 'barang_kode' => 'BRG010', 'barang_nama' => 'Popok Bayi', 'harga_beli' => 15000, 'harga_jual' => 20000],
            ['barang_id' => 11, 'kategori_id' => 4, 'supplier_id' => 4, 'barang_kode' => 'BRG011', 'barang_nama' => 'Minyak Telon', 'harga_beli' => 7000, 'harga_jual' => 10000],
            ['barang_id' => 12, 'kategori_id' => 4, 'supplier_id' => 4, 'barang_kode' => 'BRG012', 'barang_nama' => 'Bedak Bayi', 'harga_beli' => 3000, 'harga_jual' => 5000],
        ];
        DB::table('m_barang')->insert($data);
    }
}
