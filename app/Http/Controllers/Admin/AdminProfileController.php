<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class AdminProfileController extends Controller
{
    public function profileadmin()
    {
        $adminId = Auth::user()->id;
        $data['admin'] = Admin::where('id', $adminId)->first();
        return view('Admin.buku.profileadmin', $data);
    }

    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = User::where('id', Auth::user()->id)->first();
            $admin = Admin::where('user_id', $user->id)->first();

            if ($user && $admin) {
                $admin->name = $request->input('name');
                if ($request->hasFile('foto')) {
                    $admin->foto = $this->simpanProfile('admin', $request->file('foto'), $user->id);
                }
                $admin->job = $request->input('job');
                $admin->alamat = $request->input('alamat');
                $admin->notlp = $request->input('notlp');

                $admin->save();

                DB::commit();
                return back()->with('success', 'Data Berhasil Diubah!');
            } else {
                return back()->with('error', 'Data Pengguna atau Pengaju tidak ditemukan.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
    }

    private function simpanProfile($type, $foto, $nama)
    {
        $dt = new DateTime();

        $path = public_path('storage/uploads/profil/' . $type . '/' . $dt->format('Y-m-d') . '/' . $nama);
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0755, true, true);
        }
        $file = $foto;
        $name =  $type . '' . $nama . '' . $dt->format('Y-m-d');
        $fileName = $name . '.' . $file->getClientOriginalExtension();
        $folder = '/uploads/profil/' . $type . '/' . $dt->format('Y-m-d') . '/' . $nama;

        $check = public_path($folder) . $fileName;

        if (File::exists($check)) {
            File::delete($check);
        }

        $filePath = $file->storeAs($folder, $fileName, 'public');
        return $filePath;
    }


    public function reset(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:6|different:current_password',
            'password_confirmation' => 'required|same:new_password',
        ]);
        try {
            DB::beginTransaction();
            $user = User::where('id', Auth::user()->id)->first();

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            if (Hash::check($request->current_password, $user->password)) {
                $user->password = bcrypt($request->new_password);
                $user->save();

                DB::commit();
                return redirect()->back()->with('success', 'Kata Sandi Berhasil Diubah!');
            } else {
                DB::rollBack();
                return redirect()->back()->with('error', 'Kata Sandi Saat Ini Tidak Cocok.');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi Kesalahan. Silakan coba lagi.');
        }
    }
}
