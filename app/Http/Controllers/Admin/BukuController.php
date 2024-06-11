<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\User;
use Nette\Utils\DateTime;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

// use Maatwebsite\Excel\Facades\Excel;
// use App\Exports\BooksExport;

class BukuController extends Controller
{
    public function dashboard()
    {
        // Ambil semua buku yang telah dipublish
        $publishedBuku = Buku::where('is_published', true)->get();

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
        return view('admin.buku.index',$data);
    }
    public function download()
    {
        $buku = Buku::where('status','accepted')->get();
        $data['buku'] = $buku;
        return view('admin.buku.download',$data);
    }
    public function show($id)
    {
        $buku = Buku::find($id);
        return view('admin.show', compact('book'));
    }

    public function review($id){
        $buku = Buku::find($id);
        $data['buku'] = $buku;
        return view('admin.buku.review',$data);
    }
        public function postreview(Request $request, $id)
    {
        $buku = Buku::find($id);
        $buku->status = $request->status;
        $buku->admin_comments = $request->admin_comments;
        $buku->save();

        return redirect('/Admin/buku')->with('status', 'Book reviewed successfully!');
    }
    public function edit(Request $request, $id){
        $buku = Buku::find($id);
        $data['buku'] = $buku;
        return view('admin.buku.edit',$data);
    }
    public function storeedit (Request $request, $id)
    {
        $data1 = $request->all();
        $buku = Buku::findOrFail($id);
        $data['ISBN'] = $request->ISBN;
        $buku->update($data1);
        return redirect('/Admin/buku/download')->with('success', 'Data buku berhasil diperbarui.');
    }
    public function exportBukuUsers() 
    {
        return Excel::download(new UsersExport(), 'buku ajuan.xlsx');
    }

    public function Publish()
    {
        // Ambil semua buku yang belum dipublish
        $buku = Buku::where('is_published', false)->get();
        
        return view('admin.buku.publish', compact('buku'));
    }

    public function publishBuku(Buku $buku, $id)
    {
        // Temukan buku berdasarkan ID
        $buku = Buku::find($id);

        if ($buku) {
            // Update status publikasi buku
            $buku->is_published = true;
            $buku->save();
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

        $superadminParams = $request->only(['name', 'foto' ]);
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
 