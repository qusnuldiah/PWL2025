<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $data = [
            ['level_id' => 1, 'username' => 'owner', 'nama' => 'Owner Toko', 'password' => Hash::make('owner')],
            ['level_id' => 2, 'username' => 'admin', 'nama' => 'Admin POS', 'password' => Hash::make('admin')],
            ['level_id' => 3, 'username' => 'kasir1', 'nama' => 'Kasir Satu', 'password' => Hash::make('kasir')],
            ['level_id' => 3, 'username' => 'kasir2', 'nama' => 'Kasir Dua', 'password' => Hash::make('kasir')],
            ['level_id' => 4, 'username' => 'Pembeli1', 'nama' => 'Pembeli Satu', 'password' => Hash::make('pembeli')],
            ['level_id' => 4, 'username' => 'Pembeli2', 'nama' => 'Pembeli Dua', 'password' => Hash::make('pembeli')],
            ['level_id' => 4, 'username' => 'Pembeli3', 'nama' => 'Pembeli Tiga', 'password' => Hash::make('pembeli')],
        ];
        DB::table('m_user')->insert($data);
    }
}
