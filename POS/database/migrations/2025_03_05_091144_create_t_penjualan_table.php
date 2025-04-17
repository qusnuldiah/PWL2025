<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('t_penjualan', function (Blueprint $table) {
            $table->bigIncrements('penjualan_id');
            $table->unsignedBigInteger('kasir_id');
            $table->unsignedBigInteger('pembeli_id');
            $table->string('penjualan_kode', 20)->unique();
            $table->dateTime('penjualan_tanggal');
            $table->timestamps();
        
            // Foreign key ke tabel m_user
            $table->foreign('kasir_id')->references('user_id')->on('m_user')->onDelete('cascade');
            $table->foreign('pembeli_id')->references('user_id')->on('m_user')->onDelete('cascade');
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('t_penjualan');
    }
};
