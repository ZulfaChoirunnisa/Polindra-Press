<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Nette\Utils\DateTime;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;


class BukuController extends Controller
{
    public function dashboard()
    {
        $publishedBuku = Buku::where('status', 'accept')->get();

        return view('admin.buku.dashboard', compact('publishedBuku'));
    }
    public function create()
    {
        return view('book.create');
    }
    public function store(Request $request)
    {
        $buku = new Buku();
        $buku->title = $request->title;
        $buku->author = $request->author;
        $buku->pages = $request->pages;
        $buku->references = $request->references;
        $buku->review = $request->review;
        $buku->authenticity_statement = $request->authenticity_statement;
        $buku->author_bio = $request->author_bio;
        $buku->save();

        return redirect('/')->with('status', 'Book submitted successfully!');
    }
    public function index()
    {
        $buku = Buku::all();
        $data['buku'] = $buku;
        return view('admin.buku.index', $data);
    }
    public function download()
    {
        $data['buku'] = Buku::where('status', 'accept')->get();
        return view('admin.buku.download', $data);
    }
    public function show($id)
    {
        $buku = Buku::find($id);
        return view('admin.show', compact('book'));
    }

    public function review($id)
    {
        $buku = Buku::find($id);
        $data['buku'] = $buku;
        return view('admin.buku.review', $data);
    }

    public function postreview(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $buku = Buku::find($id);
            $buku->status = $request->status;
            $buku->adminComment = $request->catatan;
            $buku->save();
            DB::commit();
            return back()->with('success', 'Status Berhasil Diubah');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }


        return redirect('/Admin/buku')->with('status', 'Book reviewed successfully!');
    }

    public function edit(Request $request, $id)
    {
        $data['buku'] = Buku::find($id);
        return view('admin.buku.edit', $data);
    }
    public function storeedit(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $buku = Buku::find($id);
            $buku->update([
                'isbn' => $request->isbn,
                'noProduk' => $request->noProduk,
            ]);

            DB::commit();
            return redirect('/Admin/buku/download')->with('success', 'Berhasil menambahkan isbn dan no produk');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Error' . $e->getMessage());
        }
    }
    public function exportBukuUsers()
    {
        return Excel::download(new UsersExport(), 'buku ajuan.xlsx');
    }

    public function Publish()
    {
        $buku = Buku::where('statusUpload', 'belum_upload')->get();

        return view('admin.buku.publish', compact('buku'));
    }

    public function publishBuku(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $buku = Buku::find($id);
            $buku->update([
                'publish' => $request->publish
            ]);
            DB::commit();

            return back()->with('succes', 'Data Buku Berhasil Di Publish');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'error' . $e->getMessage());
        }


        // Redirect kembali ke halaman publish dengan pesan sukses
        return redirect()->route('Admin.Buku.Publish')->with('success', 'Buku berhasil dipublish!');
    }

    public function profileadmin()
    {
        $admin = Admin::where('id', auth()->user()->admin->id)->first();
        $data['admin'] = $admin;
        return view('Admin.buku.profileadmin', $data);
    }

    public function update(Request $request)
    {
        // dd('hallo');
        $user = User::findOrFail(auth()->user()->id);
        // dd($user);
        $superadmin = Admin::where('user_id', auth()->user()->id)->first();

        $superadminParams = $request->only(['name', 'foto']);
        if ($request->has('foto')) {
            $superadminParams['foto'] = $this->simpanProfile($superadmin->user->role, $request->file('foto'), $superadminParams['name']);
        } else {
            $superadminParams = $request->except('foto');
        }
        $superadmin->update($superadminParams);

        $user->update([
            'name' => $request->input('name'),
        ]);

        alert()->success('Success', 'Data Berhasil Disimpan');
        return redirect()->route('Admin.Buku.Profileadmin');
    }

    public function reset(Request $request)
    {
        // dd('hallo');
        if ($request->new_password !== $request->password_confirmation) {
            // alert()->error('Error', 'konfirmasi password tidak sama dengan password.');
            return redirect()->route('Admin.profile.index');
        }
        $request->validate([
            'current_password' => 'required',
            // Add other validation rules for your input fields
        ]);

        try {
            $user = User::findOrFail(auth()->user()->id);
            // dd('hello');
            if ($request->filled('current_password')) {

                if (Hash::check($request->current_password, $user->password)) {
                    if (Hash::check($request->new_password, $user->password)) {
                        $months_ago = $user->updated_at->diffInMonths(now());
                        if ($months_ago == 0) {
                            // alert()->error('Error', 'Password baru tidak boleh sama dengan password yang diubah bulan ini.');
                            return redirect()->route('Admin.profile.index');
                        } else {
                            // alert()->error('Error', 'Password baru tidak boleh sama dengan password yang diubah ' . $months_ago . ' bulan lalu.');
                            return redirect()->route('Admin.profile.index');
                        }
                        // alert()->error('Error', 'Password baru tidak boleh sama dengan password yang diubah ' . $months_ago . ' bulan lalu.');
                        return redirect()->route('Admin.profile.index');
                    }
                    $user->password = Hash::make($request->new_password);

                    if ($user->save()) {
                        // alert()->success('Success', 'Password berhasil diubah.');
                        return redirect()->route('Admin.profile.index');
                    } else {
                        // alert()->error('Error', 'Gagal menyimpan perubahan password.');
                    }
                } else {
                    // alert()->error('Error', 'Current password tidak sesuai');
                    return redirect()->route('Admin.profile.index');
                }
            } else {
                // alert()->error('Error', 'Masukkan password lama.');
            }

            return redirect()->back();
        } catch (\Exception $e) {
            // alert()->error('Error', 'Terjadi kesalahan saat memproses perubahan password.');
            return redirect()->back();
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
}
