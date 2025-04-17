<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $data = [
            ['penjualan_id' => 1, 'kasir_id' => 3, 'pembeli_id' => 5, 'penjualan_kode' => 'PNJ001', 'penjualan_tanggal' => now()],
            ['penjualan_id' => 2, 'kasir_id' => 4, 'pembeli_id' => 6, 'penjualan_kode' => 'PNJ002', 'penjualan_tanggal' => now()],
            ['penjualan_id' => 3, 'kasir_id' => 3, 'pembeli_id' => 7, 'penjualan_kode' => 'PNJ003', 'penjualan_tanggal' => now()],
            ['penjualan_id' => 4, 'kasir_id' => 4, 'pembeli_id' => 6, 'penjualan_kode' => 'PNJ004', 'penjualan_tanggal' => now()],
            ['penjualan_id' => 5, 'kasir_id' => 4, 'pembeli_id' => 5, 'penjualan_kode' => 'PNJ005', 'penjualan_tanggal' => now()],
        ];
        DB::table('t_penjualan')->insert($data);
    }
}
