<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StokSeeder extends Seeder
{
    public function run(): void
    {
        $stok = [
            ['barang_id' => 1, 'user_id' => 1, 'stok_tanggal' => now(), 'jumlah' => 50],
            ['barang_id' => 2, 'user_id' => 1, 'stok_tanggal' => now(), 'jumlah' => 40],
            ['barang_id' => 3, 'user_id' => 1, 'stok_tanggal' => now(), 'jumlah' => 30],
            ['barang_id' => 4, 'user_id' => 2, 'stok_tanggal' => now(), 'jumlah' => 20],
            ['barang_id' => 5, 'user_id' => 2, 'stok_tanggal' => now(), 'jumlah' => 20],
            ['barang_id' => 6, 'user_id' => 2, 'stok_tanggal' => now(), 'jumlah' => 15],
            ['barang_id' => 7, 'user_id' => 3, 'stok_tanggal' => now(), 'jumlah' => 10],
            ['barang_id' => 8, 'user_id' => 3, 'stok_tanggal' => now(), 'jumlah' => 12],
            ['barang_id' => 9, 'user_id' => 3, 'stok_tanggal' => now(), 'jumlah' => 18],
            ['barang_id' => 10, 'user_id' => 1, 'stok_tanggal' => now(), 'jumlah' => 20],
            ['barang_id' => 11, 'user_id' => 2, 'stok_tanggal' => now(), 'jumlah' => 25],
            ['barang_id' => 12, 'user_id' => 3, 'stok_tanggal' => now(), 'jumlah' => 30],
        ];

        DB::table('t_stok')->insert($stok);
    }
}
