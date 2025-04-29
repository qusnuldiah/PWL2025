<?php
 
 namespace Database\Seeders;
 
 use Illuminate\Database\Console\Seeds\WithoutModelEvents;
 use Illuminate\Database\Seeder;
 use Illuminate\Support\Facades\DB;
 use Carbon\Carbon;
 
 class SupplierSeeder extends Seeder
 {
     /**
      * Run the database seeds.
      */
     public function run(): void
     {
         $data_supplier = [
            ['supplier_kode' => 'SUP001', 'supplier_nama' => 'CV Sumber Makmur', 'supplier_alamat' => 'Jl. Raya No.1, Malang', 'created_at' => Carbon::now()],
            ['supplier_kode' => 'SUP002', 'supplier_nama' => 'PT Indo Sukses', 'supplier_alamat' => 'Jl. Veteran No.88, Surabaya', 'created_at' => Carbon::now()],
            ['supplier_kode' => 'SUP003', 'supplier_nama' => 'UD Maju Jaya', 'supplier_alamat' => 'Jl. Ahmad Yani No.10, Sidoarjo', 'created_at' => Carbon::now()],
            ['supplier_kode' => 'SUP004', 'supplier_nama' => 'Toko Sinar Abadi', 'supplier_alamat' => 'Jl. Gatot Subroto No.21, Kediri', 'created_at' => Carbon::now()],
        ];
        DB::table('m_supplier')->insert($data_supplier);
     }
 }