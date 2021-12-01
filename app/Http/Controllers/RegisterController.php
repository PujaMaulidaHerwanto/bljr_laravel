<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index', [
            'title' => 'Register',
            'active' => 'register'
        ]);
    }

    public function store(Request $request)
    {
        // request untu mengambil semua data yang dikirimkan lewat post
        // return request()->all();

        // return $request->all();

        $validatedData = $request->validate([
                            'name' => 'required|unique:users|max:255',
                            'username' => ['required', 'min:3', 'max:255', 'unique:users'],
                            'email' => 'required|email:dns|unique:users',
                            'password' => 'required|min:5|max:255'
                        ]);

        // kalau gagal cuma me refresh halaman nya saja, kalau berhasil muncul dd tulisan tersebut
        // dd("Registrasi Berhasil");
        
        // sensor password di db

        // Cara Pertama
        // $validatedData['password'] = bcrypt($validatedData['password']);

        //cara kedua
        $validatedData['password'] = Hash::make($validatedData['password']);

        // MAsukan data ke database
        User::create($validatedData);

        //flash data
        // $request->session()->flash('success', 'Registration Success!! Login Now!');


        // me redirect setelah berhasil registrasi
        return redirect('/login')->with('success', 'Registration Success!! Login Now!');
        
    }
}
