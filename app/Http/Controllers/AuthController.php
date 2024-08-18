<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // Menampilkan form registrasi
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Menangani proses registrasi
    public function register(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|numeric|digits:11|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4|confirmed',
            'role' => 'required|string|in:user', // Validasi peran
        ]);

        // Menyimpan data pengguna baru
        User::create([
            'name' => $validatedData['name'],
            'nim' => $validatedData['nim'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => $validatedData['role'], // Menyimpan peran yang dipilih
        ]);

        // Mengarahkan pengguna setelah registrasi
        return redirect()->route('register')->with('success', 'Registration successful. Please login.');
    }

    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Menangani proses login
    public function login(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginField = filter_var($validatedData['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'nim';
        $credentials = [$loginField => $validatedData['login'], 'password' => $validatedData['password']];

        // Cek kredensial dan login
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Redirect berdasarkan role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'You are logged in as admin!');
            }

            return redirect()->route('user.dashboard')->with('success', 'You are logged in!');
        }

        // Menentukan pesan kesalahan
        $userExists = User::where($loginField, $validatedData['login'])->exists();

        if (!$userExists) {
            $errorMessage = 'NIM or Email is incorrect. Please try again.';
        } else {
            $errorMessage = 'The password is incorrect. Please try again.';
        }

        return back()->withErrors([
            'login' => $errorMessage,
        ]);
    }

    // Menangani logout
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'You have been logged out.');
    }
}
