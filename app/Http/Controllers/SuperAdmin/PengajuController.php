<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Pengaju;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PengajuController extends Controller
{
    public function index()
    {
        $data = [
            "pengaju" => Pengaju::all()
        ];

        return view('superadmin.pengaju.index', $data);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'username' => ['required', 'string', 'max:100', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

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
            $params1['user_id'] = $user->id;

            Pengaju::create($params1);
            DB::commit();
            return redirect()->route('SuperAdmin.Account.Pengaju.Index')->with('success', 'Data Berhasil Disimpan');
        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollBack();

            if ($ex->errorInfo[1] == 1062) {
                return redirect()->route('SuperAdmin.Account.Pengaju.Index')->withErrors('Username atau email sudah digunakan.');
            }

            return redirect()->route('SuperAdmin.Account.Pengaju.Index')->withErrors('Terjadi kesalahan, silakan coba lagi.');
        }
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        $user = User::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'username' => [
                'required',
                'string',
                'max:100',
                Rule::unique('users', 'username')->ignore($user->id)
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id)
            ],
        ]);

        $params1 = $request->except(['_method', '_token', 'email', 'username', 'password']);
        $params2 = [
            'username' => $request->username,
            'email' => $request->email,
            'role' => 'pengaju',
        ];

        if ($request->password) {
            $params2 = array_merge($params2, ['password' => Hash::make($request->password)]);
        }

        try {
            // Membuat User
            $params1['user_id'] = $user->id;
            $user = User::where('id', $id)->update($params2);

            Pengaju::where('user_id', $params1['user_id'])->update($params1);
            DB::commit();
            return redirect()->route('SuperAdmin.Account.Pengaju.Index')->with('success', 'Data Berhasil Disimpan');
        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollBack();

            if ($ex->errorInfo[1] == 1062) {
                return redirect()->route('SuperAdmin.Account.Pengaju.Index')->withErrors('Username atau email sudah digunakan.');
            }

            return redirect()->route('SuperAdmin.Account.Pengaju.Index')->withErrors('Terjadi kesalahan, silakan coba lagi.');
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();

        $user = User::findOrFail($id);

        try {
            // Membuat User
            $user->delete();

            DB::commit();
            return redirect()->route('SuperAdmin.Account.Pengaju.Index')->with('success', 'Data Berhasil Dihapus');
        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollBack();

            if ($ex->errorInfo[1] == 1062) {
                return redirect()->route('SuperAdmin.Account.Pengaju.Index')->withErrors('Username atau email sudah digunakan.');
            }

            return redirect()->route('SuperAdmin.Account.Pengaju.Index')->withErrors('Terjadi kesalahan, silakan coba lagi.');
        }
    }
}
