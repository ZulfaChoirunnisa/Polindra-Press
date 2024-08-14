<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pengaju;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register'); 
    }

    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'username' => ['required', 'string', 'max:100', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Memisahkan parameter untuk User dan Pengaju
        $params1 = $request->all();
        $params2 = [
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pengaju',
        ];

        try {
            // Membuat User
            $user = User::create($params2);
            if ($user) {
                $params1['user_id'] = $user->id;

                // Membuat Pengaju
                $pengaju = Pengaju::create($params1);
                if ($pengaju) {
                    // Menampilkan pesan sukses
                    return redirect()->route('login')->with('success', 'Data Berhasil Disimpan');
                } else {
                    // Hapus user jika gagal menyimpan pengaju
                    $user->delete();
                    // Menampilkan pesan error
                    return redirect()->route('register')->with('error', 'Data Gagal Disimpan');
                }
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            // Menangani error duplikat
            if ($ex->errorInfo[1] == 1062) {
                return redirect()->route('register')->withErrors('Username atau email sudah digunakan.');
            }

            // Menangani error lain (opsional)
            return redirect()->route('register')->withErrors('Terjadi kesalahan, silakan coba lagi.');
        }

        return redirect()->route('login');
    }
}
