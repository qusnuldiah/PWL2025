<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return 'Selamat Datang';
    }

    public function about()
    {
        return "NIM: 2341760035 <br> Nama: Qusnul Diah M";
    }

    public function articles($id)
    {
        return "Halaman Artikel dengan ID " . $id;
    }
}
