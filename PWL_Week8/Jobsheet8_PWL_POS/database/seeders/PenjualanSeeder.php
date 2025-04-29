<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();
        $penjualan = [
            [
                'penjualan_id' => 1,
                'pembeli' => $faker->name(),
                'penjualan_kode' => 'PNJ001',
                'penjualan_tanggal' => now(),
                'user_id' => 3,
                'barang_id' => 1,
            ],
            [
                'penjualan_id' => 2,
                'pembeli' => $faker->name(),
                'penjualan_kode' => 'PNJ002',
                'penjualan_tanggal' => now(),
                'user_id' => 2,
                'barang_id' => 2,
            ],
            [
                'penjualan_id' => 3,
                'pembeli' => $faker->name(),
                'penjualan_kode' => 'PNJ003',
                'penjualan_tanggal' => now(),
                'user_id' => 3,
                'barang_id' => 5,
            ],
            [
                'penjualan_id' => 4,
                'pembeli' => $faker->name(),
                'penjualan_kode' => 'PNJ004',
                'penjualan_tanggal' => now(),
                'user_id' => 1,
                'barang_id' => 7,
            ],
            [
                'penjualan_id' => 5,
                'pembeli' => $faker->name(),
                'penjualan_kode' => 'PNJ005',
                'penjualan_tanggal' => now(),
                'user_id' => 3,
                'barang_id' => 9,
            ],
        ];

        DB::table('t_penjualan')->insert($penjualan);
    }
}
