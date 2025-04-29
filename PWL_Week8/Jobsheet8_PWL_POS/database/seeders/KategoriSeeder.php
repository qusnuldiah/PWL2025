<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['kategori_id' => 1, 'kategori_kode' => 'KT001', 'kategori_nama' => 'Food & Beverage'],
            ['kategori_id' => 2, 'kategori_kode' => 'KT002', 'kategori_nama' => 'Beauty & Health'],
            ['kategori_id' => 3, 'kategori_kode' => 'KT003', 'kategori_nama' => 'Home Care'],
            ['kategori_id' => 4, 'kategori_kode' => 'KT004', 'kategori_nama' => 'Baby & Kid'],
        ];
        DB::table('m_kategori')->insert($data);
    }
}
