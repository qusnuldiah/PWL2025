<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:m_user,username',
            'password' => 'required|string|confirmed|min:6',
        ]);

        \App\Models\User::create([
            'nama' => $validated['name'],
            'username' => $validated['username'],
            'password' => bcrypt($validated['password']),
            'level_id' => 4, // default pelanggan
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login.');
    }
}
