<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $data = [
            ['level_kode' => 'LV001', 'level_nama' => 'Owner'],
            ['level_kode' => 'LV002', 'level_nama' => 'Admin'],
            ['level_kode' => 'LV003', 'level_nama' => 'Kasir'],
            ['level_kode' => 'LV004', 'level_nama' => 'Pelanggan'],
        ];
        DB::table('m_level')->insert($data);
    }
}
