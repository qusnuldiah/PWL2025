<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::pattern('id', '[0-9]+');

// route untuk login, post login, dan logout
Route::get('login', [AuthController::class, 'login'])->name('login'); // menampilkan form login
Route::post('login', [AuthController::class, 'postlogin']); // proses login
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth'); // logout user

// group route yang hanya bisa diakses setelah login
Route::middleware(['auth'])->group(function () {

    Route::get('/', [WelcomeController::class, 'index']); // halaman utama setelah login

    // group route untuk admin (level ADM)
    Route::middleware(['authorize:ADM'])->group(function () {
        Route::get('/level', [LevelController::class, 'index']); // menampilkan halaman level
        Route::post('/level/list', [LevelController::class, 'list']); // menampilkan data level dalam bentuk json untuk datatables
        Route::get('/level/create', [LevelController::class, 'create']); // menampilkan form tambah level
        Route::post('/level', [LevelController::class, 'store']); // menyimpan data level
        Route::get('/level/create_ajax', [LevelController::class, 'create_ajax']); // form tambah level ajax
        Route::post('/level/ajax', [LevelController::class, 'store_ajax']); // simpan level via ajax
        Route::get('/level/{id}/edit', [LevelController::class, 'edit']); // form edit level
        Route::put('/level/{id}', [LevelController::class, 'update']); // update level
        Route::get('/level/{id}/edit_ajax', [LevelController::class, 'edit_ajax']); // form edit ajax
        Route::put('/level/{id}/update_ajax', [LevelController::class, 'update_ajax']); // update via ajax
        Route::get('/level/{id}/show_ajax', [LevelController::class, 'show_ajax']); // menampilkan detail level
        Route::get('/level/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']); // konfirmasi hapus ajax
        Route::delete('/level/{id}/delete_ajax', [LevelController::class, 'delete_ajax']); // hapus via ajax
        Route::delete('/level/{id}', [LevelController::class, 'destroy']); // hapus level
    });

    // route untuk user
    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [UserController::class, 'index']); // menampilkan halaman user
        Route::post('/list', [UserController::class, 'list']); // menampilkan data user dalam bentuk json
        Route::get('/create', [UserController::class, 'create']); // menampilkan form tambah user
        Route::post('/', [UserController::class, 'store']); // menyimpan user baru
        Route::get('/create_ajax', [UserController::class, 'create_ajax']); // form tambah user ajax
        Route::post('/ajax', [UserController::class, 'store_ajax']); // simpan user via ajax
        Route::get('/{id}/edit', [UserController::class, 'edit']); // menampilkan form edit user
        Route::put('/{id}', [UserController::class, 'update']); // mengupdate data user
        Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']); // form edit user ajax
        Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']); // update user via ajax
        Route::get('/{id}/show_ajax', [UserController::class, 'show_ajax']); // menampilkan detail user
        Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']); // konfirmasi hapus ajax
        Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']); // hapus user via ajax
        Route::delete('/{id}', [UserController::class, 'destroy']); // hapus user
    });

    // route untuk kategori
    Route::group(['prefix' => 'kategori'], function () {
        Route::get('/', [KategoriController::class, 'index']); // halaman kategori
        Route::post("/list", [KategoriController::class, 'list']); // data kategori json
        Route::get('/create', [KategoriController::class, 'create']); // form tambah
        Route::post('/', [KategoriController::class, 'store']); // simpan
        Route::get('/create_ajax', [KategoriController::class, 'create_ajax']); // form ajax
        Route::post('/ajax', [KategoriController::class, 'store_ajax']); // simpan ajax
        Route::get('/{id}/edit', [KategoriController::class, 'edit']); // edit form
        Route::put('/{id}', [KategoriController::class, 'update']); // update
        Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']); // edit ajax
        Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']); // update ajax
        Route::get('/{id}/show_ajax', [KategoriController::class, 'show_ajax']); // menampilkan detail kategori
        Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']); // konfirmasi hapus ajax
        Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']); // hapus ajax
        Route::delete('/{id}', [KategoriController::class, 'destroy']); // hapus biasa
    });

    // route untuk supplier
    Route::group(['prefix' => 'supplier'], function () {
        Route::get('/', [SupplierController::class, 'index']); // halaman supplier
        Route::post('/list', [SupplierController::class, 'list']); // data json
        Route::get('/create', [SupplierController::class, 'create']); // form tambah
        Route::post('/', [SupplierController::class, 'store']); // simpan
        Route::get('/create_ajax', [SupplierController::class, 'create_ajax']); // form ajax
        Route::post('/ajax', [SupplierController::class, 'store_ajax']); // simpan ajax
        Route::get('/{id}/edit', [SupplierController::class, 'edit']); // form edit
        Route::put('/{id}', [SupplierController::class, 'update']); // update
        Route::get('/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']); // form edit ajax
        Route::put('/{id}/update_ajax', [SupplierController::class, 'update_ajax']); // update ajax
        Route::get('/{id}/show_ajax', [SupplierController::class, 'show_ajax']); // menampilkan detail supplier
        Route::get('/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']); // konfirmasi hapus ajax
        Route::delete('/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']); // hapus ajax
        Route::delete('/{id}', [SupplierController::class, 'destroy']); // hapus
    });

    // artinya semua route di dalamm group ini harus punya role ADM (Administrasi) dan MNG (Manager)
    Route::middleware(['authorize:ADM,MNG'])->group(function() {
        Route::get('/barang', [BarangController::class, 'index']); // halaman barang
        Route::post('/barang/list', [BarangController::class, 'list']); // data json
        Route::get('/barang/create', [BarangController::class, 'create']); // form tambah
        Route::post('/barang', [BarangController::class, 'store']); // simpan
        Route::get('/barang/create_ajax', [BarangController::class, 'create_ajax']); // form ajax
        Route::post('/barang/ajax', [BarangController::class, 'store_ajax']); // simpan ajax
        Route::get('/barang/{id}/edit', [BarangController::class, 'edit']); // form edit
        Route::put('/barang/{id}', [BarangController::class, 'update']); // update
        Route::get('/barang/{id}/edit_ajax', [BarangController::class, 'edit_ajax']); // form edit ajax
        Route::put('/barang/{id}/update_ajax', [BarangController::class, 'update_ajax']); // update ajax
        Route::get('/barang/{id}/show_ajax', [BarangController::class, 'show_ajax']); // menampilkan detail barang
        Route::get('/barang/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']); // konfirmasi hapus ajax
        Route::delete('/barang/{id}/delete_ajax', [BarangController::class, 'delete_ajax']); // hapus ajax
        Route::delete('/barang/{id}', [BarangController::class, 'destroy']); // hapus biasa
    });
});
