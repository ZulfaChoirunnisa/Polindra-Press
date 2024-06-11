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
            'username' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Memisahkan parameter untuk User dan Pengaju
        $params1 = $request->all();
        $params2 = [
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'pengaju',
        ];

        // Membuat User
        $user = User::create($params2);
        if ($user) {
            $params1['user_id'] = $user->id;

            // Membuat Pengaju
            $pengaju = Pengaju::create($params1);
            if ($pengaju) {
                // Menampilkan pesan sukses
                // Anda dapat mengganti ini dengan library alert yang Anda gunakan
                return redirect()->route('login')->with('success', 'Data Berhasil Disimpan');
            } else {
                $user->delete();
                // Menampilkan pesan error
                // Anda dapat mengganti ini dengan library alert yang Anda gunakan
                return redirect()->route('register')->with('error', 'Data Gagal Disimpan');
            }
        }
        return redirect()->route('login');
    }
}

