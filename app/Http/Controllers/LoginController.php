<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        // Mengambil view dari folder login, file index
        return view('login.index', [
            'title' => 'Login',
            'active' => 'login'
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials =  $request->validate([
                            'email' => 'required|email',
                            'password' => 'required'
                        ]);

        // dd('Berhasil login');

        if (Auth::attempt($credentials)) {
            // perbaharui session nya
            $request->session()->regenerate();

            // menggunakan intendeed agar data melewati middleware
            return redirect()->intended('/dashboard');
        }

        // Jika login gagal
        return back()->with('loginErrors', 'Login Failed!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        // supaya gak bisa di pake
        $request->session()->invalidate();

        // lalu bikin session baru agar tidak di bajak
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
