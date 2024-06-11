<?php

namespace App\Http\Controllers\Pengaju;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Nette\Utils\DateTime;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use App\Models\Penulis;
use App\Models\Buku;
use App\Models\Pengaju;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class BukuController extends Controller
{
    public function create ()
    {
        return view('pengaju.buku.create');
    }
    public function store (Request $request)
    {
        // dd($request->file('suratkeaslian'));
        $data1 = $request->all();

        $penulis = [
            'NAMA' => $request->NAMA,
            'NoTelepon' => $request->NoTelepon,
            'Alamat' => $request->Alamat,
            'NIP' => $request->NIP
        ];


        if ($request->has('suratkeaslian') && $request->has('coverbuku') && $request->has('lembarbelakang')) 
        {
            $data1['suratkeaslian'] = $this->simpanPDF($penulis['NAMA'], $request->file('suratkeaslian'));
            $data1['coverbuku'] = $this->simpanImage($penulis['NAMA'], $request->file('coverbuku'));
            $data1['lembarbelakang'] = $this->simpanImage($penulis['NAMA'], $request->file('lembarbelakang'));
            $tambahpenulis = Penulis::create($penulis);
            if($tambahpenulis)
            {
                $data1['penulis_id'] = $tambahpenulis->id;
                $data1['pengaju_id'] = Auth::user()->pengaju->id;
                $buku = Buku::create($data1);
                if($buku)
                {
                    alert()->success('Success','Berhasil');
                }else
                {
                    alert()->error('Error','Gagal');
                }
            }

            return redirect()->route('Pengaju.Buku.Create');
        }else
        {
            alert()->error('Error','Gagal');
            return redirect()->route('Pengaju.Buku.Create');
        }
        
    }

    private function simpanPDF($type, $foto)
    {
        $dt = new DateTime();

        $path = public_path('storage/uploads/surat/' . $type . '/' . $dt->format('Y-m-d') );
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0755, true, true);
        }
        $file = $foto;
        $name =  $type . '_' . $dt->format('Y-m-d');
        $fileName = $name . '.' . $file->getClientOriginalExtension();
        $folder = '/uploads/surat/' . $type . '/' . $dt->format('Y-m-d') ;

        $check = public_path($folder) . $fileName;

        if (File::exists($check)) {
            File::delete($check);
        }

        $filePath = $file->storeAs($folder, $fileName, 'public');
        return $filePath;
    }

    private function simpanImage($type, $foto)
    {
        $dt = new DateTime();

        $path = public_path('storage/uploads/cover/' . $type . '/' . $dt->format('Y-m-d') );
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0755, true, true);
        }
        $file = $foto;
        $name =  $type . '_' . $dt->format('Y-m-d');
        $fileName = $name . '.' . $file->getClientOriginalExtension();
        $folder = '/uploads/cover/' . $type . '/' . $dt->format('Y-m-d') ;

        $check = public_path($folder) . $fileName;

        if (File::exists($check)) {
            File::delete($check);
        }

        $filePath = $file->storeAs($folder, $fileName, 'public');
        return $filePath;
    }
    public function hasilreview()
    {
        $buku = Buku::where('pengaju_id',Auth::user()->pengaju->id)->get();
        $data['buku'] = $buku;
        return view('pengaju.buku.hasilreview',$data);
    }


    public function editreview($id)
    {
        // dd('hallo');
        $buku = Buku::findOrFail($id);
        // dd($buku);
        $penulis = Penulis::findOrFail($buku->penulis_id);
        // dd($penulis);
        $data = [
            'buku' => $buku,
            'penulis' => $penulis,
        ];
        // $penulis = $this->caripenulis($buku->id);
        return view('pengaju.buku.editreview',$data);
        // return view('buku.edit', compact('buku', 'penulis'));
    }

    public function updatereview(Request $request, $id)
    {
        // $request->validate([
        //     'Judul' => 'required|string|max:255',
        //     'JumlahHalaman' => 'required|integer',
        //     'DaftarPustaka' => 'required|string',
        //     'Resensi' => 'required|string',
        //     'tahunterbit' => 'required|integer',
        //     'harga' => 'required|numeric',
        //     'suratkeaslian' => 'required|file|mimes:pdf',
        //     'coverbuku' => 'required|file|mimes:jpeg,png,jpg',
        //     'lembarbelakang' => 'required|file|mimes:jpeg,png,jpg',
        //     'NAMA' => 'required|string|max:255',
        //     'NoTelepon' => 'required|string|max:15',
        //     'Alamat' => 'required|string|max:255',
        // ]);

        $params1 = $request->all();
        $params1['status'] = 'pending';
        $params2['NAMA'] = $request->NAMA;
        $params2['NoTelepon'] = $request->NoTelepon;
        $params2['Alamat'] = $request->Alamat;
        // Pengecekan jika password konfirmasi tidak sama dengan password


        if ($request->hasFile('suratkeaslian')) {
            $file = $request->file('suratkeaslian');
            if ($file->isValid()) {
                $arams1['suratkeaslian'] = $this->simpanPDF($params2['NAMA'], $request->file('suratkeaslian'));
            } else {
                return redirect()->back()->with('error', 'File foto tidak valid');
            }
        } else {
            $params1 = $request->except('suratkeaslian');
        }
        if ($request->hasFile('coverbuku')) {
            $file = $request->file('coverbuku');
            if ($file->isValid()) {
                $params1['coverbuku'] = $this->simpanImage($params1['NAMA'], $request->file('coverbuku'));
            } else {
                return redirect()->back()->with('error', 'File foto tidak valid');
            }
        } else {
            $params1 = $request->except('coverbuku');
        }
        // $cari = Petugas::where('user_id', Crypt::decrypt($id))->first();
        $petugas = Buku::findOrFail($id);
        // dd($petugas);
        $user = Penulis::findOrFail($petugas->penulis_id);
        if ($petugas->update($params1) && $user->update($params2)) {
            alert()->success('Success', 'Data Berhasil Disimpan');
        } else {
            alert()->error('Error', 'Data Gagal Disimpan');
        }

        return redirect()->route('Pengaju.Buku.hasilreview')->with('success', 'Data berhasil diperbarui');

        // $buku = Buku::findOrFail($id);
        // $buku->Judul = $request->Judul;
        // $buku->JumlahHalaman = $request->JumlahHalaman;
        // $buku->DaftarPustaka = $request->DaftarPustaka;
        // $buku->Resensi = $request->Resensi;
        // $buku->tahunterbit = $request->tahunterbit;
        // $buku->harga = $request->harga;

        // if ($request->hasFile('suratkeaslian')) {
        //     // $file = $request->file('suratkeaslian');
        //     // $filePath = $file->store('suratkeaslian', 'public');
        //     // $buku->suratkeaslian = $filePath;
        //     $buku['suratkeaslian'] = $this->simpanPDF($penulis['NAMA'], $request->file('suratkeaslian'));
        // }
        // $data1['suratkeaslian'] = $this->simpanPDF($penulis['NAMA'], $request->file('suratkeaslian'));
        // $data1['coverbuku'] = $this->simpanImage($penulis['NAMA'], $request->file('coverbuku'));
        // if ($request->hasFile('coverbuku')) {
        //     $file = $request->file('coverbuku');
        //     $filePath = $file->store('coverbuku', 'public');
        //     $buku->coverbuku = $filePath;
        // }

        // // if ($request->hasFile('lembarbelakang')) {
        // //     $file = $request->file('lembarbelakang');
        // //     $filePath = $file->store('lembarbelakang', 'public');
        // //     $buku->lembarbelakang = $filePath;
        // // }

        // $buku->save();

        // $penulis = Penulis::where('buku_id', $buku->id)->first();
        // $penulis->NAMA = $request->NAMA;
        // $penulis->NoTelepon = $request->NoTelepon;
        // $penulis->Alamat = $request->Alamat;
        // $penulis->save();

        // return redirect()->route('home')->with('success', 'Buku updated successfully');
    }

    private function caripenulis($buku_id)
    {
        return Penulis::where('buku_id', $buku_id)->first();
    } 

    // public function Storeeditreview (Request $request, $id)
    // {
    //     $data1 = $request->all();
    //     $buku = Buku::findOrFail($id);
    //     $buku->update($data1);
    //     return redirect('/Admin/buku/download')->with('success', 'Data buku berhasil diperbarui.');
    // }
    public function profile()
    {
        $pengaju = Pengaju::where('id', auth()->user()->pengaju->id)->first();
        $data['pengaju'] = $pengaju;
        return view('Pengaju.buku.profile', $data);
    }

    public function update(Request $request)
    {
        // dd('hallo');
        $user = User::findOrFail(auth()->user()->id);
        // dd($user);
        $superadmin = Pengaju::where('user_id', auth()->user()->id)->first();

        $superadminParams = $request->only(['name', 'foto' ]);
        if ($request->has('foto')) {
            $superadminParams['foto'] = $this->simpanProfile($superadmin->user->role, $request->file('foto'), $superadminParams['name']);
        } else {
            $superadminParams = $request->except('foto');
        }
        $superadmin->update($superadminParams);

        $user->update([
            'username' => $request->input('username'),
        ]);

        alert()->success('Success', 'Data Berhasil Disimpan');
        return redirect()->route('Pengaju.Buku.Profile');
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
