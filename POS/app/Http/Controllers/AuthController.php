<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect('/'); // Jika sudah login, arahkan ke beranda
        }

        return view('auth.login'); // Tampilkan halaman login
    }

    public function postlogin(Request $request)
    {
        $credentials = $request->only('username', 'password');

        // Cek jika request dilakukan melalui AJAX
        if ($request->ajax() || $request->wantsJson()) {
            if (Auth::attempt($credentials)) {
                return response()->json([
                    'status' => true,
                    'message' => 'Login Berhasil',
                    'redirect' => url('/')
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => 'Login Gagal. Username atau password salah.',
                'msgField' => [
                    'username' => ['Username atau password salah'],
                    'password' => ['Username atau password salah'],
                ]
            ]);
        }

        // Fallback untuk non-AJAX
        if (Auth::attempt($credentials)) {
            return redirect('/')->with('success', 'Login Berhasil!');
        }

        return redirect()->back()->with('error', 'Login Gagal! Periksa username dan password.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login')->with('success', 'Anda berhasil logout.');
    }

    public function username()
    {
        return 'username';
    }
}
