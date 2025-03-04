<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\PageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route untuk menampilkan "Selamat Datang"
Route::get('/', function () {
    return 'Selamat Datang';
});

// Route untuk menampilkan "Hello"
Route::get('/hello', function () {
    return 'Hello World';
});

// route /hello memanggil method hello() dari WelcomeController
Route::get('/hello', [WelcomeController::class, 'hello']);

// Route untuk menampilkan "World"
Route::get('/world', function () {
    return 'World';
});

// Route '/about' untuk menampilkan 'NIM' dan 'Nama'
Route::get('/about', function () {
    return 'NIM: 2341760035 <br> Nama: Qusnul Diah Mawanti';
});

// Route dengan satu parameter {name}
Route::get('/user/{name}', function ($name) {
    return "Nama saya " . $name;
});

// Route dengan dua parameter {post} dan {comment}
Route::get('/posts/{post}/comments/{comment}', function ($postId, $commentId) {
    return "Pos ke-".$postId." Komentar ke-".$commentId;
});

// Route /articles/{id} dengan id sesuai inpit URL
Route::get('/articles/{id}', function ($id) {
    return "Halaman Artikel dengan ID " . $id;
});

// Route dengan parameter optional
Route::get('/user/{name?}', function ($name = null) {
    return "Nama saya " . $name;
});

// Route dengan parameter default
Route::get('/user/{name?}', function ($name = 'Qusnul Diah Mawanti') {
    return "Nama saya " . $name;
});

// Route memanggil PageController 
Route::get('/', [PageController::class, 'index']);
Route::get('/about', [PageController::class, 'about']);
Route::get('/articles/{id}', [PageController::class, 'articles']);
