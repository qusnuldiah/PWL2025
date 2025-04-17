<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $data = [
            ['supplier_id' => 1, 'supplier_kode' => 'SUP001', 'supplier_nama' => 'CV Sumber Makmur', 'supplier_alamat' => 'Jl. Raya No.1, Malang', 'supplier_telpon' => '081234567891'],
            ['supplier_id' => 2, 'supplier_kode' => 'SUP002', 'supplier_nama' => 'PT Indo Sukses', 'supplier_alamat' => 'Jl. Veteran No.88, Surabaya', 'supplier_telpon' => '082223334455'],
            ['supplier_id' => 3, 'supplier_kode' => 'SUP003', 'supplier_nama' => 'UD Maju Jaya', 'supplier_alamat' => 'Jl. Ahmad Yani No.10, Sidoarjo', 'supplier_telpon' => '085566778899'],
            ['supplier_id' => 4, 'supplier_kode' => 'SUP004', 'supplier_nama' => 'Toko Sinar Abadi', 'supplier_alamat' => 'Jl. Gatot Subroto No.21, Kediri', 'supplier_telpon' => '087712341234'],
        ];
        DB::table('m_supplier')->insert($data);
    }
}
