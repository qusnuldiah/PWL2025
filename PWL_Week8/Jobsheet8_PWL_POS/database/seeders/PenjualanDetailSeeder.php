<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetailSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['penjualan_id' => 1, 'barang_id' => 1, 'harga' => 3000, 'jumlah' => 2],
            ['penjualan_id' => 1, 'barang_id' => 3, 'harga' => 6000, 'jumlah' => 1],
            ['penjualan_id' => 2, 'barang_id' => 5, 'harga' => 8000, 'jumlah' => 1],
            ['penjualan_id' => 2, 'barang_id' => 2, 'harga' => 4000, 'jumlah' => 3],
            ['penjualan_id' => 3, 'barang_id' => 9, 'harga' => 4000, 'jumlah' => 2],
            ['penjualan_id' => 3, 'barang_id' => 7, 'harga' => 12000, 'jumlah' => 1],
            ['penjualan_id' => 4, 'barang_id' => 4, 'harga' => 5000, 'jumlah' => 2],
            ['penjualan_id' => 5, 'barang_id' => 11, 'harga' => 10000, 'jumlah' => 1],
            ['penjualan_id' => 5, 'barang_id' => 12, 'harga' => 5000, 'jumlah' => 2],
        ];

        DB::table('t_penjualan_detail')->insert($data);
    }
}
