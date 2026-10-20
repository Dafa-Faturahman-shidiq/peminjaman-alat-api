<?php

namespace App\Http\Controllers\WEB;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    // * 1. Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // * 2. Menangani proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ],
        [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter',
        ]
        );

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect based on role
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'petugas') {
                return redirect()->route('petugas.peminjaman.index');
            } elseif ($user->role === 'peminjam') {
                return redirect()->route('peminjam.katalog.index');
            }

            Auth::logout(); // Logout the user if authentication fails
            return redirect()->route('login')->with('error', 'Role tidak dikenali');
        }

        return redirect()->route('login')->with('error', 'Email atau password salah');

    }

    // * 3. Menampilkan form Register
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    //* 4. fungsi untuk register hanya untuk peminjam
    public function register(Request $request)
    {

        // dd($request->all());

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'no_hp' => 'required|max:20',
            'alamat' => 'required|string'
        ],
        [
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'no_hp.required' => 'Nomor HP harus diisi',
            'alamat.required' => 'Alamat harus diisi'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat
        ]);

        return redirect()->route('login')->with('success', 'Register berhasil, Silahkan Login Kembali');
    }

    // * 5. Menangani proses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Berhasil logout');
    }
}
