<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\AuthController;
use App\Models\SupplierModel;
use Illuminate\Support\Facades\Route;

Route::pattern('id', '[0-9]+'); // Pastikan parameter {id} hanya berupa angka

// Rute otentikasi
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'postRegister']);


// Semua rute di bawah ini hanya bisa diakses jika sudah login
Route::middleware(['auth'])->group(function () {

    Route::get('/', [WelcomeController::class, 'index']); // index setelah login 

    Route::get('/profile', [UserController::class, 'profile']);
    Route::post('/profile/update-photo', [UserController::class, 'updatePhoto'])->name('user.updatePhoto');

    Route::middleware(['authorize:ADM'])->group(function(){
        Route::group(['prefix' => 'user'], function () {
            Route::get('/', [UserController::class, 'index']); // menampilkan halaman awal user
            Route::post('/list', [UserController::class, 'list']); // menampilkan data user dalam bentuk json untuk datatables
            Route::get('/create', [UserController::class, 'create']); // menampilkan halaman form tambah user
            Route::post('/', [UserController::class, 'store']); // menyimpan data user baru
            //Create Menggunakan AJAX
            Route::get('/create_ajax', [UserController::class, 'create_ajax']); // Menampilkan halaman form tambah user Ajax
            Route::post('/ajax', [UserController::class, 'store_ajax']); // Menyimpan data user baru Ajax
            //Show Menggunakan AJAX
            Route::get('/{id}/show_ajax', [UserController::class, 'show_ajax']); // Menampilkan detail user Ajax
            Route::get('/{id}', [UserController::class, 'show']); // menampilkan detail user
            Route::get('/{id}/edit', [UserController::class, 'edit']); // menampilkan halaman form edit user
            Route::put('/{id}', [UserController::class, 'update']); // menyimpan perubahan data user
            //Edit Menggunakan AJAX
            Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']); // Menampilkan halaman form edit user Ajax
            Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']); // Menyimpan perubahan data user Ajax
            //Delete Menggunakan AJAX
            Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']); // Untuk tampilkan form confirm delete user Ajax
            Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']); // Untuk hapus data user Ajax
            Route::delete('/{id}', [UserController::class, 'destroy']); // menghapus data user
            // Import User with Excel
            Route::get('import', [UserController::class, 'import']); // ajax form upload excel
            Route::post('import_ajax', [UserController::class, 'import_ajax']); // ajax import excel
            // Export User with Excel
            Route::get('export_excel', [UserController::class, 'export_excel']); //export excel
            // Export User with Pdf
            Route::get('export_pdf', [UserController::class, 'export_pdf']); //export pdf
        });
    });

    // artinya semua route di dalam group ini harus punya role ADM (Administrator)
    Route::middleware(['authorize:ADM'])->group(function(){
        Route::group(['prefix' => 'level'], function () {
            Route::get('/', [LevelController::class, 'index']); // menampilkan halaman awal level
            Route::post("/list", [LevelController::class, 'list']); // menampilkan data level dalam bentuk json untuk datatables
            Route::get('/create', [LevelController::class, 'create']); // menampilkan halaman form tambah level
            Route::post('/', [LevelController::class, 'store']); // menyimpan data level baru
            //Create Menggunakan AJAX
            Route::get('/create_ajax', [LevelController::class, 'create_ajax']); // Menampilkan halaman form tambah level Ajax
            Route::post('/ajax', [LevelController::class, 'store_ajax']); // Menyimpan data level baru Ajax
            //Show Menggunakan AJAX
            Route::get('/{id}/show_ajax', [LevelController::class, 'show_ajax']); // Menampilkan detail level Ajax
            Route::get('/{id}', [LevelController::class, 'show']); // menampilkan detail level
            Route::get('/{id}/edit', [LevelController::class, 'edit']); // menampilkan halaman form edit level
            Route::put('/{id}', [LevelController::class, 'update']); // menyimpan perubahan data level
            //Edit Menggunakan AJAX
            Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']); // Menampilkan halaman form edit level Ajax
            Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']); // Menyimpan perubahan data level Ajax
            //Delete Menggunakan AJAX
            Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']); // Untuk tampilkan form confirm delete level Ajax
            Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']); // Untuk hapus data level Ajax
            Route::delete('/{id}', [LevelController::class, 'destroy']); // menghapus data level
            // Import Level with Excel
            Route::get('import', [LevelController::class, 'import']); // ajax form upload excel
            Route::post('import_ajax', [LevelController::class, 'import_ajax']); // ajax import excel
            // Export Level with Excel
            Route::get('export_excel', [LevelController::class, 'export_excel']); //export excel
            // Export Level with Pdf
            Route::get('export_pdf', [LevelController::class, 'export_pdf']); //export pdf
        });
    });

     // artinya semua route di dalam group ini harus punya role ADM (Administrator) dan MNG (Manager)
     Route::middleware(['authorize:ADM,MNG'])->group(function(){
        Route::group(['prefix' => 'kategori'], function () {
            Route::get('/', [KategoriController::class, 'index']); // menampilkan halaman awal kategori
            Route::post("/list", [KategoriController::class, 'list']); // menampilkan data kategori dalam bentuk json untuk datatables
            Route::get('/create', [KategoriController::class, 'create']); // menampilkan halaman form tambah kategori
            Route::post('/', [KategoriController::class, 'store']); // menyimpan data kategori baru 
            // Create menggunakan AJAX
            Route::get('/create_ajax', [KategoriController::class, 'create_ajax']); // menampilkan halaman form tambah kategori ajax
            Route::post('/ajax', [KategoriController::class, 'store_ajax']); // menyimpan data kategori baru ajax
            //Show Menggunakan AJAX
            Route::get('/{id}/show_ajax', [KategoriController::class, 'show_ajax']); // Menampilkan detail kategori Ajax
            Route::get('/{id}', [KategoriController::class, 'show']); // menampilkan detail kategori
            Route::get('/{id}/edit', [KategoriController::class, 'edit']); // menampilkan halaman form edit kategori
            Route::put('/{id}', [KategoriController::class, 'update']); // menyimpan perubahan data kategori
            // Edit menggunakan AJAX
            Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']); // menampilkan halaman form edit kategori ajax
            Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']); // menyimpan perubahan data kategori ajax
            // Delete menggunakan AJAX
            Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']); //menampilkan form confirm delete kategori ajax
            Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']); // menghapus data kategori ajax
            Route::delete('/{id}', [KategoriController::class, 'destroy']); // menghapus data kategori
            // Import Kategori with Excel
            Route::get('import', [KategoriController::class, 'import']); // ajax form upload excel
            Route::post('import_ajax', [KategoriController::class, 'import_ajax']); // ajax import excel
            // Export Kategori with Excel
            Route::get('export_excel', [KategoriController::class, 'export_excel']); //export excel
            // Export Kategori with Pdf
            Route::get('export_pdf', [KategoriController::class, 'export_pdf']); //export pdf
        });
    });

    
    // Staff hanya bisa melihat data barang
    Route::middleware(['authorize:ADM,MNG,STF'])->group(function(){
        Route::group(['prefix' => 'barang'], function () {
            Route::get('/', [BarangController::class, 'index']); // Menampilkan daftar barang
            Route::post('/list', [BarangController::class, 'list']); // Menampilkan data barang dalam bentuk JSON untuk datatables
            //Show Menggunakan AJAX
            Route::get('/{id}/show_ajax', [BarangController::class, 'show_ajax']); // Menampilkan detail barang Ajax
            Route::get('/{id}', [BarangController::class, 'show']); // Menampilkan detail barang
        });
    });

    // ADM & MNG bisa menambah, mengedit, dan menghapus barang
    Route::middleware(['authorize:ADM,MNG'])->group(function(){
        Route::group(['prefix' => 'barang'], function () {
            Route::get('/create', [BarangController::class, 'create']); // Form tambah barang
            Route::post('/', [BarangController::class, 'store']); // Simpan barang baru
            // Create menggunakan AJAX
            Route::get('/create_ajax', [BarangController::class, 'create_ajax']); // Form tambah barang AJAX
            Route::post('/ajax', [BarangController::class, 'store_ajax']); // Simpan barang baru AJAX
            Route::get('/{id}/edit', [BarangController::class, 'edit']); // Form edit barang
            Route::put('/{id}', [BarangController::class, 'update']); // Simpan perubahan barang
            // Edit menggunakan AJAX
            Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax']); // Form edit barang AJAX
            Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax']); // Simpan perubahan barang AJAX
            // Delete menggunakan AJAX
            Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']); // Form konfirmasi hapus barang AJAX
            Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax']); // Hapus barang AJAX
            Route::delete('/{id}', [BarangController::class, 'destroy']); // Hapus barang
            // Import Barang with Excel
            Route::get('import', [BarangController::class, 'import']); // ajax form upload excel
            Route::post('import_ajax', [BarangController::class, 'import_ajax']); // ajax import excel
            // Export Barang with Excel
            Route::get('export_excel', [BarangController::class, 'export_excel']); //export excel
            // Export Barang with Pdf
            Route::get('export_pdf', [BarangController::class, 'export_pdf']); //export pdf
        });
    });

    
    // artinya semua route di dalam group ini harus punya role ADM (Administrator) dan MNG (Manager)
    Route::middleware(['authorize:ADM,MNG'])->group(function(){
        Route::group(['prefix' => 'supplier'], function () {
            Route::get('/', [SupplierController::class, 'index']);
            Route::post('/list', [SupplierController::class, 'list']);
            Route::get('/create', [SupplierController::class, 'create']);
            Route::post('/', [SupplierController::class, 'store']);
            // Create menggunakan AJAX
            Route::get('/create_ajax', [SupplierController::class, 'create_ajax']); // menampilkan halaman form tambah Supplier ajax
            Route::post('/ajax', [SupplierController::class, 'store_ajax']); // menyimpan data Supplier baru ajax
            //Show Menggunakan AJAX
            Route::get('/{id}/show_ajax', [SupplierController::class, 'show_ajax']); // Menampilkan detail supplier Ajax
            Route::get('/{id}', [SupplierController::class, 'show']);
            Route::get('/{id}/edit', [SupplierController::class, 'edit']);
            Route::put('/{id}', [SupplierController::class, 'update']);
            // Edit menggunakan AJAX
            Route::get('/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']); // menampilkan halaman form edit Supplier ajax
            Route::put('/{id}/update_ajax', [SupplierController::class, 'update_ajax']); // menyimpan perubahan data Supplier ajax
            // Delete menggunakan AJAX
            Route::get('/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']); //menampilkan form confirm delete Supplier ajax
            Route::delete('/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']); // menghapus data Supplier ajax
            Route::delete('/{id}', [SupplierController::class, 'destroy']);
            // Import Supplier with Excel
            Route::get('import', [SupplierController::class, 'import']); // ajax form upload excel
            Route::post('import_ajax', [SupplierController::class, 'import_ajax']); // ajax import excel
            // Export Supplier with Excel
            Route::get('export_excel', [SupplierController::class, 'export_excel']); //export excel
            // Export Supplier with Pdf
            Route::get('export_pdf', [SupplierController::class, 'export_pdf']); //export pdf
        });
    });

    // artinya semua route di dalam group ini harus punya role ADM (Administrator), MNG (Manager) dan STF (Staff)
    Route::middleware(['authorize:ADM,MNG,STF'])->group(function(){
        Route::group(['prefix' => 'stok'], function () {
            Route::get('/', [StokController::class, 'index']);
            Route::post('/list', [StokController::class, 'list']); // menampilkan data stok dalam bentuk json untuk datatables
            //Show Menggunakan AJAX
            Route::get('/{id}/show_ajax', [StokController::class, 'show_ajax']); // Menampilkan detail stok Ajax
            Route::get('/{id}', [StokController::class, 'show']); // Menampilkan detail barang
            // Create menggunakan AJAX
            Route::get('/create_ajax', [StokController::class, 'create_ajax']); // menampilkan halaman form tambah Stok ajax
            Route::post('/ajax', [StokController::class, 'store_ajax']); // menyimpan data Stok baru ajax
            // Edit menggunakan AJAX
            Route::get('/{id}/edit_ajax', [StokController::class, 'edit_ajax']); // menampilkan halaman form edit Stok ajax
            Route::put('/{id}/update_ajax', [StokController::class, 'update_ajax']); // menyimpan perubahan data Stok ajax
            // Delete menggunakan AJAX
            Route::get('/{id}/delete_ajax', [StokController::class, 'confirm_ajax']); //menampilkan form confirm delete Stok ajax
            Route::delete('/{id}/delete_ajax', [StokController::class, 'delete_ajax']); // menghapus data Stok ajax
            // Import Supplier with Excel
            Route::get('import', [StokController::class, 'import']); // ajax form upload excel
            Route::post('import_ajax', [StokController::class, 'import_ajax']); // ajax import excel
            // Export Supplier with Excel
            Route::get('export_excel', [StokController::class, 'export_excel']); //export excel
            // Export Supplier with Pdf
            Route::get('export_pdf', [StokController::class, 'export_pdf']); //export pdf
        });
    });

     // artinya semua route di dalam group ini harus punya role ADM (Administrator), MNG (Manager) dan STF (Staff)
     Route::middleware(['authorize:ADM,MNG,STF'])->group(function(){
        Route::group(['prefix' => 'penjualan'], function () {
            Route::get('/', [PenjualanController::class, 'index']);
            Route::post('/list', [PenjualanController::class, 'list']); // menampilkan data penjualan dalam bentuk json untuk datatables
            Route::get('{id}/show_ajax', [PenjualanController::class, 'show_ajax']); //menampilkan detil penjualan 
            // Create menggunakan AJAX
            Route::get('/create_ajax', [PenjualanController::class, 'create_ajax'])->name('penjualan.create_ajax'); 
            Route::post('/ajax', [PenjualanController::class, 'store_ajax'])->name('penjualan.store_ajax');      
            // Edit menggunakan AJAX
             Route::get('/{id}/edit_ajax', [PenjualanController::class, 'edit_ajax'])->name('penjualan.edit_ajax'); 
             Route::post('/{id}/update_ajax', [PenjualanController::class, 'update_ajax'])->name('penjualan.update_ajax'); 
            // Delete menggunakan AJAX
            Route::get('/{id}/delete_ajax', [PenjualanController::class, 'confirm_ajax'])->name('penjualan.delete_ajax'); // Konfirmasi hapus penjualan via AJAX
            Route::delete('/{id}/delete_ajax', [PenjualanController::class, 'delete_ajax'])->name('penjualan.delete_ajax_post');// menghapus data penjualan ajax
            // Import Penjualan with Excel
            Route::get('import', [PenjualanController::class, 'import']); // ajax form upload excel
            Route::post('import_ajax', [PenjualanController::class, 'import_ajax']); // ajax import excel
            // Export Penjualan with Excel
            Route::get('export_excel', [PenjualanController::class, 'export_excel']); //export excel
            // Export Penjualan with Pdf
            Route::get('export_pdf', [PenjualanController::class, 'export_pdf']); //export pdf
        });
    });
});