<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $data = [
            ['kategori_id' => 1, 'kategori_kode' => 'KT001', 'kategori_nama' => 'Food & Beverage', 'slug' => 'food-beverage'],
            ['kategori_id' => 2, 'kategori_kode' => 'KT002', 'kategori_nama' => 'Beauty & Health', 'slug' => 'beauty-health'],
            ['kategori_id' => 3, 'kategori_kode' => 'KT003', 'kategori_nama' => 'Home Care', 'slug' => 'home-care'],
            ['kategori_id' => 4, 'kategori_kode' => 'KT004', 'kategori_nama' => 'Baby & Kid', 'slug' => 'baby-kid'],
        ];
        DB::table('m_kategori')->insert($data);
    }
}
