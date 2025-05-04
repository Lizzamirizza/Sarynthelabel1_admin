<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // 🔐 Login User
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Jika user tidak ditemukan atau password tidak cocok
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Email atau password salah'], 401);
        }

        // Buat token API untuk user yang berhasil login
        $token = $user->createToken('api-token')->plainTextToken;

        // Kembalikan response dengan token dan data user
        return response()->json([
            'message' => 'Login berhasil',
            'token' => $token,
            'user' => $user,
        ]);
    }

    // 📝 Register User Baru
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role' => 'in:user,admin' // Validasi role
        ]);

        // Buat user baru
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role ?? 'user', // Default ke 'user' jika role tidak diberikan
        ]);

        // Buat token API untuk user yang baru saja terdaftar
        $token = $user->createToken('api-token')->plainTextToken;

        // Kembalikan response dengan token dan data user
        return response()->json([
            'message' => 'Registrasi berhasil',
            'token' => $token,
            'user' => $user
        ], 201);
    }

    // 👤 Ambil Data User (dengan token)
    public function user(Request $request)
    {
        // Mengembalikan data user berdasarkan token yang dikirimkan
        return response()->json($request->user());
    }

    // 🔓 Logout (hapus semua token)
    public function logout(Request $request)
    {
        // Hapus semua token yang dimiliki oleh user yang sedang login
        $request->user()->tokens->each(function ($token) {
            $token->delete();
        });

        // Kembalikan response logout berhasil
        return response()->json(['message' => 'Logout berhasil']);
    }
}
