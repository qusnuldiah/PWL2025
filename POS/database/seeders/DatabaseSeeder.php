<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            KategoriSeeder::class,
            SupplierSeeder::class,
            BarangSeeder::class,
            LevelSeeder::class,
            UserSeeder::class,
            PenjualanSeeder::class,
            PenjualanDetailSeeder::class,
            StokSeeder::class,
        ]);
    }
}
